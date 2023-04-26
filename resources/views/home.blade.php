@extends('layouts.app')

@section('content')
<div class="container grey">
    <div class="row justify-content-center">
        <div class="col-md-8 grey">
            <div class="card grey">
                <div class="card-header">
                    <h2><i>{{ __('Banko satistika:') }} </i></h2>
                </div>
                <div class="card-header">Klientų skaičius: <b> {{$client->count()}}.</b></div>
                <div class="card-header">Klientų sąskaitų skaičius: <b>{{$account->count()}}.</b></div>
                <div class="card-header">Bendra laikoma suma: <b>{{number_format($totalMoney, 2, ',', ' ')}} Eur. </b></div>
                <div class="card-header">Didžiausia suma vienoje sąskaitoje: <b> {{ number_format($biggestAmount['amount'], 2, ',', ' ')  }} Eur , <i>{{ $biggestAmount['iban'] }}.</i></b></div>
                <div class="card-header">Vidutinė sąskaitų suma: <b> {{ number_format($averageMoney, 2, ',', ' ')}} Eur. </b> </div>
                <div class="card-header">Sąskaitų su 0 likučių kiekis: <b>{{$countZeroMoneyAccounts}}.</b></div>
                <div class="card-header">Sąskaitų su minusiniu likučiu kiekis: <b>{{$negativeCount}}.</b></div>
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
