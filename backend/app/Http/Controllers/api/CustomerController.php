<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function index()
    {
        $customer = Customer::all();

        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $customer
        ], 200);
    }

    function store(CustomerRequest $request)
    {
        $customer = Customer::create($request->validated());

        return response()->json([
            'message' => 'Data Created',
            'data' => $customer
        ], 201);
    }

    function update($id, CustomerRequest $request)
    {
        $customer = Customer::find($id);
        $customer->update($request->validated());

        return response()->json([
            'message' => 'Data Updated',
            'data' => $customer
        ], 200);
    }

    function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return response()->json([
            'message' => "Data Deleted"
        ], 200);
    }
}
