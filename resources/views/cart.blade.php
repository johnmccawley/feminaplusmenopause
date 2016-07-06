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
                @foreach($cartItems as $key => $item)
                    <div class="row cart-item">
                        <div class="span3 item-name">
                            {{ $item->name }}
                        </div>
                        <div class="span6 item-desc">
                            {{ $item->description }}
                        </div>
                        <div class="span1 item-qty">
                            <input class="qty-input" data-product="{{ $key }}" value="{{$item->amount}}"/>
                        </div>
                        <div class="span2 item-price">
                            {{ $item->display_price }}
                        </div>
                        <div class="remove-btn">
                            x
                        </div>
                    </div>
                @endforeach
            @else
                <div style="margin-left: 1em">
                    <p>You have no items in your cart</p>
                </div>
            @endif
        </div>
        <div class="row cart-totals">
            <div class="cart-subtotal">
                @if($total)
                    {{ $total }}
                @endif
            </div>
        </div>
        <div class="row cart-btns">
            <div class="left-btns">
                <a href="/product" class="secondary-btn">CONTINUE SHOPPING</a>
                <button type="button" class="secondary-btn updateButton">UPDATE</a>
            </div>
            <div class="right-btns">
                <a href="/checkout" class="primary-btn">CHECKOUT</a>
            </div>
        </div>
    </div>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.updateButton').on('click', function() {
            var productName, productAmount, updatedCart = [];
            $('.qty-input').each(function(element) {
                productName = $(this).data('product');
                productAmount = $(this).attr('value');

                updatedCart.push({productName:productName, productAmount:productAmount});
            });

            $.ajax({
                type: "POST",
                url: "./cartUpdate",
                data: {cartData: updatedCart},
                success: function() {
                    console.log('Ajax call succeeded');
                },
                error: function() {
                    console.log('Ajax call failed');
                }
            });
        });
    </script>
</section>

@endsection
