@extends('master')

@section('page_title', 'Receipt')
@section('page_id', 'receipt')

<?php
    $page_id="receipt";
?>

@section('content')
    <section id="tile-receipt">
        <div class="container">
            <h2>THANK YOU FOR PURCHASING FEMINA PLUS!</h2>
        </div>
        <br>
        <div id="info-div" class="container">
            <div id="billing-info">
                @if(isset($customerData->billing))
                    <h3>Billing Information</h3>
                    <p>First Name: {{ $customerData->billing->firstName }}</p>
                    <p>Last Name: {{ $customerData->billing->lastName }}</p>
                    <p>Email: {{ $customerData->billing->email }}</p>
                    <p>Phone: {{ $customerData->billing->phone }}</p>
                    <p>Address One: {{ $customerData->billing->addressOne }}</p>
                    @if($customerData->billing->addressTwo)
                        <p>Address Two: {{ $customerData->billing->addressTwo }}</p>
                    @endif
                    <p>City: {{ $customerData->billing->city }}</p>
                    <p>State: {{ $customerData->billing->state }}</p>
                    <p>Zip: {{ $customerData->billing->zip }}</p>
                @endif
            </div>

            <div id="shipping-info">
                <h3>Shipping Information</h3>
                <p>First Name: {{ $customerData->shipping->firstName }}</p>
                <p>Last Name: {{ $customerData->shipping->lastName }}</p>
                <p>Email: {{ $customerData->shipping->email }}</p>
                <p>Phone: {{ $customerData->shipping->phone }}</p>
                <p>Address One: {{ $customerData->shipping->addressOne }}</p>
                @if($customerData->shipping->addressTwo)
                    <p>Address Two: {{ $customerData->shipping->addressTwo }}</p>
                @endif
                <p>City: {{ $customerData->shipping->city }}</p>
                <p>State: {{ $customerData->shipping->state }}</p>
                <p>Zip: {{ $customerData->shipping->zip }}</p>
            </div>

        </div>
        <br><br>
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
                    @foreach($cartItems as $key => $item)
                        <div class="row cart-item">
                            <div class="span3 item-name">
                                <p>{{ $item->name }}</p>
                            </div>
                            <div class="span6 item-desc">
                                <p>{{ $item->description }}</p>
                            </div>
                            <div class="span1 item-qty">
                                <p>{{ $item->amount }}</p>
                            </div>
                            <div class="span2 item-price">
                                <p>{{ $item->display_price }}</p>
                            </div>
                        </div>
                    @endforeach
            </div>
            <div class="row cart-totals">
                <div class="cart-subtotal">
                    @if($total)
                        <p id="receiptTotal">Total: {{ $total }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <div id="cart" data-cart="{{json_encode($cartItems)}}" data-transid="{{$transId}}"></div>
    @if(env('APP_ENV') == 'production' && $noAnal == false)
        <script>
            $(document).ready(function(){
                var total = $('#receiptTotal').text();
                var totalSplit = total.split('$');
                fbq('track', 'Purchase', {value: totalSplit[1], currency:'USD'});

                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

                ga('create', 'UA-77053752-1', 'auto');

                ga('require', 'ecommerce', 'ecommerce.js');

                var transId = $('#cart').data('transid');
                var cart = $('#cart').data('cart');
                ga('ecommerce:addTransaction', {
                    'id': transId, // Transaction ID. Required.
                    'affiliation': 'Femina Plus Menopause', // store name.
                    'revenue': totalSplit[1] // total revenue.
                    });

                $.each(cart, function(index, value) {
                    ga('ecommerce:addItem', {
                        'id': transId, // Transaction ID. Required. Same as in the transaction data.
                        'name': value.name, // Product name. Required.
                        'sku': index, // Product SKU.
                        'price': (value.price/100), // Product price.
                        'quantity': value.amount // Product Quantity/
                    });
                });

                ga('ecommerce:send');

                ga('send', 'pageview');

                // window.dataLayer = window.dataLayer || [];
                // dataLayer.push({
                //    'transactionId': $('#cart').data('transId'),
                //    'transactionTotal': parseInt(totalSplit[1]),
                //    'transactionProducts': transProds
                // });
            });
        </script>
    @endif
@endsection
