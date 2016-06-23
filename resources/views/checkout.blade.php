@extends('master')

@section('page_title', 'Checkout')
@section('page_id', 'checkout')

<?php
    $page_id = "checkout";
?>

@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @include('errors.errors')
                <form action="{{ action('PagesController@postOrder') }}" id="payment-form" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Name"/>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="cardNumber" maxlength="16" placeholder="Card number"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="expiration" placeholder="MM / YYYY"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="cvc" maxlength="6" placeholder="CVC"/>
                    </div>

                    <div class="form-group">
                        <button type="submit" id="submitBtn" class="primary-btn" style="margin-bottom: 10px;">Place Order</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>

@endsection
