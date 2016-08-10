@extends('master')

@section('page_title', 'Checkout')
@section('page_id', 'checkout')

<?php
    $page_id = "checkout";
    $shipping_state = (old('shipping-state'));
    $states = [
        'AL' => 'Alabama',
        'AK' => 'Alaska',
        'AZ' => 'Arizona',
        'AR' => 'Arkansas',
        'CA' => 'California',
        'CO' => 'Colorado',
        'CT' => 'Connecticut',
        'DE' => 'Delaware',
        'DC' => 'District Of Columbia',
        'FL' => 'Florida',
        'GA' => 'Georgia',
        'HI' => 'Hawaii',
        'ID' => 'Idaho',
        'IL' => 'Illinois',
        'IN' => 'Indiana',
        'IA' => 'Iowa',
        'KS' => 'Kansas',
        'KY' => 'Kentucky',
        'LA' => 'Louisiana',
        'ME' => 'Maine',
        'MD' => 'Maryland',
        'MA' => 'Massachusetts',
        'MI' => 'Michigan',
        'MN' => 'Minnesota',
        'MS' => 'Mississippi',
        'MO' => 'Missouri',
        'MT' => 'Montana',
        'NE' => 'Nebraska',
        'NV' => 'Nevada',
        'NH' => 'New Hampshire',
        'NJ' => 'New Jersey',
        'NM' => 'New Mexico',
        'NY' => 'New York',
        'NC' => 'North Carolina',
        'ND' => 'North Dakota',
        'OH' => 'Ohio',
        'OK' => 'Oklahoma',
        'OR' => 'Oregon',
        'PA' => 'Pennsylvania',
        'RI' => 'Rhode Island',
        'SC' => 'South Carolina',
        'SD' => 'South Dakota',
        'TN' => 'Tennessee',
        'TX' => 'Texas',
        'UT' => 'Utah',
        'VT' => 'Vermont',
        'VA' => 'Virginia',
        'WA' => 'Washington',
        'WV' => 'West Virginia',
        'WI' => 'Wisconsin',
        'WY' => 'Wyoming'
    ];

    if ($user) {
        $billing_first_name = (old('billing-name-first')) ? old('billing-name-first') : $user->first_name;
        $billing_last_name = (old('billing-name-last')) ? old('billing-name-last') : $user->last_name;
        $billing_email = (old('billing-email')) ? old('billing-email') : $user->email;
        $billing_phone = (old('billing-phone')) ? old('billing-phone') : $user->phone;
        $billing_address_1 = (old('billing-address-1')) ? old('billing-address-1') : $user->address;
        $billing_address_2 = (old('billing-address-2')) ? old('billing-address-2') : $user->apartment_suite_number;
        $billing_city = (old('billing-city')) ? old('billing-city') : $user->city;
        $billing_state = (old('billing-state')) ? old('billing-state') : $user->state;
        $billing_zip = (old('billing-zip')) ? old('billing-zip') : $user->zip;
    } else {
        $billing_first_name = (old('billing-name-first')) ? old('billing-name-first') : null;
        $billing_last_name = (old('billing-name-last')) ? old('billing-name-last') : null;
        $billing_email = (old('billing-email')) ? old('billing-email') : null;
        $billing_phone = (old('billing-phone')) ? old('billing-phone') : null;
        $billing_address_1 = (old('billing-address-1')) ? old('billing-address-1') : null;
        $billing_address_2 = (old('billing-address-2')) ? old('billing-address-2') : null;
        $billing_city = (old('billing-city')) ? old('billing-city') : null;
        $billing_state = (old('billing-state')) ? old('billing-state') : null;
        $billing_zip = (old('billing-zip')) ? old('billing-zip') : null;
    }

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
        <h3 id="checkoutTotal">Total: {{ $total }}</h3>
    </div>
