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
        // if ($request->acc_balance > $account->acc_balance) {
        //     return redirect()
        //     ->route('clients-index')
        //     ->with('warn', 'Sąskaitoje nepakanka lėšų!');
    
        // } 
        $account->acc_balance =  $account->acc_balance - $request->acc_balance;
        $account->save();
        return redirect()
        ->route('clients-index')
        ->with('ok', 'Your amount has decreased!');
    
    }

    public function taxes(Request $request, Account $account) {
        $account->acc_balance = $account->acc_balance - 5;
            $account->save();
            return redirect()->route('clients-index')->with('ok', '5 Eurai mokesčiams nuskaičiuoti');
    }

    public function fundstransfer(Request $request, Client $client, Account $account)
    {
        $clients = Client::all();
        $accounts= Account::all();
      
        return view('funds.fundstransfer', [
            'account' => $account,
            'client' =>$client,
            'clients'=>$clients,
            'accounts'=>$accounts,
            'title'=>'Pinigų pervedimai',
        ]); ;
    }

    public function transfer(Request $request)

    {       $validator = Validator::make($request->all(), [
            'from_client_id' => 'required',
            'to_client_id' => 'required',
            'acc_balance' => 'required|numeric|min:0.01'
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        $fromAccount = Account::findOrFail($request->from_client_id);
        $toAccount = Account::findOrFail($request->to_client_id);
    
        if ($fromAccount->acc_balance < $request->acc_balance) {
            return redirect()
                ->back()
                ->withErrors(['warn' => 'Nepakankamas likutis'])
                ->withInput();
        }
    
        $fromAccount->acc_balance -= $request->acc_balance;
        $toAccount->acc_balance += $request->acc_balance;
    
        $fromAccount->save();
        $toAccount->save();
    
        return redirect()
            ->route('funds-fundstransfer')
            ->with('ok', 'Pavedimas įvykdytas sėkmingai!');
    }
}