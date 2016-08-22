@extends('master')

@section('page_title', 'Buy Now')
@section('page_id', 'buy')

<?php
    $page_id = "buy";
?>

@section('content')

@include('partials.productList')

@endsection
