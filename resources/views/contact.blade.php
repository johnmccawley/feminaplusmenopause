@extends('master')

@section('page_title', 'Contact')
@section('page_id', 'contact')

<?php
    $page_id = "contact";
?>

@section('content')

<section id="tile-contact">
    <div class="container">
        <div class="row">
            <div class="span7 form-area">
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
                    <div class="row btn-row">
                        <input type="submit" value="SUBMIT"/>
                    </div>
                </form>
            </div>
            <aside class="span5">
                <div class="row">
                    <h3>ADDRESS</h3>
                    <p>
                        P.O. Box 10132<br />
                        Santa Fe, NM 87501
                    </p>
                </div>
                <div class="row contact-info">
                    <h3>CONTACT</h3>
                    <a href="tel:800-219-4599"><i class="fa fa-phone" aria-hidden="true"></i>800.219.4599</a>
                    <a href="mailto:info@feminaplusmenopause.com"><i class="fa fa-envelope" aria-hidden="true"></i>info@feminaplusmenopause.com</a>
                </div>
                <div class="row">
                    <h3>SOCIAL</h3>
                    <ul class="social-icons">
                        <a href="https://www.facebook.com/MyFeminaPlus/?hc_ref=SEARCH&fref=nf"><li class="social-icon facebook"><i class="fa fa-facebook" aria-hidden="true"></i></li></a>
                        <a href="https://twitter.com/MyFeminaPlus"><li class="social-icon twitter"><i class="fa fa-twitter" aria-hidden="true"></i></li></a>
                        <a href="https://www.instagram.com/feminaplusmenopause/"><li class="social-icon twitter"><i class="fa fa-instagram" aria-hidden="true"></i></li></a>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

@endsection
