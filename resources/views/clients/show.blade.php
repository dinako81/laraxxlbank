@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Client</h1>
                </div>
                <div class="card-body">
                    <div class="client-line">
                        <div class="client-info">
                            {{$client->name}}
                            {{$client->surname}}
                        </div>
                        <div class="buttons">
                            <a href="{{route('accounts-create', ['id' => $client])}}" class="btn btn-info">new account</a>
                            <a href="{{route('clients-edit', $client)}}" class="btn btn-success">Edit</a>
                            <form action="{{route('clients-delete', $client)}}" method="post">
                                <button type="submit" class="btn btn-danger">delete</button>
                                @csrf
                                @method('delete')
                            </form>
                        </div>
                    </div>
                    <h2>Accounts</h2>

                    @forelse($client->account as $account)
                    <li class="list-group-item">
                        <div class="account-line">
                            <div class="account-info">
                                <table>
                                    <thead>
                                        <tr>
                                            <th scope="col"><b>Account number</b></th>
                                            <th scope="col"><b>Account balance</b></th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> {{$account->acc_number}} </td>
                                            <td> {{number_format($client->acc_balance, 2, ',', ' ')}} Eur </td>
                                            <div class="buttons show-buttons">
                                                <td>
                                                    <form action="{{route('accounts-delete', $account)}}" method="post">
                                                        <button type="submit" class="btn btn-danger">delete</button>
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </td>
                                                <td> <a href="{{route('clients-addfunds', $client)}}" class="btn btn-outline-dark brown" style="font-size: 12px">Add Funds</a></td>
                                                <td><a href="{{route('clients-withdrawfunds', $client)}}" class="btn btn-outline-dark brown" style="font-size: 12px">Withdraw Funds</a></td>
                                            </div>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </li>

                    @empty
                    <li class="list-group-item">
                        <div class="client-line">No accounts</div>
                    </li>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
