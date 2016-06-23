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
                    <input class="qty-input" />
                </div>
                <div class="span2 item-price">
                    $00.00
                </div>
                <div class="remove-btn">
                    x
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
                    <input class="qty-input" />
                </div>
                <div class="span2 item-price">
                    $00.00
                </div>
                <div class="remove-btn">
                    x
                </div>
            </div>
        </div>
        <div class="row cart-totals">
            <div class="cart-subtotal">
                Subtotal: $00.00
            </div>
        </div>
        <div class="row cart-btns">
            <div class="left-btns">
                <a href="#" class="secondary-btn">CONTINUE SHOPPING</a>
                <a href="#" class="secondary-btn">UPDATE</a>
            </div>
            <div class="right-btns">
                <a href="#" class="primary-btn">CHECKOUT</a>
            </div>
        </div>
    </div>
</section>

@endsection
