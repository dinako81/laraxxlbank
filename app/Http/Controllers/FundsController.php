<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FundsController extends Controller
{
    public function addfunds(Request $request, Client $client, Account $account)
    {
        $clients = Client::all();
        $accounts = Account::all();
        $id = $request->id ?? 0;
        
        return view('funds.addfunds', [
            'account' => $account,
            'client' => $client,
            'id' => $id
            
        ]);
    }

    public function plusfunds(Request $request, Client $client, Account $account)
    {
        $accounts = Account::all();
        $clients = Client::all();
        $id = $request->id ?? 0;

        $validator = Validator::make($request->all(), [
            'acc_balance' => 'required|numeric|min:0',
        ]); 
        
        if ($validator->fails()) {
            $request->flash();
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }  $validator = Validator::make($request->all(), [
            'acc_balance' => 'required|numeric|min:0',
        ]); 
        
        if ($validator->fails()) {
            $request->flash();
            return redirect()
                        ->back()
                        ->withErrors($validator);
        } 

        $account->acc_balance = $request->acc_balance+ $account->acc_balance;
        $account->save();
        return redirect()
        ->route('clients-index')
        ->with('ok', 'Suma padidinta!');
    }

    public function withdrawfunds(Request $request, Client $client, Account $account)
    {

        $clients = Client::all();
        $accounts = Account::all();
        $id = $request->id ?? 0;
        return view('funds.withdrawfunds', [
            'client' => $client,
            'account' => $account,
            'id' => $id,

        ]);
    }

    public function minusfunds(Request $request, Client $client, Account $account)

    {   $accounts = Account::all();
        $clients = Client::all();     
        $id = $request->id ?? 0;

        $validator = Validator::make($request->all(), [
            'acc_balance' => 'required|numeric|min:0',
        ]); 
        
        if ($validator->fails()) {
            $request->flash();
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }  
        if ($request->acc_balance > $account->acc_balance) {
            return redirect()
            ->route('clients-index')
            ->with('warn', 'Sąskaitoje nepakanka lėšų!');
    
        } 
        $account->acc_balance =  $account->acc_balance - $request->acc_balance;
        $account->save();
        return redirect()
        ->route('clients-index')
        ->with('ok', 'Your amount has decreased!');
    
    }

    public function fundstransfer(Request $request, Client $client, Account $account)
    {
        $clients = Client::all();
        $accounts = Account::all();
        $id = $request->id ?? 0;

        return view('funds.fundstransfer', [
            'clients' => $clients,
            'accounts' => $accounts,
            'id' => $id,
        ]);
    }

    public function transfer(Request $request, Client $client, Account $account)
    {

        // $clients = Client::all();
        // $id = $request->id ?? 0;
        $validator = Validator::make($request->all(), [
            'acc_balance' => 'required|numeric|min:0',
        ]); 
        
        if ($validator->fails()) {
            $request->flash();
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }  $validator = Validator::make($request->all(), [
            'acc_balance' => 'required|numeric|min:0',
        ]); 
        
        if ($validator->fails()) {
            $request->flash();
            return redirect()
                        ->back()
                        ->withErrors($validator);
        } 

        $client->acc_balance = $request->acc_balance+ $client->acc_balance;
        $client->save();
        return redirect()
        ->route('clients-index')
        ->with('ok', 'Your amount has increaseds!');
    }
}