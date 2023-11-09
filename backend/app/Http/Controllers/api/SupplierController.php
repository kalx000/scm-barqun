<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:supplier-list|supplier-create|supplier-edit|supplier-delete', ['only' => 'index', 'store']);
        $this->middleware('permission:supplier-create', ['only' => ['store']]);
        $this->middleware('permission:supplier-edit', ['only' => ['update']]);
        $this->middleware('permission:supplier-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $supplier = Supplier::all();

        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $supplier
        ], 200);
    }

    public function show(Supplier $supplier)
    {
        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $supplier
        ], 200);
    }

    public function store(SupplierRequest $request)
    {
        $supplier = Supplier::create($request->validated());

        return response()->json([
            'message' => 'Data Created',
            'data' => $supplier
        ], 201);
    }

    public function update(Supplier $supplier, SupplierRequest $request)
    {
        // $supplier = Supplier::find($id);
        $supplier->update($request->validated());

        return response()->json([
            'message' => 'Data Updated',
            'data' => $supplier
        ], 200);
    }

    public function destroy(Supplier $supplier)
    {
        // $supplier = Supplier::find($id);
        $supplier->delete();

        return response()->json([
            'message' => 'Data Deleted'
        ], 200);
    }
}
