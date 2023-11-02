<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function index()
    {
        $order = Order::all();

        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $order
        ], 200);
    }

    function store(OrderRequest $request)
    {
        $order = Order::create($request->validated());

        return response()->json([
            'message' => 'Data Created',
            'data' => $order
        ], 201);
    }

    function update($id, OrderRequest $request)
    {
        $order = Order::find($id);
        $order->update($request->validated());

        return response()->json([
            'message' => 'Data Updated',
            'data' => $order
        ], 200);
    }

    function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return response()->json([
            'message' => "Data Deleted"
        ], 200);
    }
}
