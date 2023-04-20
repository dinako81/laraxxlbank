@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Banko satistika:') }}</div>
                <div class="card-header">klientų skaičius: [{{$client->account->count()}}]</div>
                <div class="card-header">klientų sąskaitų skaičius [{{$client->account->count()}}]</div>
                <div class="card-header">bendra laikoma suma</div>
                <div class="card-header">didžiausia suma vienoje sąskaitoje</div>
                <div class="card-header">vidutinė sąskaitų suma</div>
                <div class="card-header">sąskaitų su 0 likučių kiekis</div>
                <div class="card-header">sąskaitų su minusiniu likučiu kiekis</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{$client->name}}{{$client->surname}} {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
