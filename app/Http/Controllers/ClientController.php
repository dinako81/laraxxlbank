<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Validation\Validator as V;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        
        $clients = Client::where('id', '>', 0);
        $id = $request->id ?? 0;
        $accounts = Account::all();
        $sort = $request->sort ?? '';
        $filter = $request->filter ?? '';
        $per = (int) ($request->per ?? 10);
        $page = $request->page ?? 1;
        $totalClientBalance = $accounts->sum('acc_balance');

        $clients = match($filter) {
            'clients' => $clients,
            'acc_balance_pos' => $clients->where('acc_balance', '>', 0),
            'acc_balance_neg' => $clients->where('acc_balance', '<', 0),
            'acc_balance_zero' => $clients->where('acc_balance', '=', 0),
            'acc_number' => $clients->where('acc_number', '=', 0),
            default => $clients
        };
        

        $clients = match($sort) {
            'clients' => $clients,
            'surname_asc' => $clients->orderBy('surname'),
            'surname_desc' => $clients->orderBy('surname', 'desc'),
            default => $clients
        };

        $request->session()->put('last-client-view', [
            'sort' => $sort,
            'filter' => $filter,
            'page' => $page,
            'per' => $per
        ]);

        $clients = $clients->paginate($per)->withQueryString();


        // $clients = Client::all()->sortByDesc('name');
        // $clients = $clients->get();


        return view('clients.index', [
            'clients' => $clients,
            'accounts' => $accounts,
            'sortSelect' => Client::SORT,
            'sort' => $sort,
            'filterSelect' => Client::FILTER,
            'filter' => $filter,
            'perSelect' => Client::PER,
            'per' => $per,
            'page' => $page,
            'id' => $id,
            'totalClientBalance' => $totalClientBalance
        ]);

    }


    public function create()
    {
        return view('clients.create',[  
        ]);
    }


    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|alpha',
            'surname' => 'required|min:3|alpha',
            'personal_code' => 'required|min:11|numeric',
        ],
        [
            'name.min' => 'Prailginti vardą iki 3 raidžių.',
            'name.alpha' => 'Vardas tik iš raidžių.',
            'surname.min' => 'Prailginti pavardę iki 3 raidžių.',
            'surname.alpha' => 'Pavardė tik iš raidžių.',
            'personal_code.min' => 'Prailginti asmens kodą iki 11 skaitmenų.',
            'personal_code.numeric' => 'Asmens kodas tik iš skaitmenų.'
        ]);

        // $validator->after(function (V $validator) {
        //     $validator->errors()->add('Fancy', 'Fancy is wrong!');
        // });

        if ($validator->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validator);
        }
        
        $client = new Client;
        $client->name = $request->name;
        $client->surname = $request->surname;
        $client->personal_code = $request->personal_code;
        
        $client->save();
        return redirect()
        ->route('clients-index')
        ->with('ok', 'Naujas klientas sukurtas');

    }

    public function show(Client $client, Account $account)
    {

        return view('clients.show', [
            'client' => $client,
            'account' => $account
        ]);
    }

    public function edit(Request $request, Client $client)
    {
        return view('clients.edit', [
            'client' => $client,
        ]);
    }

    public function update(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|alpha',
            'surname' => 'required|min:3|alpha',
        ],
        [
            'name.min' => 'Prailginti vardą iki 3 raidžių.',
            'name.alpha' => 'Vardas tik iš raidžių.',
            'surname.min' => 'Prailginti pavardę iki 3 raidžių.',
            'surname.alpha' => 'Pavardė tik iš raidžių.',
         ]);

        if ($validator->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validator);
        }
        
        $client->name = $request->name;
        $client->surname = $request->surname;
        $client->save();
        return redirect()
        ->route('clients-index', $request->session()->get('last-client-view', []))
        ->with('ok', 'Klientas paturbintas')
        ->with('light-up', $client->id);
    }


    public function destroy(Request $request, Client $client)
    {
        
        if (!$request->confirm && $client->account->count()) {
            return redirect()
            ->back()
            ->with('delete-modal', [
                'Klientas turi sąskaitų. Ar tikrai norite ištrinti?',
                $client->id
            ]);
        }
        
        
        $client->delete();
        return redirect()
        ->route('clients-index')
        ->with('info', 'Klientas pašalintas');
    }
}