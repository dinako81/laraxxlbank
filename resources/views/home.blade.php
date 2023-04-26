@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Banko satistika:') }}</div>
                <div class="card-header">klientų skaičius: [{{$client->count()}}]</div>
                <div class="card-header">klientų sąskaitų skaičius: [{{$account->count()}}]</div>
                <div class="card-header">bendra laikoma suma: {{number_format($totalMoney, 2, ',', ' ')}} Eur</div>
                <div class="card-header">didžiausia suma vienoje sąskaitoje: <b> {{ number_format($biggestAmount['amount'], 2, ',', ' ')  }} Eur </b>, {{ $biggestAmount['iban'] }}</div>
                <div class="card-header">vidutinė sąskaitų suma: {{$averageMoney}} Eur</div>
                <div class="card-header">sąskaitų su 0 likučių kiekis: {{$countZeroMoneyAccounts}}</div>
                <div class="card-header">sąskaitų su minusiniu likučiu kiekis : {{$negativeCount}}</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
