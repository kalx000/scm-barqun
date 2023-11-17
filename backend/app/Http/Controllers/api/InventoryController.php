<?php

namespace App\Http\Controllers\api;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryRequest;

class InventoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:inventory-list|inventory-create|inventory-edit|inventory-delete', ['only' => 'index', 'store']);
        $this->middleware('permission:inventory-create', ['only' => ['store']]);
        $this->middleware('permission:inventory-edit', ['only' => ['update']]);
        $this->middleware('permission:inventory-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $inventory = Inventory::all();

        return response()->json([
            'message' => 'Data Retreived',
            'data' => $inventory
        ], 200);
    }

    public function show(Inventory $inventory)
    {
        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $inventory
        ], 200);
    }

    public function store(InventoryRequest $request)
    {
        $inventory = Inventory::create($request->validated());

        return response()->json([
            'message' => 'Data Created',
            'data' => $inventory
        ], 201);
    }

    public function update(Inventory $inventory, InventoryRequest $request)
    {
        // $inventory = Inventory::find($id);
        $inventory->update($request->validated());

        return response()->json([
            'message' => 'Data Updated',
            'data' => $inventory
        ], 200);
    }

    public function destroy(Inventory $inventory)
    {
        // $inventory = Inventory::find($id);
        $inventory->delete();

        return response()->json([
            'message' => 'Data Deleted',
            'data' => $inventory
        ], 200);
    }
}
