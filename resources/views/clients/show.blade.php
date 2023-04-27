@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-">
            <div class="card mt-5">
                <div class="card-header grey">
                    <h3>Klientas:</h3>
                </div>
                <div class="card-body grey">
                    <div class="client-line">
                        <div class="client-info">
                            <h1><i>{{$client->name}}
                                    {{$client->surname}}</i></h1>
                        </div>
                        <div class="buttons">
                            <a href="{{route('accounts-create', ['id' => $client])}}" class="btn btn-outline-dark btn2 brown">Nauja sąskaita</a>
                            <a href="{{route('clients-edit', $client)}}" class="btn btn-outline-dark btn-outline-dark btn2 brown">Redaguoti</a>
                            <form action="{{route('clients-delete', $client)}}" method="post">
                                <button type="submit" class="btn btn-outline-dark btn2 text-danger">Ištrinti</button>
                                @csrf
                                @method('delete')
                            </form>
                        </div>
                    </div>
                    <h3>Sąskaitos:</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><b>Sąskaitos numeris</b></th>
                                <th scope="col"><b>Sąskaitos likutis</b></th>
                                <th scope="col"></th>


                        </thead>
                        <tbody>
                            @forelse($client->account as $account)
                            <tr>
                                <td> {{$account->acc_number}}</td>
                                <td><b><i> {{number_format($account->acc_balance, 2, ',', ' ')}} </i> </b></td>
                                <td>
                                    <div class="buttons show-buttons">
                                        <form action="{{route('funds-taxes', $account)}}" method="post">
                                            <button type="submit" class="btn  btn-outline-dark butn2 brown">Mokesčiai</button>
                                            @csrf
                                            @method('put')
                                        </form>
                                        <a href="{{route('clients-addfunds', $account)}}" class="btn btn-outline-dark brown btn2">Pridėti lėšų</a>
                                        <a href="{{route('clients-withdrawfunds', $account)}}" class="btn btn-outline-dark brown btn2">Išimti lėšų</a>

                                        <form action="{{route('accounts-delete', $account)}}" method="post">
                                            <button type="submit" class="btn  btn-outline-dark text-danger">Ištrinti</button>
                                            @csrf
                                            @method('delete')
                                        </form>
                                </td>

                </div>
                </tr>

                @empty
                <li class="list-group-item">
                    <div class="client-line">No accounts</div>
                </li>
                @endforelse


                </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
</div>
</div>
</div>

@endsection
