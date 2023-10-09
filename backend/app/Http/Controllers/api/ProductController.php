<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index()
    {
        $product = Product::all();

        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $product
        ], 200);
    }

    function store(ProductRequest $request)
    {
        $product = Product::create($request->all());

        return response()->json([
            'message' => "Data Created",
            'data' => $product
        ], 201);
    }

    function update($id, ProductRequest $request)
    {
        $product = Product::find($id);
        $product->update($request->all());

        return response()->json([
            'message' => "Data Updated",
            'data' => $product
        ], 200);
    }

    function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json([
            "message" => "Data Deleted"
        ], 200);
    }
}
