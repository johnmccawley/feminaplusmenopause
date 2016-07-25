@extends('master')

@section('page_title', 'Receipt')
@section('page_id', 'receipt')

<?php
    $page_id="receipt";
    $billing_address_2 = ($request->input('billing-address-2')) ? $request->input('billing-address-2') : null;
    $shipping_address_2 = ($request->input('shipping-address-2')) ? $request->input('shipping-address-2') : null;
?>

@section('content')
    <section id="tile-cart">
        <div>
            THANK YOU FOR PURCHASING FEMINA PLUS!
        </div>
        <div class="container">
            Billing Information:
            First Name: {{ $request->input('billing-name-first') }}
            Last Name: {{ $request->input('billing-name-last') }}
            Email: {{ $request->input('billing-email') }}
            Phone: {{ $request->input('billing-phone') }}
            Address One: {{ $request->input('billing-address-1') }}
            Address Two: {{ $billing_address_2 }}
            City: {{ $request->input('billing-city') }}
            State: {{ $request->input('billing-state') }}
            Zip: {{ $request->input('billing-zip') }}
            <br />
            Shipping Information:
            First Name: {{ $request->input('shipping-name-first') | $request->input('billing-name-first') }}
            Last Name: {{ $request->input('shipping-name-last') | $request->input('billing-name-last')}}
            Email: {{ $request->input('shipping-email') | $request->input('billing-email') }}
            Phone: {{ $request->input('shipping-phone') | $request->input('billing-phone') }}
            Address One: {{ $request->input('shipping-address-1') | $request->input('billing-address-1') }}
            Address Two: {{ $shipping_address_2 }}
            City: {{ $request->input('shipping-city') | $request->input('billing-city') }}
            State: {{ $request->input('shipping-state') | $request->input('billing-state') }}
            Zip: {{ $request->input('shipping-zip') | $request->input('billing-zip') }}
        </div>
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
                    @foreach($cartItems as $key => $item)
                        <div class="row cart-item">
                            <div class="span3 item-name">
                                {{ $item->name }}
                            </div>
                            <div class="span6 item-desc">
                                {{ $item->description }}
                            </div>
                            <div class="span1 item-qty">
                                {{ $item->amount }}
                            </div>
                            <div class="span2 item-price">
                                {{ $item->display_price }}
                            </div>
                        </div>
                    @endforeach
            </div>
            <div class="row cart-totals">
                <div class="cart-subtotal">
                    @if($total)
                        Total: {{ $total }}
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
