@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header grey">
                    <h1>Sąskaitų sąrašas</h1>
                </div>
                <div class="card-body grey">
                    @forelse($accounts as $account)
                    <div class="account-line @if(Session::has('light-up') && Session::get('light-up') ==  $account->id) active @endif">
                        <div class="account-info">
                            <div class="account-data">
                                {{$account->client_id}}
                                {{$account->acc_number}}
                                {{number_format($account->acc_balance, 2, ',', ' ')}} Eur

                            </div>
                            <a class="client" href="{{route('accounts-show', $account->accountClient)}}" style="font-size: 12px">
                                {{$account->accountClient->name}} {{$account->accountClient->surname}}
                            </a>
                        </div>
                        <div class="buttons show-buttons">
                            <a href="{{route('accounts-show', $account)}}" class="btn btn-outline-dark btn2 brown">Peržiūra</a>
                            <form action="{{route('accounts-delete', $account)}}" method="post">
                                <button type="submit" class="btn btn-outline-dark btn2 brown ">Ištrinti</button>
                                @csrf
                                @method('delete')
                            </form>
                        </div>
                    </div>

                    @empty
                    <li class="list-group-item">
                        <div class="account-line">Nėra sąskaitų</div>
                    </li>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
