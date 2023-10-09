<?php

namespace App\Http\Controllers\api;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryRequest;

class InventoryController extends Controller
{
    function index()
    {
        $inventory = Inventory::all();

        return response()->json([
            'message' => 'Data Retreived',
            'data' => $inventory
        ], 200);
    }

    function store(InventoryRequest $request)
    {
        $inventory = Inventory::create($request->all());

        return response()->json([
            'message' => 'Data Created',
            'data' => $inventory
        ], 201);
    }

    function update($id, InventoryRequest $request)
    {
        $inventory = Inventory::find($id);
        $inventory->update($request->all());

        return response()->json([
            'message' => 'Data Updated',
            'data' => $inventory
        ], 200);
    }

    function destroy($id)
    {
        $inventory = Inventory::find($id);
        $inventory->delete();

        return response()->json([
            'message' => 'Data Deleted',
            'data' => $inventory
        ], 200);
    }
}
