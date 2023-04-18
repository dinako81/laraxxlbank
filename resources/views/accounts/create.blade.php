@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Add Account</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('accounts-store')}}" method="post">

                        <div class="mb-3">
                            <label class="form-label">Client</label>
                            <select class="form-select" name="client_id">
                                <option value="0">Clients list</option>
                                @foreach($clients as $client)
                                <option value="{{$client->id}}" @if($client->id == $id) selected @endif>
                                    {{$client->name}} {{$client->surname}}</option>
                                @endforeach
                            </select>
                            <div class="form-text">Please select client</div>

                            <div class="mb-3">
                                <label class="form-label">Account number</label>
                                <input readonly type="text" class="form-control brown" name="acc_number" value="<?= $acc_number ?>">
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
