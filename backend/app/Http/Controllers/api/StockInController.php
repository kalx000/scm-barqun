<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockInRequest;
use App\Models\StockIn;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:stockin-list|stockin-create|stockin-edit|stockin-delete', ['only' => 'index', 'store']);
        $this->middleware('permission:stockin-create', ['only' => ['store']]);
        $this->middleware('permission:stockin-edit', ['only' => ['update']]);
        $this->middleware('permission:stockin-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $stockIn = StockIn::all();

        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $stockIn
        ], 200);
    }

    public function show(StockIn $stockIn)
    {
        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $stockIn
        ], 200);
    }

    public function store(StockInRequest $request)
    {
        $stockIn = StockIn::create($request->validated());

        return response()->json([
            'message' => "Data Created",
            'data' => $stockIn
        ], 201);
    }

    public function update(StockIn $stockIn, StockInRequest $request)
    {
        // $stockIn = StockIn::find($id);
        $stockIn->update($request->validated());

        return response()->json([
            'message' => 'Data Updated',
            'data' => $stockIn
        ], 200);
    }

    public function destroy(StockIn $stockIn)
    {
        // $stockIn = StockIn::find($id);
        $stockIn->delete();

        return response()->json([
            'message' => 'Data Deleted'
        ], 200);
    }
}
