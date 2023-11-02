<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:order-list|order-create|order-edit|order-delete', ['only' => 'index', 'store']);
        $this->middleware('permission:order-create', ['only' => ['store']]);
        $this->middleware('permission:order-edit', ['only' => ['update']]);
        $this->middleware('permission:order-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $order = Order::all();

        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $order
        ], 200);
    }

    public function show(Order $order)
    {
        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $order
        ], 200);
    }

    public function store(OrderRequest $request)
    {
        $order = Order::create($request->validated());

        return response()->json([
            'message' => 'Data Created',
            'data' => $order
        ], 201);
    }

    public function update($id, OrderRequest $request)
    {
        $order = Order::find($id);
        $order->update($request->validated());

        return response()->json([
            'message' => 'Data Updated',
            'data' => $order
        ], 200);
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return response()->json([
            'message' => "Data Deleted"
        ], 200);
    }
}
