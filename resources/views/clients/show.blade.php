@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Klientas</h1>
                </div>
                <div class="card-body">
                    <div class="client-line">
                        <div class="client-info">
                            {{$client->name}}
                            {{$client->surname}}
                        </div>
                        <div class="buttons">
                            <a href="{{route('accounts-create', ['id' => $client])}}" class="btn btn-info">Nauja sąskaita</a>
                            <a href="{{route('clients-edit', $client)}}" class="btn btn-success btn-outline-dark">Redaguoti</a>
                            <form action="{{route('clients-delete', $client)}}" method="post">
                                <button type="submit" class="btn btn-danger btn-outline-dark">Ištrinti</button>
                                @csrf
                                @method('delete')
                            </form>
                        </div>
                    </div>
                    <h2>Sąskaitos</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><b>Sąskaitos numeris</b></th>
                                <th scope="col"><b>Sąskaitos likutis</b></th>
                                <th scope="col"></th>
                                <td>
                        </thead>
                        <tbody>
                            @forelse($client->account as $account)

                            <tr>
                                <td> {{$account->acc_number}}</td>
                                <td><b><i> {{number_format($account->acc_balance, 2, ',', ' ')}} </i> </b></td>
                                <td></td>

                                <div class="buttons show-buttons">
                                    <td>
                                        <form action="{{route('accounts-delete', $account)}}" method="post">
                                            <button type="submit" class="btn btn-danger btn-outline-dark">Ištrinti</button>
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                    <td><a href="{{route('clients-addfunds', $account)}}" class="btn btn-outline-dark">Pridėti lėšų</a></td>
                                    <td><a href="{{route('clients-withdrawfunds', $account)}}" class="btn btn-outline-dark">Išimti lėšų</a></td>
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
