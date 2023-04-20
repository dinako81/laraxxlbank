<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Client;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    public function index()
    {
        $accounts = Account::all();
        return view('accounts.index', [
            'accounts' => $accounts
        ]);
    }


    public function create(Request $request)
    {
        $clients = Client::all();

        $id = $request->id ?? 0;
        
        $acc_number = 'LT' . rand(0, 9) . rand(0, 9) . ' ' . '0014' . ' ' . '7' . rand(0, 9) . rand(0, 9) . rand(0, 9) . ' ' . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9)  . ' ' . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);

        return view('accounts.create', [
            'clients' => $clients,
            'id' => $id,
            'acc_number' => $acc_number
        ]);
    }


    public function store(Request $request)
    {
        account::create([
            'acc_number' => $request->acc_number,
            'client_id' => $request->client_id,
        ]);

        return redirect()->route('accounts-index');
    }


    public function show(Account $account)
    {
        //
    }


    public function edit(Account $account)
    {
        return view('accounts.edit', [
            'account' => $account
        ]);
    }


    public function update(Request $request, Account $account)
    {
        $account->update([
            
            'acc_balance' => $request->acc_balance,
           
        ]);

        return redirect()
        ->route('accounts-index')
        ->with('light-up', $account->id)
        ;
    }


    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()
        ->back()
        ->with('info', 'No more account');
    }
}