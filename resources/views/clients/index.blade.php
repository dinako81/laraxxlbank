@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Klientų sąrašas</h1>

                    <form action="{{route('clients-index')}}" method="get">
                        <div class="container">
                            <div class="row">

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Rūšiuoti</label>
                                        <select class="form-select" name="sort">
                                            @foreach($sortSelect as $value => $text)
                                            <option value="{{$value}}" @if($value===$sort) selected @endif>{{$text}}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-text">Pasirinkite rūšiavimo nuostatas</div>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Filtras</label>
                                        <select class="form-select" name="filter">
                                            @foreach($filterSelect as $value => $text)
                                            <option value="{{$value}}" @if($value===$filter) selected @endif>{{$text}}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-text">Pasirinkite filtravimo nuostatas</div>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Rezultatai puslapyje</label>
                                        <select class="form-select" name="per">
                                            @foreach($perSelect as $value => $text)
                                            <option value="{{$value}}" @if($value===$per) selected @endif>{{$text}}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-text">Peržiūrėti nuostatas</div>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="sort-filter-buttons">
                                        <button type="submit" class="btn btn-primary">Pateikti</button>
                                        <a href="{{route('clients-index')}}" class="btn btn-danger">Ištrinti</a>
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
                            <th scope="col"><b>Vardas, pavardė</b></th>
                            <th scope="col">Sąskaitų kiekis</th>
                            <th scope="col">Sąskaitų sąrašas</th>
                            <th scope="col"><b>Bendras sąskaitų likutis, Eur</b></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($clients as $client)
                        <tr>
                            <td> {{$client->id}} </td>
                            <td> {{$client->name}} {{$client->surname}}</td>
                            <td> @if($client->account->count()!== 0)
                                {{$client->account->count()}}
                                @endif </td>
                            <td>
                                @foreach($accounts as $account)
                                @if($client->id == $account->client_id)
                                {{$account->acc_number}} </br>
                                @endif
                                @endforeach
                            </td>
                            <td>
                                0 money </td>
                            <div class="buttons">
                                <td><a href="{{route('clients-show', $client)}}" class="btn btn-info">Peržiūra</a></td>
                                <td><a href="{{route('clients-edit', $client)}}" class="btn btn-success">Redaguoti</a></td>
                                <td>
                                    <form action="{{route('clients-delete', $client)}}" method="post">
                                        <button type="submit" class="btn btn-danger btn-outline-dark">Ištrinti</button>
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>

                        </tr>

                        @empty
                        <li class="list-group-item">
                            <div class="client-line">No clients</div>
                        </li>
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


@endsection
