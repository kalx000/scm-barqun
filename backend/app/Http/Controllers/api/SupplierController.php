<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    function index()
    {
        $supplier = Supplier::all();

        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $supplier
        ], 200);
    }

    function store(SupplierRequest $request)
    {
        $supplier = Supplier::create($request->all());

        return response()->json([
            'message' => 'Data Created',
            'data' => $supplier
        ], 201);
    }

    function update($id, SupplierRequest $request)
    {
        $supplier = Supplier::find($id);
        $supplier->update($request->all());

        return response()->json([
            'message' => 'Data Updated',
            'data' => $supplier
        ], 200);
    }

    function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();

        return response()->json([
            'message' => 'Data Deleted'
        ], 200);
    }
}
