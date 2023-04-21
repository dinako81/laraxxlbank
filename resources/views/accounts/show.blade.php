@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Sąskaita</h1>
                </div>
                <div class="card-body">
                    <div class="client-line">
                        <div class="client-info">
                            {{$account->acc_number}}
                            {{$account->acc_balance}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
