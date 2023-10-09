<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockOutRequest;
use App\Models\StockOut;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    function index()
    {
        $stockOut = StockOut::all();

        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $stockOut
        ], 200);
    }

    function store(StockOutRequest $request)
    {
        $stockOut = StockOut::create($request->all());

        return response()->json([
            'message' => 'Data Created',
            'data' => $stockOut
        ], 201);
    }

    function update($id, StockOutRequest $request)
    {
        $stockOut = StockOut::find($id);
        $stockOut->update($request->all());

        return response()->json([
            'message' => 'Data Updated',
            'data' => $stockOut
        ], 200);
    }

    function destroy($id)
    {
        $stockOut = StockOut::find($id);
        $stockOut->delete();

        return response()->json([
            'message' => 'Data Deleted'
        ], 200);
    }
}
