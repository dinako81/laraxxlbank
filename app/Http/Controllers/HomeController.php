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
        $clients = Client::all();
        $accounts = Account::all();
        // $totalMoney = $this->getTotalMoney();
        $totalMoney = $accounts->sum('acc_balance');
        $biggestAmount = $this->findBiggestAmount();
        $averageMoney = $totalMoney / $accounts->count(); 
        $zeroMoneyAccounts = $accounts->where('acc_balance', 0);
        $countZeroMoneyAccounts = $zeroMoneyAccounts->count();
        $negativeAccounts = Account::where('acc_balance', '<', 0);
        $negativeCount = $negativeAccounts->count();
        

        return view('home', [
            'client' => $client,   
            'account' => $account,     
            'totalMoney' => $totalMoney, 
            'biggestAmount' => $biggestAmount,
            'averageMoney' => $averageMoney,
            'countZeroMoneyAccounts' => $countZeroMoneyAccounts,
            'negativeCount' =>  $negativeCount,
        
        ]);  


    }
    public function getTotalMoney()
    {
        $accounts = Account::all();
        $totalMoney = 0;
        foreach ($accounts as $account) {
            $totalMoney += $account->money;
        }
        return $totalMoney;
    }

    public function findBiggestAmount()
    {
        // Retrieve all accounts
        $accounts = Account::all();
        
        $maxAmount = 0; // Initialize the maximum amount to zero
        $maxIban = '';  // Initialize the IBAN of the account with the maximum amount to an empty string
        
        // Iterate through all accounts
        foreach ($accounts as $account) {
            // Check if the current account has a larger amount than the current maximum
            if ($account->acc_balance > $maxAmount) {
                $maxAmount = $account->acc_balance;
                $maxIban = $account->acc_number;
            }
        }
        
        return [
            'iban' => $maxIban,
            'amount' => $maxAmount,
        ];
    }
}