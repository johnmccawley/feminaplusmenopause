@extends('master')

@section('page_title', 'Coupon')
@section('page_id', 'coupon')
<?php
    $page_id = 'coupon';
?>

@section('content')
    <section id="tile-coupon">
        <div class="container">
            <div class="row">
                <div class="span12">
                    @include('errors.errors')
                    <h3>Edit Coupon Codes</h3>
                    <div class="row coupon-header">
                        <div class="span3">
                            Coupon Code
                        </div>
                        <div class="span3">
                            Discount Amount
                        </div>
                        <div class="span3">
                            Discount Type
                        </div>
                        <div class="span1">
                            Delete
                        </div>
                        <div class="span1">
                            Update
                        </div>
                    </div>
                    @foreach($coupons as $coupon)
                        <form action="{{ url("/coupon/$coupon->id/update") }}" id="coupon-form" method="POST">
                            {{ csrf_field() }}
                            <div id="coupon-info">
                                <div class="row input-row">
                                    <div class="span3">
                                        <input type="text" class="form-control" name="coupon-code" placeholder="Code" value="{{ $coupon->code }}"/>
                                    </div>
                                    <div class="span3">
                                        <input type="text" class="form-control" name="coupon-amount" placeholder="Amount" value="{{ $coupon->discount_amount}}"/>
                                    </div>
                                    <div class="span3">
                                        <select name="coupon-type">
                                            @if($coupon->discount_type == 'percent')
                                                <option value="percent" selected>Percent</option>
                                                <option value="amount">Amount</option>
                                            @else
                                                <option value="percent">Percent</option>
                                                <option value="amount" selected>Amount</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="span1">
                                        <button type="submit" name="coupon-button" class="primary-btn" value="delete">Delete</button>
                                    </div>
                                    <div class="span1">
                                        <button type="submit" name="coupon-button" class="primary-btn" value="update">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
            <div class="row coupon-adding">
                <div class="span12">
                    <h3>Add a Coupon Code</h3>
                    <div class="row coupon-header">
                        <div class="span3">
                            Coupon Code
                        </div>
                        <div class="span3">
                            Discount Amount
                        </div>
                        <div class="span3">
                            Discount Type
                        </div>
                        <div class="span1">
                            Add
                        </div>
                    </div>
                    <form action="{{ action('CouponController@create') }}" id="coupon-form" method="POST">
                        {{ csrf_field() }}
                        <div id="coupon-info">
                            <div class="row input-row">
                                <div class="span3">
                                    <input type="text" class="form-control" name="coupon-code" placeholder="Code"/>
                                </div>
                                <div class="span3">
                                    <input type="text" class="form-control" name="coupon-amount" placeholder="Amount"/>
                                </div>
                                <div class="span3">
                                    <select name="coupon-type">
                                        <option value="" disabled selected>Type</option>
                                        <option value="percent">Percent</option>
                                        <option value="amount">Amount</option>
                                    </select>
                                </div>
                                <div class="span1">
                                    <button type="submit" name="coupon-add" class="primary-btn">Add</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
