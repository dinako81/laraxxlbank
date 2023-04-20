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

   
    public function index(Client $client)
    {
        $clients = Client::all();
        return view('home', [
            'client' => $client,         
        ]);

    }
}