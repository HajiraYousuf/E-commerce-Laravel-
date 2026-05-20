<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Customer::query();

        // SEARCH
        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%")
                  ->orWhere('customer_id', 'like', "%{$request->search}%");
        }

        // FILTER STATUS
        if ($request->status && $request->status !== 'All Status') {
            $query->where('status', $request->status);
        }

        // SORT
        if ($request->sort == 'Newest') {
            $query->latest();
        } elseif ($request->sort == 'Oldest') {
            $query->oldest();
        } elseif ($request->sort == 'Top Spent') {
            $query->orderBy('spent', 'desc');
        }

        $customers = $query->paginate(10);

        return view('admin.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(customer $customer)
    {
        //
    }
}
