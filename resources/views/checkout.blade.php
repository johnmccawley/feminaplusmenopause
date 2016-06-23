@extends('master')

@section('page_title', 'Checkout')
@section('page_id', 'checkout')

<?php
    $page_id = "checkout";
?>

@section('content')

<section id="tile-cart">
    <div class="container">
        <h3>Cart</h3>
        <div class="row cart-items">
            <div class="row cart-item">
                <div class="span4 item-name">
                    Product #1
                </div>
                <div class="span4 item-qty">
                    Qty: 2
                </div>
                <div class="span4 item-price">
                    $00.00
                </div>
            </div>
            <div class="row cart-item">
                <div class="span4 item-name">
                    Product #1
                </div>
                <div class="span4 item-qty">
                    Qty: 2
                </div>
                <div class="span4 item-price">
                    $00.00
                </div>
            </div>
        </div>
        <a href="/cart" class="secondary-btn">EDIT CART</a>
    </div>
</section>
<section id="tile-checkout-info">
    <div class="container">
        <div class="row">
            <form action="{{ action('PagesController@postOrder') }}" id="payment-form" method="POST">
                <div class="span6 billing-shipping-info">
                    <div id="billing-info">
                        <h3>Billing Information</h3>
                        <div class="row input-row">
                            <div class="span6">
                                <input type="text" class="form-control" name="billing-name-first" placeholder="First Name"/>
                            </div>
                            <div class="span6">
                                <input type="text" class="form-control" name="billing-name-last" placeholder="Last Name"/>
                            </div>
                        </div>
                        <div class="row input-row">
                            <div class="span6">
                                <input type="text" class="form-control" name="billing-email" placeholder="Email"/>
                            </div>
                            <div class="span6">
                                <input id="billing-phone" type="text" class="form-control" name="billing-phone" placeholder="Phone"/>
                            </div>
                        </div>
                        <div class="row input-row">
                            <input type="text" class="form-control" name="billing-address-1" placeholder="Address"/>
                        </div>
                        <div class="row input-row">
                            <div class="span6">
                                <input type="text" class="form-control" name="billing-address-2" placeholder="Address 2"/>
                            </div>
                            <div class="span6">
                                <input type="text" class="form-control" name="billing-city" placeholder="City"/>
                            </div>
                        </div>
                        <div class="row input-row">
                            <div class="span8">
                                <input type="text" class="form-control" name="billing-state" placeholder="State"/>
                            </div>
                            <div class="span4">
                                <input type="text" class="form-control" name="billing-zip" placeholder="Zip"/>
                            </div>
                        </div>
                    </div>

                    <div class="row address-check">
						<input id="address-checkbox" type="checkbox" value="yes" name="billing-same" tabindex="-1" checked><label class="checkbox-label" for="address-checkbox">Shipping Address Matches Billing Address.</label>
					</div>

                    <div id="shipping-info">
                        <h3>Shipping Information</h3>
                        <div class="row input-row">
                            <div class="span6">
                                <input type="text" class="form-control" name="shipping-name-first" placeholder="First Name"/>
                            </div>
                            <div class="span6">
                                <input type="text" class="form-control" name="shipping-name-last" placeholder="Last Name"/>
                            </div>
                        </div>
                        <div class="row input-row">
                            <div class="span6">
                                <input type="text" class="form-control" name="shipping-email" placeholder="Email"/>
                            </div>
                            <div class="span6">
                                <input id="shipping-phone" type="text" class="form-control" name="shipping-phone" placeholder="Phone"/>
                            </div>
                        </div>
                        <div class="row input-row">
                            <input type="text" class="form-control" name="shipping-address-1" placeholder="Address"/>
                        </div>
                        <div class="row input-row">
                            <div class="span6">
                                <input type="text" class="form-control" name="shipping-address-2" placeholder="Address 2"/>
                            </div>
                            <div class="span6">
                                <input type="text" class="form-control" name="shipping-city" placeholder="City"/>
                            </div>
                        </div>
                        <div class="row input-row">
                            <div class="span8">
                                <input type="text" class="form-control" name="shipping-state" placeholder="State"/>
                            </div>
                            <div class="span4">
                                <input type="text" class="form-control" name="shipping-zip" placeholder="Zip"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span6 payment-info">
                    @include('errors.errors')
                    {{ csrf_field() }}
                    <h3>Payment Information</h3>
                    <div class="row input-row">
                        <input type="text" class="form-control" name="name" placeholder="Name"/>
                    </div>
                    <div class="row input-row">
                        <input type="text" class="form-control" name="cardNumber" maxlength="16" placeholder="Card number"/>
                    </div>
                    <div class="row input-row">
                        <div class="span8">
                            <input id="payment-exp" type="text" class="form-control" name="expiration" placeholder="MM / YYYY"/>
                        </div>
                        <div class="span4">
                            <input type="text" class="form-control" name="cvc" maxlength="6" placeholder="CVC"/>
                        </div>
                    </div>
                    <div class="input-row">
                        <button type="submit" id="submitBtn" class="primary-btn">CONTINUE</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</section>

<script>
	$(document).ready(function() {
	   $("#billing-phone").mask("(999) 999-9999");
	   $("#shipping-phone").mask("(999) 999-9999");
	   $("#payment-exp").mask("99/9999");


	});
</script>

@endsection
