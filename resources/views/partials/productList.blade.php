<?php
    $planId = env('FPC_PLAN_ID');
    $paypalUrl = (env('APP_ENV') == 'production') ? 'paypal' : 'sandbox.paypal';
?>

<div class="background-area">
    <section id="tile-product-options">
        <div class="container">
            <div class="row">
                <div class="product-option">
                    <div class="product-wrapper">
                        <div class="product-image">
                            <img src="img/bottle.png" />
                        </div>
                        <div class="product-name">
                            MONTHLY AUTO-REFILL
                        </div>
                        <div class="product-price">
                            $36.00
                        </div>
                        <span class="product-info">per bottle</span>
                        <div class="product-banner">
                            FREE SHIPPING
                        </div>
                        <div class="product-more special">
                            <a href="#"><strong>13TH BOTTLE FREE!</strong></a>
                        </div>
                    </div>
                    <form action="{{ url('/cart/fpClub/plan') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <button type="submit" class="atc-btn addToCartButton">ADD TO CART</button>
                    </form>
                    {{--<form class="paypal-subscribe-button" action="https://www.{{$paypalUrl}}.com/cgi-bin/webscr" method="post" target="_top">--}}
                        {{--<input type="hidden" name="cmd" value="_s-xclick">--}}
                        {{--<input type="hidden" name="hosted_button_id" value="{{$planId}}">--}}
                        {{--<input type="image" class="paypal-subscribe-image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribe_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">--}}
                        {{--<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">--}}
                    {{--</form>--}}
                </div>

                <div class="product-option">
                    <div class="product-wrapper">
                        <div class="product-image">
                            <img src="img/bottle-two.png" />
                        </div>
                        <div class="product-name">
                            TWO-PACK
                        </div>
                        <div class="product-price">
                            $77.90
                        </div>
                        <span class="product-info">$38.95 per bottle</span>
                        <div class="product-banner">
                            FREE SHIPPING
                        </div>
                        <div class="product-more">
                            <a href="#">More info</a>
                        </div>
                    </div>
                    <form action="{{ url('/cart/twoBottle/product') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <button type="submit" class="atc-btn addToCartButton">ADD TO CART</button>
                    </form>
                </div>

                <div class="product-option">
                    <div class="product-wrapper">
                        <div class="product-image">
                            <img src="img/bottle-four.png" />
                        </div>
                        <div class="product-name">
                            FOUR-PACK
                        </div>
                        <div class="product-price">
                            $149.90
                        </div>
                        <span class="product-info">$37.95 per bottle</span>
                        <div class="product-banner">
                            FREE SHIPPING
                        </div>
                        <div class="product-more">
                            <a href="#">More info</a>
                        </div>
                    </div>
                    <form action="{{ url('/cart/fourBottle/product') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <button type="submit" class="atc-btn addToCartButton">ADD TO CART</button>
                    </form>
                </div>

                <div class="product-option">
                    <div class="product-wrapper">
                        <div class="product-image">
                            <img src="img/bottle.png" />
                        </div>
                        <div class="product-name">
                            SINGLE BOTTLE
                        </div>
                        <div class="product-price">
                            $39.50
                        </div>
                        <span class="product-info">per bottle</span>
                        <div class="product-banner no-banner">
                            + Shipping & Handling
                        </div>
                        <div class="product-more">
                            <a href="#">More info</a>
                        </div>
                    </div>
                    <form action="{{ url('/cart/oneBottle/product') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <button type="submit" class="atc-btn addToCartButton">ADD TO CART</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>