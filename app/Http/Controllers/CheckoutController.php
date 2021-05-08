<?php

namespace App\Http\Controllers;

use App\Payment\PagSeguro\CreditCard;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            flash('Estamos quase la! Você precisa estar logado para concluir a sua conpra!')->info();
            return redirect()->route('login');
        }

        if (!session()->has('cart')) {
            return redirect()->route('home');
        }

        $this->makePagSeguroSession();

        $total = 0;
        $carItems = array_map(function ($line) {
            return $line['amount'] * $line['price'];
        }, session()->get('cart'));

        $amount = array_sum($carItems);
        return view('store.checkout', compact('amount'));
    }

    public function process(Request $request)
    {
        $cartItems = session()->get('cart');
        $stores = array_unique(array_column($cartItems, 'store_id'));
        $user = auth()->user();
        $data = $request->all();
        // Set a reference code for this payment request. It is useful to identify this payment
        // in future notifications.
        $reference = date('dmYHis');

        $creditCardPayment = new CreditCard($cartItems, $user, $data, $reference);
        $result = $creditCardPayment->doPayment();

        $userOrder = [
            'reference' => $reference,
            'pagseguro_code' => $result->getCode(),
            'pagseguro_status' => $result->getStatus(),
            'items' => serialize($cartItems),
            'store_id' => 42,
        ];

        $userOrder = $user->orders()->create($userOrder);
        $userOrder->stores()->sync($stores);

        session()->forget('cart');
        session()->forget('pagseguro_session_code');

        return response()->json([
            'data' => [
                'status' => true,
                'message' => 'Pedido criado com sucesso!',
                'order' => $reference
            ]
        ]);

        try {

        } catch (\Exception $exception) {
            $message = env('APP_DEUBUG') ? 'Erro ao processar pedido: '.$exception->getMessage() : 'Erro ao processar pedido.';
            return response()->json([
                'data' => [
                    'status' => false,
                    'message' => $message,
                ]
            ], 401);
        }
    }

    public function thanks()
    {
        return view('store.thanks');
    }

    private function makePagSeguroSession()
    {
        if (!session()->has('pagseguro_session_code')) {
            $sessionCode = $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            session()->put('pagseguro_session_code', $sessionCode->getResult());
        }
    }
}
