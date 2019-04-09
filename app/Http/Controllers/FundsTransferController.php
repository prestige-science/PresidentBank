<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\FundsTransfer;
use Webpatser\Uuid\Uuid;
use App\Models\ViewFundsTransfer;

class FundsTransferController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $transfers = ViewFundsTransfer::where('from_user_id', Auth::user()->id)
                ->orWhere('to_user_id', Auth::user()->id)
                ->get();

        return view('funds_transfer.index', [
            'transfers' => $transfers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $my_account_ids = Account::where('user_id', Auth::user()->id)
                ->pluck('user_id');

        $to_accounts = Account::orderBy('name', 'asc')
                ->whereNotIn('user_id', $my_account_ids)
                ->get();

        $from_accounts = Account::where('user_id', Auth::user()->id)
                ->orderBy('name', 'asc')
                ->get();

        return view('funds_transfer.create', [
            'from_accounts' => $from_accounts,
            'to_accounts' => $to_accounts,
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
            'from_account' => 'required',
            'to_account' => 'required',
            'amount' => 'required|numeric',
        ]);

        // Get from_account details
        $from_account = Account::where('id', $request->from_account)->first();

        // Get to_account details
        $to_account = Account::where('id', $request->to_account)->first();

        // Ensure both accounts have data
        if (is_null($from_account) || is_null($to_account)) {
            return redirect('funds_transfer')->with('danger', 'Invalid Request');
        }

        // Check for sufficient balance  in from_account
        if ($from_account->balance < $request->amount) {
            return redirect('funds_transfer')->with('danger', 'Insufficient balance in ' . $from_account->name . '\'s account.');
        }

        // Update balance of the from_account
        $from_account->balance = $from_account->balance - $request->amount;
        $from_account->save();

        // Add the transaction
        $transaction = new Transaction;
        $transaction->uuid = Uuid::generate(4);
        $transaction->user_id = Auth::user()->id;
        $transaction->type_id = 2; // Funds transfer
        $transaction->account_id = $request->from_account;
        $transaction->amount = $request->amount;
        $transaction->save();

        // Get the transaction ID
        $transaction_id = $transaction->id;

        // Add the funds transfer entry
        $transfer = new FundsTransfer;
        $transfer->uuid = Uuid::generate(4);
        $transfer->transaction_id = $transaction_id;
        $transfer->user_id = $to_account->user_id;
        $transfer->account_id = $to_account->id;
        $transfer->save();

        // Update balance of the to_account
        $to_account->balance = $to_account->balance + $request->amount;
        $to_account->save();

        return redirect('funds_transfer')->with('success', 'Funds Transfered');
    }

}
