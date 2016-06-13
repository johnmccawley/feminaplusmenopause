@extends('master')

@section('page_title', 'Contact')
@section('page_id', 'contact')

<?php
    $page_id = "contact";
?>

@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="span8 form-area">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form id="main-contact-form" method="post" action="/contact">
                    {{ csrf_field() }}
                    <div class="row input-row">
                        <div class="span6 input-box">
                            <label for="name">Name</label>
                            <input id="name" name="name" value="{{ old('name') }}" />
                        </div>
                        <div class="span6 input-box">
                            <label for="email">Email</label>
                            <input id="email" name="email" value="{{ old('email') }}"/>
                        </div>
                    </div>
                    <div class="row input-row">
                        <label for="message">Message</label>
                        <textarea id="message" name="message">{{ old('message') }}</textarea>
                    </div>
                    <div class="row">
                        <input type="submit" value="SUBMIT"/>
                    </div>
                </form>
            </div>
            <aside class="span4">
                <div class="row">
                    <h3>ADDRESS</h3>
                    <p>
                        Femina Plus LLC<br />
                        13840 Magnolia Ave.<br />
                        Chino, CA 91710
                    </p>
                </div>
                <div class="row">
                    <h3></h3>
                    <!-- <a href="tel:800-219--4599"><i class="fa fa-phone" aria-hidden="true"></i>800.219.4599</a> -->
                    <!-- <a href="mailto:info@feminaplusmenopause.com"><i class="fa fa-envelope" aria-hidden="true"></i>info@feminaplusmenopause.com</a> -->
                </div>
                <div class="row">
                    <h3>SOCIAL</h3>
                    <ul class="social-icons">
                        <li class="social-icon facebook"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li class="social-icon twitter"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li class="social-icon twitter"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

@endsection
