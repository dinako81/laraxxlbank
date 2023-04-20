@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card mt-5">
                <div class="card-header grey">
                    <h1>Withdraw Funds</h1>
                </div>
                <div class="card-body grey">
                    <form action="{{route('clients-withdrawfunds', $client)}}" method="post">
                        <div class="mb-3">
                            Vardas, pavardė: <b> {{$client->name}} {{$client->surname}}</b>
                        </div>
                        <div class="mb-3">
                            Sąskaitos numeris: <b> {{$client->acc_number}} </b>
                        </div>
                        <div class="mb-3">
                            Sąskaitos likutis: <b> {{number_format($client->acc_balance, 2, ',', ' ')}} Eur </b>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control brown" name="acc_balance" value="">
                        </div>
                        <button type="submit" class="btn btn-outline-dark brown">Išimti lėšų</button>
                        @csrf
                        @method('put')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
