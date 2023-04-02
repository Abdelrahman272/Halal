<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

class OrderController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $orders = Order::with('user');

        // if(request()->status){
        //     $orders = $orders->where('status', request()->status);
        // }

        // if(request()->payment_method){
        //     $orders = $orders->where('payment_method', request()->payment_method);
        // }

        // if(request()->order_date){
        //     $orders = $orders->whereDate('created_at', request()->order_date);
        // }

        $orders = $orders->latest()->paginate(10);

        return $this->apiResponse($orders, 'Accounts retrieved successfully', 200);
    }
}
