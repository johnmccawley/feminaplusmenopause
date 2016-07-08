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
            @foreach($cartItems as $item)
                <div class="row cart-item">
                    <div class="span4 item-name">
                        {{ $item->name }}
                    </div>
                    <div class="span4 item-qty">
                        Qty: {{ $item->amount }}
                    </div>
                    <div class="span4 item-price">
                        {{ $item->display_price }}
                    </div>
                </div>
            @endforeach
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
                                <select name="shipping-state">
									<option class="null" value="" disabled selected>State</option>
									<option value="AL" >Alabama</option>
									<option value="AK" >Alaska</option>
									<option value="AZ" >Arizona</option>
									<option value="AR" >Arkansas</option>
									<option value="CA" >California</option>
									<option value="CO" >Colorado</option>
									<option value="CT" >Connecticut</option>
									<option value="DE" >Delaware</option>
									<option value="DC" >District Of Columbia</option>
									<option value="FL" >Florida</option>
									<option value="GA" >Georgia</option>
									<option value="HI" >Hawaii</option>
									<option value="ID" >Idaho</option>
									<option value="IL" >Illinois</option>
									<option value="IN" >Indiana</option>
									<option value="IA" >Iowa</option>
									<option value="KS" >Kansas</option>
									<option value="KY" >Kentucky</option>
									<option value="LA" >Louisiana</option>
									<option value="ME" >Maine</option>
									<option value="MD" >Maryland</option>
									<option value="MA" >Massachusetts</option>
									<option value="MI" >Michigan</option>
									<option value="MN" >Minnesota</option>
									<option value="MS" >Mississippi</option>
									<option value="MO" >Missouri</option>
									<option value="MT" >Montana</option>
									<option value="NE" >Nebraska</option>
									<option value="NV" >Nevada</option>
									<option value="NH" >New Hampshire</option>
									<option value="NJ" >New Jersey</option>
									<option value="NM" >New Mexico</option>
									<option value="NY" >New York</option>
									<option value="NC" >North Carolina</option>
									<option value="ND" >North Dakota</option>
									<option value="OH" >Ohio</option>
									<option value="OK" >Oklahoma</option>
									<option value="OR" >Oregon</option>
									<option value="PA" >Pennsylvania</option>
									<option value="RI" >Rhode Island</option>
									<option value="SC" >South Carolina</option>
									<option value="SD" >South Dakota</option>
									<option value="TN" >Tennessee</option>
									<option value="TX" >Texas</option>
									<option value="UT" >Utah</option>
									<option value="VT" >Vermont</option>
									<option value="VA" >Virginia</option>
									<option value="WA" >Washington</option>
									<option value="WV" >West Virginia</option>
									<option value="WI" >Wisconsin</option>
									<option value="WY" >Wyoming</option>
								</select>
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
                                <select name="shipping-state">
									<option class="null" value="" disabled selected>State</option>
									<option value="AL" >Alabama</option>
									<option value="AK" >Alaska</option>
									<option value="AZ" >Arizona</option>
									<option value="AR" >Arkansas</option>
									<option value="CA" >California</option>
									<option value="CO" >Colorado</option>
									<option value="CT" >Connecticut</option>
									<option value="DE" >Delaware</option>
									<option value="DC" >District Of Columbia</option>
									<option value="FL" >Florida</option>
									<option value="GA" >Georgia</option>
									<option value="HI" >Hawaii</option>
									<option value="ID" >Idaho</option>
									<option value="IL" >Illinois</option>
									<option value="IN" >Indiana</option>
									<option value="IA" >Iowa</option>
									<option value="KS" >Kansas</option>
									<option value="KY" >Kentucky</option>
									<option value="LA" >Louisiana</option>
									<option value="ME" >Maine</option>
									<option value="MD" >Maryland</option>
									<option value="MA" >Massachusetts</option>
									<option value="MI" >Michigan</option>
									<option value="MN" >Minnesota</option>
									<option value="MS" >Mississippi</option>
									<option value="MO" >Missouri</option>
									<option value="MT" >Montana</option>
									<option value="NE" >Nebraska</option>
									<option value="NV" >Nevada</option>
									<option value="NH" >New Hampshire</option>
									<option value="NJ" >New Jersey</option>
									<option value="NM" >New Mexico</option>
									<option value="NY" >New York</option>
									<option value="NC" >North Carolina</option>
									<option value="ND" >North Dakota</option>
									<option value="OH" >Ohio</option>
									<option value="OK" >Oklahoma</option>
									<option value="OR" >Oregon</option>
									<option value="PA" >Pennsylvania</option>
									<option value="RI" >Rhode Island</option>
									<option value="SC" >South Carolina</option>
									<option value="SD" >South Dakota</option>
									<option value="TN" >Tennessee</option>
									<option value="TX" >Texas</option>
									<option value="UT" >Utah</option>
									<option value="VT" >Vermont</option>
									<option value="VA" >Virginia</option>
									<option value="WA" >Washington</option>
									<option value="WV" >West Virginia</option>
									<option value="WI" >Wisconsin</option>
									<option value="WY" >Wyoming</option>
								</select>
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
