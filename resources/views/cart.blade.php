@extends('master')

@section('page_title', 'Cart')
@section('page_id', 'cart')

<?php
    $page_id = "cart";
?>

@section('content')

<section id="tile-cart">
    @if($cartItems)
        <div class="container">
            @include('errors.errors')
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
                <div class="span1 item-remove">
                    Remove
                </div>
                <div class="span1 item-price">
                    Price
                </div>
            </div>
            <div class="row cart-items">
                <!-- Loop foreach cart-item -->
                    @foreach($cartItems as $key => $item)
                        <div class="row cart-item">
                            <div class="span3 item-name">
                                {{ $item->name }}
                            </div>
                            <div class="span6 item-desc">
                                {{ $item->description }}
                            </div>
                            <div class="span1 item-qty">
                                <input class="qty-input" autocomplete="off" data-product="{{ $key }}" value="{{ $item->amount }}"/>
                            </div>
                            <div class="span1 item-remove">
                                <button class="secondary-btn removeButton">Remove</button>
                            </div>
                            <div class="span1 item-price">
                                {{ $item->display_price }}
                            </div>
                        </div>
                    @endforeach
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
                    <button type="button" class="secondary-btn updateButton">UPDATE</button>
                </div>
                <div class="right-btns">
                    <a href="/checkout" class="primary-btn">SECURE CHECKOUT</a>
                    <br>
                    <a href="{{env('APP_URL')}}/paypal"><img id="paypalButton" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-medium.png" alt="Check out with PayPal" /></a>
                    <br>
                    <img id="paypalBadges" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/cc-badges-ppmcvdam.png" alt="Buy now with PayPal"/>
                </div>
            </div>
        </div>
    @else
        <div style="margin-left: 1em; text-align: center">
            <p>You have no items in your cart</p>
        </div>
    @endif
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
                productAmount = $(this).val();

                updatedCart.push({productName:productName, productAmount:productAmount});
            });

            $.ajax({
                type: "POST",
                url: "./cartUpdate",
                data: {cartData: updatedCart},
                success: function(result,status,xhr) {
                    location.reload();
                },
                error: function(xhr,status,error) {
                    console.log(error);
                }
            });
        });

        $('.removeButton').on('click', function() {
            $(this).parent().parent().find('.qty-input').val(0);
            $('.updateButton').click();
        })
    </script>
</section>

@endsection
