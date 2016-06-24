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
            @if($cartItems)
                @foreach($cartItems as $item)
                    <div class="row cart-item">
                        <div class="span3 item-name">
                            {{ $item->name }}
                        </div>
                        <div class="span6 item-desc">
                            {{ $item->description }}
                        </div>
                        <div class="span1 item-qty">
                            <input class="qty-input" value="1"/>
                        </div>
                        <div class="span2 item-price">
                            {{ $item->price }}
                            {{-- {{ money_format('$', floatval($item->skus->data[0]->price)) }} --}}
                        </div>
                        <div class="remove-btn">
                            x
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="row cart-totals">
            <div class="cart-subtotal">
                Subtotal: $00.00
            </div>
        </div>
        <div class="row cart-btns">
            <div class="left-btns">
                <a href="/product" class="secondary-btn">CONTINUE SHOPPING</a>
                <a href="#" class="secondary-btn">UPDATE</a>
            </div>
            <div class="right-btns">
                <a href="/checkout" class="primary-btn">CHECKOUT</a>
            </div>
        </div>
    </div>
</section>

@endsection
