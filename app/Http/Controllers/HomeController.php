<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Account;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, Client $client, Account $account)
    {
        
        $accounts = Account::all();

        $totalBalance = 0;
        foreach ($accounts as $account) {
            $totalBalance += $account["acc_balance"];
        }
        $totalBalance;

        $maxAmount= $this->findBiggestAmount();

    }

        // return view('home', [
        //     'client' => $client,   
        //     'account' => $account,  
        //     'totalBalance' => $totalBalance,
        //     'maxBalance' => $maxalance  
    
        // ]);  
      
        public function findBiggestAmount()
        {
            // Retrieve all orders
            $orders = Order::all();
            
            $maxAmount = 0; // Initialize the maximum amount to zero
            $maxIban = '';  // Initialize the IBAN of the account with the maximum amount to an empty string
            
            // Iterate through all orders
            foreach ($accounts as $account) {
                // Check if the current order has a larger amount than the current maximum
                if ($account->acc_balance > $maxAmount) {
                    $maxAmount = $account->acc_balance;
                    $maxIban = $account->iban;
                }
            }
            
            return [
                'iban' => $maxIban,
                'amount' => $maxAmount,
            ];

    }
}