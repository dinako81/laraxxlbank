@extends('layouts.app')

@section('content')


<div class="container" style="font-size: 13px">

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-1">
                <div class="card-header grey">
                    <h1>Orders List</h1>
                </div>

                {{-- <form action="{{route('accounts-index')}}" method="get"> --}}

                {{--
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
        </div> --}}

        {{-- <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label">Filter</label>
                                <select class="form-select" name="filter">
                                    @foreach($filterSelect as $value => $text)
                                    <option value="{{$value}}" @if($value===$filter) selected @endif>{{$text}}</option>
        @endforeach
        </select>
        <div class="form-text">Please select your filter preferences</div>
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
</div> --}}

{{-- <div class="col-2">
                    <div class="sort-filter-buttons">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{route('accounts-index')}}" class="btn btn-danger">clear</a>
</div>
</div>

</div>
</form>

</div> --}}


{{-- <div class="col-2">
    <div class="sort-filter-buttons">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{route('accounts-index')}}" class="btn btn-danger">clear</a>
</div>
</div>

</div>
</div> --}}


<div class="card-body grey">
    <ul class="list-group">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"><b>ID</b></th>
                    <th scope="col"><b>Title</b></th>
                    <th scope="col"><b>Price</b></th>
                    <th scope="col"><b>Name, Surname</b></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

                @forelse($accounts as $account)
                <tr>
                    <div class="account-info">
                        <div class="account-data">
                            <td> ++ </td>
                            <td> {{$account->title}} </td>
                            <td> {{$account->price}}</td>
                        </div>

                        <td>
                            <a class="client" href="{{route('clients-show', $account->accountClient)}}">
                                {{$account->accountClient->name}} {{$account->accountClient->surname}}
                            </a>
                        </td>
                    </div>

                    <td> <a href="{{route('accounts-show', $account)}}" class="btn btn-info">Show</a></td>
                    <td> <a href="{{route('accounts-edit', $account)}}" class="btn btn-success">Edit</a></td>

                    <td>
                        <form action="{{route('accounts-delete', $account)}}" method="post">
                            <button type="submit" class="btn btn-danger btn-outline-dark" style="font-size: 12px">Delete</button>
                            @csrf
                            @method('delete')
                        </form>
                    </td>
                </tr>
                </li>
                @empty
                <li class="list-group-item">
                    <div class="account-line">No accounts</div>
                </li>
                @endforelse

            </tbody>
    </ul>
</div>
</div>

{{-- <div class="m-2">
                {{ $accounts->links() }}
</div> --}}

</div>
</div>
</div>
@endsection
