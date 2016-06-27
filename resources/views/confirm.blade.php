@extends('master')

@section('page_title', 'Confirm Order')
@section('page_id', 'confirm')

<?php
    $page_id = "confirm";
?>

@section('content')

<section id="tile-confirm">
    <div class="container">
        <div class="row order-info">
            <h3>Order Summary</h3>
            <div class="row order-item">
                <div class="span4 order-item-name">
                    1
                </div>
                <div class="span4 order-item-qty">
                    2
                </div>
                <div class="span4 order-item-price">
                    3
                </div>
            </div>
            <div class="row order-item">
                <div class="span4 order-item-name">
                    1
                </div>
                <div class="span4 order-item-qty">
                    2
                </div>
                <div class="span4 order-item-price">
                    3
                </div>
            </div>
        </div>
        <div class="row customer-info">
            <div class="span6">
                <h3>Shipping Address</h3>
                <div class="shipping-info">
                    <div class="shipping-name">
                        First Last
                    </div>
                    <div class="shipping-address">
                        123 Street Rd.
                    </div>
                    <div class="shipping-city">
                        Detroit, Michigan 48185
                    </div>
                    <div class="shipping-phone">
                        (734) 867 - 5309
                    </div>
                </div>
            </div>
            <div class="span6">
                <h3>Billing Address</h3>
                <div class="billing-info">
                    <div class="billing-name">
                        First Last
                    </div>
                    <div class="billing-address">
                        123 Street Rd.
                    </div>
                    <div class="billing-city">
                        Detroit, Michigan 48185
                    </div>
                    <div class="billing-phone">
                        (734) 867 - 5309
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
