<?php

namespace App\Http\Controllers\Customer;

use App\Order;
use App\OrderProduct;
use App\Settings;
use Illuminate\Http\Request;

class OrdersController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        // $orders = auth()->user()->orders; // n + 1 issues

        $orders = auth()->user()->orders()->with('products')->get(); // fix n + 1 issues

        return view('site.user-dashboard.my-orders')->with('orders', $orders);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Order $order)
    {

//        if (auth('customer')->id() !== $order->customer_id) {
//            return back()->withErrors('You do not have access to this!');
//        }
        $products = $order->products;
        $orderProducts = OrderProduct::where('order_id', $order->id)->get();
        return view('site.user-dashboard.order-details')->with([
            'order' => $order,
            'products' => $products,
            'orderProducts' => $orderProducts,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
