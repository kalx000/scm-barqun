<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete', ['only' => 'index', 'store']);
        $this->middleware('permission:customer-create', ['only' => ['store']]);
        $this->middleware('permission:customer-edit', ['only' => ['update']]);
        $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $customer = Customer::all();

        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $customer
        ], 200);
    }

    public function show(Customer $customer)
    {
        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $customer
        ], 200);
    }

    public function store(CustomerRequest $request)
    {
        $customer = Customer::create($request->validated());

        return response()->json([
            'message' => 'Data Created',
            'data' => $customer
        ], 201);
    }

    public function update($id, CustomerRequest $request)
    {
        $customer = Customer::find($id);
        $customer->update($request->validated());

        return response()->json([
            'message' => 'Data Updated',
            'data' => $customer
        ], 200);
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return response()->json([
            'message' => "Data Deleted"
        ], 200);
    }
}
