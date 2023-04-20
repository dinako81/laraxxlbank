@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card mt-5 shadow">
                <div class="card-header grey">
                    <h1>Add Funds</h1>
                </div>
                <div class="card-body grey">
                    <form action="{{route('clients-addfunds', $client)}}" method="post">
                        <div class="mb-3">
                            Name: <b> {{$client->name}} </b>
                        </div>
                        <div class="mb-3">
                            Surname: <b> {{$client->surname}} </b>
                        </div>
                        {{-- <div class="mb-3">
                            Account number: <b> {{$account->acc_number}} </b>
                </div> --}}
                <div class="mb-3">
                    Account balance: <b> {{number_format($account->acc_balance, 2, ',', ' ')}} Eur </b>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control brown" name="acc_balance" value="">
                </div>
                <button type="submit" class="btn btn-outline-dark brown">Add Funds</button>
                @csrf
                @method('put')
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
