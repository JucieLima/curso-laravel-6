<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\UserOrder;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    private $order;

    /**
     * OrdersController constructor.
     * @param $order
     */
    public function __construct(UserOrder $order)
    {
        $this->order = $order;
    }

    public function index()
    {

        if(auth()->user()->store){
            $orders = auth()->user()->store->orders()->orderBy('created_at', 'DESC')->paginate(15);
            return view('admin.orders.index', compact('orders'));
        }

        flash('Você ainda não criou sua loja!')->warning();
        return redirect()->route('admin.stores.index');
    }
}
