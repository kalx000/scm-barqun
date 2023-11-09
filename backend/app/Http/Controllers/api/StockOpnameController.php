<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockOpnameRequest;
use App\Models\StockOpname;
use Illuminate\Http\Request;

class StockOpnameController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:stockopname-list|stockopname-create|stockopname-edit|stockopname-delete', ['only' => 'index', 'store']);
        $this->middleware('permission:stockopname-create', ['only' => ['store']]);
        $this->middleware('permission:stockopname-edit', ['only' => ['update']]);
        $this->middleware('permission:stockopname-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $stockOpname = StockOpname::all();

        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $stockOpname
        ], 200);
    }

    public function show(StockOpname $stockOpname)
    {
        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $stockOpname
        ], 200);
    }

    public function store(StockOpnameRequest $request)
    {
        $stockOpname = StockOpname::create($request->validated());

        return response()->json([
            'message' => "Data Created",
            'data' => $stockOpname
        ], 201);
    }

    public function update(StockOpname $stockOpname, StockOpnameRequest $request)
    {
        // $stockOpname = StockOpname::find($id);
        $stockOpname->update($request->validated());

        return response()->json([
            'message' => "Data Updated",
            'data' => $stockOpname
        ], 200);
    }

    public function destroy(StockOpname $stockOpname)
    {
        // $stockOpname = StockOpname::find($id);
        $stockOpname->delete();

        return response()->json([
            'message' => "Data Deleted",
            'data' => $stockOpname
        ], 200);
    }
}
