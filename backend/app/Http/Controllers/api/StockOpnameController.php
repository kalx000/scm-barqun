<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockOpnameRequest;
use App\Models\StockOpname;
use Illuminate\Http\Request;

class StockOpnameController extends Controller
{
    function index()
    {
        $stockOpname = StockOpname::all();

        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $stockOpname
        ], 200);
    }

    function store(StockOpnameRequest $request)
    {
        $stockOpname = StockOpname::create($request->validated());

        return response()->json([
            'message' => "Data Created",
            'data' => $stockOpname
        ], 201);
    }

    function update($id, StockOpnameRequest $request)
    {
        $stockOpname = StockOpname::find($id);
        $stockOpname->update($request->validated());

        return response()->json([
            'message' => "Data Updated",
            'data' => $stockOpname
        ], 200);
    }

    function destroy($id)
    {
        $stockOpname = StockOpname::find($id);
        $stockOpname->delete();

        return response()->json([
            'message' => "Data Deleted",
            'data' => $stockOpname
        ], 200);
    }
}
