@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card mt-5 shadow">
                <div class="card-header grey">
                    <h1>Pridėti pinigų</h1>
                </div>
                <div class="card-body grey">
                    <form action="{{route('clients-addfunds', $client)}}" method="post">
                        <div class="mb-3">
                            Vardas: <b> {{$client->name}} </b>
                        </div>
                        <div class="mb-3">
                            Pavardė: <b> {{$client->surname}} </b>
                        </div>
                        <div class="mb-3">
                            {{-- Account number: <b> {{$account->acc_number}} </b> --}}
                        </div>
                        <div class="mb-3">
                            Sąskaitos Likutis: <b> {{number_format($client->acc_balance, 2, ',', ' ')}} Eur </b>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control brown" name="acc_balance" value="">
                        </div>
                        <button type="submit" class="btn btn-outline-dark brown">Pridėti pinigų</button>
                        @csrf
                        @method('put')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
