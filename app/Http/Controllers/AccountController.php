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
        
        return view('accounts.create', [
            'clients' => $clients,
            'id' => $id
        ]);
    }


    public function store(Request $request)
    {
        account::create([
            'title' => $request->title,
            'price' => $request->price,
            'client_id' => $request->client_id,
        ]);

        return redirect()->route('accounts-index');
    }


    public function show(Account $account)
    {
        //
    }


    public function edit(account $account)
    {
        return view('accounts.edit', [
            'account' => $account
        ]);
    }


    public function update(Request $request, account $account)
    {
        $account->update([
            'title' => $request->title,
            'price' => $request->price
        ]);

        return redirect()
        ->route('accounts-index')
        ->with('light-up', $account->id)
        ;
    }


    public function destroy(account $account)
    {
        $account->delete();
        return redirect()
        ->back()
        ->with('info', 'No more account');
    }
}