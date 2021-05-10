<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function index()
    {
        $userOrders = auth()->user()->orders()->orderBy('created_at', 'DESC')->paginate(15);
        return view('store/user-orders', compact('userOrders'));
    }
}
