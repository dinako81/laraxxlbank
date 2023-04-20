@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Accounts List</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($accounts as $account)
                        <li class="list-group-item">
                            <div class="account-line @if(Session::has('light-up') && Session::get('light-up') ==  $account->id) active @endif">
                                <div class="account-info">
                                    <div class="account-data">
                                        {{$account->acc_number}}

                                    </div>
                                    <a class="client" href="{{route('clients-show', $account->accountClient)}}">
                                        {{$account->accountClient->name}} {{$account->accountClient->surname}}
                                    </a>
                                </div>
                                <div class="buttons">
                                    <a href="{{route('accounts-show', $account)}}" class="btn btn-info">Show</a>
                                    <a href="{{route('accounts-edit', $account)}}" class="btn btn-success">Edit</a>
                                    <form action="{{route('accounts-delete', $account)}}" method="post">
                                        <button type="submit" class="btn btn-danger">delete</button>
                                        @csrf
                                        @method('delete')
                                    </form>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">
                            <div class="account-line">No accounts</div>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
