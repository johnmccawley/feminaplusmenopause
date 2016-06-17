@extends('master')

@section('page_title', 'Cart')
@section('page_id', 'cart')

<?php
    $page_id = "cart";
?>

@section('content')

<section id="tile-cart">
    <div class="container">
        <div class="row cart-header">
            <div class="span3 item-name">
                Item
            </div>
            <div class="span6 item-desc">
                Description
            </div>
            <div class="span1 item-qty">
                Quantity
            </div>
            <div class="span2 item-price">
                Price
            </div>
        </div>
        <div class="row cart-items">
            <!-- Loop foreach cart-item -->
            <div class="row cart-item">
                <div class="span3 item-name">
                    Single Bottle
                </div>
                <div class="span6 item-desc">
                    Lorem Ipsum
                </div>
                <div class="span1 item-qty">
                    1
                </div>
                <div class="span2 item-price">
                    $00.00
                </div>
            </div>
            <div class="row cart-item">
                <div class="span3 item-name">
                    Single Bottle
                </div>
                <div class="span6 item-desc">
                    Lorem Ipsum
                </div>
                <div class="span1 item-qty">
                    1
                </div>
                <div class="span2 item-price">
                    $00.00
                </div>
            </div>
        </div>
        <div class="row cart-totals">
            
        </div>
    </div>
</section>

@endsection
