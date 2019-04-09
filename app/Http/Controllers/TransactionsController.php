<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use App\Models\TransactionType;
use App\Models\Transaction;
use Webpatser\Uuid\Uuid;

class TransactionsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $transactions = Transaction::where('user_id', Auth::user()->id)->get();

        return view('transactions.index', [
            'transactions' => $transactions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $accounts = Account::where('user_id', Auth::user()->id)
                ->orderBy('name', 'asc')
                ->get();

        $transaction_types = TransactionType::orderBy('name', 'asc')->get();

        return view('transactions.create', [
            'accounts' => $accounts,
            'transaction_types' => $transaction_types
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'account' => 'required',
            'transaction_type' => 'required',
            'amount' => 'required|numeric',
        ]);


        $update = Account::where('id', $request->account)->first();

        if ($request->transaction_type === '1') {
            // A deposit 
            $update->balance = $update->balance + $request->amount;
        } elseif ($request->transaction_type === '3') {
            // A withdrawal. Check to ensure minimum balance does not go below zero
            if ($update->balance < $request->amount) {
                return redirect('transactions')
                                ->with('danger', $update->name . '\'s account balance (KES ' . number_format($update->balance) . ') is less than requested withdrawal amount (KES ' . number_format($request->amount) . ').');
            } else {
                $update->balance = $update->balance - $request->amount;
            }
        }

        $update->save();

        $insert = new Transaction;
        $insert->uuid = Uuid::generate(4);
        $insert->user_id = Auth::user()->id;
        $insert->type_id = $request->transaction_type;
        $insert->account_id = $request->account;
        $insert->amount = $request->amount;
        $insert->save();

        return redirect('transactions')->with('success', 'Record Added');
    }

}
