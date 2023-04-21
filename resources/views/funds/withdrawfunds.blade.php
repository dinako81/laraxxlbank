@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card mt-5">
                <div class="card-header grey">
                    <h1>Išimti pinigų</h1>
                </div>
                <div class="card-body grey">
                    <form action="{{route('clients-withdrawfunds', $account)}}" method="post">
                        <div class="mb-3">
                            Vardas: <b> {{$account->accountClient->name}} </b>
                        </div>
                        <div class="mb-3">
                            Pavardė: <b> {{$account->accountClient->surname}} </b>
                        </div>
                        <div class="mb-3">
                            Sąskaitos numeris: <b> {{$account->acc_number}} Eur </b>
                        </div>
                        <div class="mb-3">
                            Sąskaitos likutis: <b> {{number_format($account->acc_balance, 2, ',', ' ')}} Eur </b>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control brown" name="acc_balance" value="">
                        </div>
                        <button type="submit" class="btn btn-outline-dark brown">Išimti pinigų</button>
                        @csrf
                        @method('put')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
