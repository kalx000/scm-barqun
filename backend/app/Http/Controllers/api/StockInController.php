<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockInRequest;
use App\Models\StockIn;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    function index()
    {
        $stockIn = StockIn::all();

        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $stockIn
        ], 200);
    }

    function store(StockInRequest $request)
    {
        $stockIn = StockIn::create($request->all());

        return response()->json([
            'message' => "Data Created",
            'data' => $stockIn
        ], 201);
    }

    function update($id, StockInRequest $request)
    {
        $stockIn = StockIn::find($id);
        $stockIn->update($request->all());

        return response()->json([
            'message' => 'Data Updated',
            'data' => $stockIn
        ], 200);
    }

    function destroy($id)
    {
        $stockIn = StockIn::find($id);
        $stockIn->delete();

        return response()->json([
            'message' => 'Data Deleted'
        ], 200);
    }
}
