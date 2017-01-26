<?php
    $planId = env('FPC_PLAN_ID');
    $paypalUrl = (env('APP_ENV') == 'production') ? 'paypal' : 'sandbox.paypal';
?>

<div class="background-area">
    <section id="tile-product-options">
        <div class="container">
            <div class="row">
                @foreach ($products as $product)
                    <div class="product-option">
                        <div class="product-wrapper">
                            <div class="product-image">
                                <img src={{ $product->image }} />
                            </div>
                            <div class="product-name">
                                {{ $product->name }}
                            </div>
                            <div class="product-price">
                                {{ $product->price }}
                            </div>
                            @if ($product->per_bottle == NULL)
                                <span class="product-info">per bottle</span>
                            @else
                                <span class="product-info">{{ $product->per_bottle }}</span>
                            @endif
                            @if ($product->shipping_text == NULL)
                                <div class="product-banner">
                                    FREE SHIPPING
                                </div>
                            @else
                                <div class="product-banner no-banner">
                                    {{ $product->shipping_text }}
                                </div>
                            @endif
                            @if ($product->more_info == NULL)
                                <div class="product-more">
                                    <a href="/product">More info</a>
                                </div>
                            @else
                                <div class="product-more special">
                                    <a href="/product"><strong>{{ $product->more_info }}</strong></a>
                                </div>
                            @endif
                        </div>
                        <form action={{ url("/cart/$product->sku") }} method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <button type="submit" class="atc-btn">ADD TO CART</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
