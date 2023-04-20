@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header grey">
                    <h1>Pinigų pervedimai</h1>
                </div>
                <div class="card-body grey">
                    <form action="{{route('funds-fundstransfer')}}" method="post">
                        <label class="form-label">Iš sąskaitos:</label>
                        <select class="form-select" name="client_id">
                            <option value="0">Sąskaitų sąrašas</option>
                            @foreach($clients as $client)
                            <option value="">
                                {{$client->name}}
                                @foreach($accounts as $account)
                                @if($client->id == $account->client_id)

                                {{$account->acc_number}}
                                {{$account->acc_balance}}
                                @endif
                                @endforeach
                            </option>

                            @endforeach
                        </select>

                        <label class="form-label">Į sąskaita:</label>
                        <select class="form-select" name="client_id">
                            <option value="0">Sąskaitų sąsrašas</option>
                            @foreach($accounts as $account)
                            <option value="">
                                {{$account->acc_number}}</option>
                            @endforeach
                        </select>
                        <div class="mb-3">
                            <input type="text" class="form-control brown" name="acc_balance" value="">
                        </div>
                        <button type="submit" class="btn btn-outline-dark brown">Pinigų pervedimas</button>
                        @csrf
                        @method('put')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
