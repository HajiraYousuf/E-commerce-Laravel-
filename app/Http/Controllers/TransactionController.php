<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index(Request $request)
{
    $transactions = Transaction::latest()
        ->when($request->search, function ($query) use ($request) {
            $query->where('transaction_id', 'like', '%' . $request->search . '%')
                ->orWhere('customer_name', 'like', '%' . $request->search . '%')
                ->orWhere('customer_email', 'like', '%' . $request->search . '%')
                ->orWhere('product_name', 'like', '%' . $request->search . '%');
        })
        ->paginate(10);

    // ✅ ADD THIS
$totalTransactions = Transaction::count();

$totalRevenue = Transaction::where('status', 'completed')->sum('amount');

$pendingAmount = Transaction::where('status', 'pending')->sum('amount');

$refundAmount = Transaction::where('status', 'canceled')->sum('amount');
    return view('admin.transaction.transaction', compact(
        'transactions',
        'totalTransactions',
        'totalRevenue',
        'pendingAmount',
        'refundAmount'
    ));
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
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
