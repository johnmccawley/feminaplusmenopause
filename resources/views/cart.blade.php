@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <a href="{{ url('/checkout') }}">
                    <button type="button" class="btn btn-primary btn-order" style="margin: 10px;">Checkout</button>
                </a>

            </div>
        </div>
    </div>
</div>
@endsection
