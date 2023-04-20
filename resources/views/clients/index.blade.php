@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Clients List</h1>

                    <form action="{{route('clients-index')}}" method="get">

                        <div class="container">
                            <div class="row">

                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Sort</label>
                                        <select class="form-select" name="sort">
                                            @foreach($sortSelect as $value => $text)
                                            <option value="{{$value}}" @if($value===$sort) selected @endif>{{$text}}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-text">Please select your sort preferences</div>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="mb-3">
                                        <label class="form-label">Results per page</label>
                                        <select class="form-select" name="per">
                                            @foreach($perSelect as $value => $text)
                                            <option value="{{$value}}" @if($value===$per) selected @endif>{{$text}}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-text">View preferences</div>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="sort-filter-buttons">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{route('clients-index')}}" class="btn btn-danger">clear</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"><b>ID</b></th>
                            <th scope="col"><b>Name, Surname</b></th>
                            <th scope="col"><b>Personal code</b></th>
                            <th scope="col">Accounts</th>
                            <th scope="col"><b>Accounts balance, Eur</b></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($clients as $client)
                        <tr>
                            <td> {{$client->id}} </td>
                            <td> {{$client->name}} {{$client->surname}}</td>
                            <td> {{$client->personal_code}}</td>
                            <td>[{{$client->account->count()}}]</td>
                            <td><b><i> {{number_format($client->acc_balance, 2, ',', ' ')}} </i> </b></td>
                            <div class="buttons">
                                <td><a href="{{route('clients-show', $client)}}" class="btn btn-info">Show</a></td>
                                <td><a href="{{route('clients-edit', $client)}}" class="btn btn-success">Edit</a></td>
                                <td>
                                    <form action="{{route('clients-delete', $client)}}" method="post">
                                        <button type="submit" class="btn btn-danger btn-outline-dark">delete</button>
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </div>
                        </tr>

                        @empty
                        {{-- <li class="list-group-item">
                                    <div class="client-line">No clients</div>
                                </li> --}}
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="m-2">
                {{ $clients->links() }}
            </div>

        </div>
    </div>
</div>


< @endsection
