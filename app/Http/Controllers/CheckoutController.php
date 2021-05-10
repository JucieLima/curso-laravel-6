<?php

namespace App\Http\Controllers;

use App\Payment\PagSeguro\CreditCard;
use App\Payment\PagSeguro\Notification;
use App\UserOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Store;
use Ramsey\Uuid\Uuid;

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
        try {
            $cartItems = session()->get('cart');
            $stores = array_unique(array_column($cartItems, 'store_id'));
            $user = auth()->user();
            $data = $request->all();
            // Set a reference code for this payment request. It is useful to identify this payment
            // in future notifications.
            $reference = date('dmYHis').substr(Uuid::uuid4(),0,4);

            $creditCardPayment = new CreditCard($cartItems, $user, $data, $reference);
            $result = $creditCardPayment->doPayment();

            $userOrder = [
                'reference' => $reference,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => serialize($cartItems),
            ];

            $userOrder = $user->orders()->create($userOrder);
            $userOrder->stores()->sync($stores);

            //Notificar loja sobre novo pedido
            $storeNotify = new Store();
            $storeNotify->notifyStoreOwners($stores);

            //Excluir seção
            session()->forget('cart');
            session()->forget('pagseguro_session_code');

            //Retorno para o browser
            return response()->json([
                'data' => [
                    'status' => true,
                    'message' => 'Pedido criado com sucesso!',
                    'order' => $reference
                ]
            ]);
        } catch (\Exception $exception) {
            $message = env('APP_DEBUG') ? 'Erro ao processar pedido: '.
                $exception->getMessage() : 'Erro ao processar pedido.';
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

    public function notification()
    {
        try{
            $notification = new Notification();
            $notification = $notification->getTransaction();

            //atualizar pedido do usuário
            $userOrder = UserOrder::whereReference($notification->getReference());
            $userOrder->update([
                'pagseguro_status' => $notification->getStatus()
            ]);

            //comentários sobre o pedido pago
            if($notification->status() == 3){
                // Liberar pedido do usuário
                // Atualizar o estatus do pedido para o cliente
                // Notificar usuário que o pedido foi pago
                // Notificar a loja da compra do pedido
            }

            return response()->json([],204);
        }catch (\Exception $e){
            return response()->json([],500);
        }
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
