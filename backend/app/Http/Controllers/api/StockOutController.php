<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockOutRequest;
use App\Models\StockOut;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:stockout-list|stockout-create|stockout-edit|stockout-delete', ['only' => 'index', 'store']);
        $this->middleware('permission:stockout-create', ['only' => ['store']]);
        $this->middleware('permission:stockout-edit', ['only' => ['update']]);
        $this->middleware('permission:stockout-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $stockOut = StockOut::all();

        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $stockOut
        ], 200);
    }

    public function show(StockOut $stockOut)
    {
        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $stockOut
        ], 200);
    }

    public function store(StockOutRequest $request)
    {
        $stockOut = StockOut::create($request->validated());

        return response()->json([
            'message' => 'Data Created',
            'data' => $stockOut
        ], 201);
    }

    public function update($id, StockOutRequest $request)
    {
        $stockOut = StockOut::find($id);
        $stockOut->update($request->validated());

        return response()->json([
            'message' => 'Data Updated',
            'data' => $stockOut
        ], 200);
    }

    public function destroy($id)
    {
        $stockOut = StockOut::find($id);
        $stockOut->delete();

        return response()->json([
            'message' => 'Data Deleted'
        ], 200);
    }
}
