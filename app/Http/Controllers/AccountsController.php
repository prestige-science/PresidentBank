<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class AccountsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $accounts = Account::where('user_id', Auth::user()->id)->get();

        return view('accounts.index', [
            'accounts' => $accounts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255|unique:accounts,name',
        ]);

        $insert = new Account;
        $insert->uuid = Uuid::generate(4);
        $insert->user_id = Auth::user()->id;
        $insert->name = $request->name;
        $insert->balance = 0;
        $insert->save();

        return redirect('accounts')->with('success', 'Record Added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $account = Account::where('uuid', $id)->first();

        if (is_null($account)) {
            return redirect('accounts')->with('danger', 'Account not Found');
        }

        return view('accounts.update', [
            'account' => $account
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $account = Account::where('uuid', $id)->first();

        if (is_null($account)) {
            return redirect('accounts')->with('danger', 'Account not Found');
        }

        $this->validate($request, [
            'name' => 'required|max:255|unique:accounts,name',
        ]);

        $account->name = $request->name;
        $account->save();

        return redirect('accounts')->with('success', 'Record Updated');
    }

}
