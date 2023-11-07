<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:product-create', ['only' => ['store']]);
        $this->middleware('permission:product-edit', ['only' => 'update']);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $product = Product::all();

        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $product
        ], 200);
    }

    public function show(Product $product)
    {
        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $product
        ], 200);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        return response()->json([
            'message' => "Data Created",
            'data' => $product
        ], 201);
    }

    public function update(Product $product, ProductRequest $request)
    {
        // $product = Product::find($id);
        $product->update($request->validated());

        return response()->json([
            'message' => "Data Updated",
            'data' => $product
        ], 200);
    }

    public function destroy(Product $product)
    {
        // $product = Product::find($id);
        $product->delete();

        return response()->json([
            "message" => "Data Deleted"
        ], 200);
    }
}
