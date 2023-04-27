@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">

            <div class="card-header grey">
                <h1>Pinigų pervedimai</h1>
            </div>
            <div class="card-body grey">
                <form action="{{route('funds-fundstransfer')}}" method="post">
                    <label class="form-label">
                        <h3>Iš sąskaitos:</h3>
                    </label>
                    <select class="form-select" name="from_id">
                        <option value="0">Sąskaitų sąrašas</option>
                        @foreach($accounts as $account)
                        <option value="{{ $account->id }}">
                            <tr><i> {{$account->acc_number}} </i> </tr>
                            <tr><b> {{number_format($account->acc_balance, 2, ',', ' ')}} Eur </b></tr>
                            @foreach($clients as $client)
                            @if($account->client_id == $client->id)
                            {{$client->name}}
                            {{$client->surname}}
                            @endif
                            @endforeach
                        </option>
                        @endforeach
                    </select>

                    <label class="form-label">
                        <h3>Iš sąskaitos:</h3>
                    </label>
                    <select class="form-select" name="to_id">
                        <option value="0">Sąskaitų sąrašas</option>
                        @foreach($accounts as $account)
                        <option value="{{ $account->id }}">
                            <tr><i> {{$account->acc_number}} </i> </tr>
                            <tr><b> {{number_format($account->acc_balance, 2, ',', ' ')}} Eur </b></tr>
                            @foreach($clients as $client)
                            @if($account->client_id == $client->id)
                            {{$client->name}}
                            {{$client->surname}}
                            @endif
                            @endforeach
                        </option>
                        @endforeach
                    </select>

                    <div class="mb-3">
                        <label class="form-label">Pavedimo suma</label>
                        <input type="text" class="form-control" name="acc_balance">
                    </div>

                    <button type="submit" class="btn btn-outline-dark brown btn2">Pervesti</button>
                    @csrf
                    @method('put')
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