</section>
<section id="tile-checkout-info">
    <div class="container">
        <div class="row">
            <form action="{{ action('CheckoutController@create') }}" id="payment-form" method="POST">
                @include('errors.errors')
                <div class="span6 billing-shipping-info">
                    {{ csrf_field() }}
                    <div id="billing-info">
                        <h3>Billing Information</h3>
                        <div class="row input-row">
                            <div class="span6">
                                <input type="text" class="form-control" name="billing-name-first" placeholder="First Name" value="{{ $billing_first_name }}"/>
                            </div>
                            <div class="span6">
                                <input type="text" class="form-control" name="billing-name-last" placeholder="Last Name" value="{{ $billing_last_name }}"/>
                            </div>
                        </div>
                        <div class="row input-row">
                            <div class="span6">
                                <input type="text" class="form-control" name="billing-email" placeholder="Email" value="{{ $billing_email }}"/>
                            </div>
                            <div class="span6">
                                <input id="billing-phone" type="text" class="form-control" name="billing-phone" placeholder="Phone" value="{{ $billing_phone }}"/>
                            </div>
                        </div>
                        <div class="row input-row">
                            <input type="text" class="form-control" name="billing-address-1" placeholder="Address" value="{{ $billing_address_1 }}"/>
                        </div>
                        <div class="row input-row">
                            <div class="span6">
                                <input type="text" class="form-control" name="billing-address-2" placeholder="Address 2" value="{{ $billing_address_2 }}"/>
                            </div>
                            <div class="span6">
                                <input type="text" class="form-control" name="billing-city" placeholder="City" value="{{ $billing_city }}"/>
                            </div>
                        </div>
                        <div class="row input-row">
                            <div class="span8">
                                <select name="billing-state">
                                    <option class="null" value="" disabled selected>State</option>
                                    @foreach($states as $key => $value)
                                        @if($billing_state == $key)
                                            <option value="{{$key}}" selected>{{$value}}</option>
                                        @else
                                            <option value="{{$key}}" >{{$value}}</option>
                                        @endif
                                    @endforeach
								</select>
                            </div>
                            <div class="span4">
                                <input type="text" class="form-control" name="billing-zip" placeholder="Zip" value="{{ $billing_zip }}"/>
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
                                <input type="text" class="form-control" name="shipping-name-first" placeholder="First Name" value="{{ old('shipping-name-first') }}"/>
                            </div>
                            <div class="span6">
                                <input type="text" class="form-control" name="shipping-name-last" placeholder="Last Name" value="{{ old('shipping-name-last') }}"/>
                            </div>
                        </div>
                        <div class="row input-row">
                            <div class="span6">
                                <input type="text" class="form-control" name="shipping-email" placeholder="Email" value="{{ old('shipping-email') }}"/>
                            </div>
                            <div class="span6">
                                <input id="shipping-phone" type="text" class="form-control" name="shipping-phone" placeholder="Phone" value="{{ old('shipping-phone') }}"/>
                            </div>
                        </div>
                        <div class="row input-row">
                            <input type="text" class="form-control" name="shipping-address-1" placeholder="Address" value="{{ old('shipping-address-1') }}"/>
                        </div>
                        <div class="row input-row">
                            <div class="span6">
                                <input type="text" class="form-control" name="shipping-address-2" placeholder="Address 2" value="{{ old('shipping-address-2') }}"/>
                            </div>
                            <div class="span6">
                                <input type="text" class="form-control" name="shipping-city" placeholder="City" value="{{ old('shipping-city') }}"/>
                            </div>
                        </div>
                        <div class="row input-row">
                            <div class="span8">
                                <select name="shipping-state">
                                    <option class="null" value="" disabled selected>State</option>
                                    @foreach($states as $key => $value)
                                        @if($shipping_state == $key)
                                            <option value="{{$key}}" selected>{{$value}}</option>
                                        @else
                                            <option value="{{$key}}" >{{$value}}</option>
                                        @endif
                                    @endforeach
								</select>
                            </div>
                            <div class="span4">
                                <input type="text" class="form-control" name="shipping-zip" placeholder="Zip" value="{{ old('shipping-zip') }}"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="span6 payment-info">
                    {{ csrf_field() }}
                    <div id="choosePayment">
                        <h3>Choose a payment</h3>
                        <button type="button" id="payWithCard" class="primary-btn">PAY WITH CARD</button>
                        <button id="paypalButton" type="submit" name="paypal-submit" value="paypal">
                            <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-medium.png">
                        </button>
                    </div>
                    <div id="cardPayment" style="display:none" value="close">
                        <h3>Payment Information</h3>
                        <div class="row input-row">
                            <input type="text" class="form-control" name="cardName" placeholder="Name" value="{{ old('cardName') }}"/>
                        </div>
                        <div class="row input-row">
                            <input type="text" class="form-control" name="cardNumber" maxlength="16" placeholder="Card number" value="{{ old('cardNumber') }}"/>
                        </div>
                        <div class="row input-row">
                            <div class="span8">
                                <input id="payment-exp" type="text" class="form-control" name="cardExpiration" placeholder="MM / YYYY" value="{{ old('cardExpiration') }}"/>
                            </div>
                            <div class="span4">
                                <input type="text" class="form-control" name="cardCvc" maxlength="6" placeholder="CVC" value="{{ old('cardCvc') }}"/>
                            </div>
                        </div>
                        <div class="input-row">
                            <button type="submit" id="submitBtn" class="primary-btn" name="card-submit" value="card">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>

            <form action="{{ action('CheckoutController@applyCoupon') }}" id="coupon-form" method="POST">
                <div class="span6 coupon-info">
                    {{ csrf_field() }}
                    <h3>Coupon Code</h3>
                    <div class="row input-row">
                        <input type="text" class="form-control" name="coupon-code" placeholder="Code"/>
                    </div>
                    <div class="input-row">
                        <button type="submit" id="submitBtn" class="primary-btn">APPLY</button>
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

        $('#payWithCard').on('click', function() {
            if ($("#cardPayment").attr('value') == 'close') {
                $("#cardPayment").slideDown();
                $("#cardPayment").attr('value', 'open');
            } else if ($("#cardPayment").attr('value') == 'open') {
                $("#cardPayment").slideUp();
                $("#cardPayment").attr('value', 'close');

            }
        });
	});
</script>

@endsection
