@extends('master')

@section('page_title', 'Home')
@section('page_id', 'home')

<?php
    $page_id = "home";
?>

@section('content')

<section id="tile-hero">
    <div class="container">
        <div class="row">
            <img class="product-image" src="img/bottle.png" />
            <ul class="bullet-points">
                <li>
                    <div class="bullet-icon">
                        <i class="fa fa-hourglass-half fa-lg" aria-hidden="true"></i>
                    </div>
                    Works in as few as 7-10 days.<sup>*</sup>
                </li>
                <li>
                    <div class="bullet-icon">
                        <i class="fa fa-flask fa-lg" aria-hidden="true"></i>
                    </div>
                    Three human clinical studies.<sup>*</sup>
                </li>
                <li>
                    <div class="bullet-icon">
                        <i class="fa fa-check fa-lg" aria-hidden="true"></i>
                    </div>
                    6x faster than black cohosh.<sup>*</sup>
                </li>
            </ul>
        </div>
        <h1><span>THE FASTEST, SAFEST, MOST EFFECTIVE</span> <br /><span>HERBAL MENOPAUSE RELIEF</span> <br /><span>IN THE WORLD.</span></h1>
    </div>
</section>

<div class="background-area">
    <section id="tile-main-keypoints">
        <div class="container">
            <div class="row">
                <div class="span6">
                    <div class="main-keypoint">
                        <h3>CLINICALLY PROVEN</h3>
                        <p>Outstanding FDA reviewed studies. Relief for 85% of participants!</p>
                    </div>
                    <div class="main-keypoint">
                        <h3>HOT FLASHES</h3>
                        <p>Night sweats, Insomnia, fatigue, liver protective, and more!</p>
                    </div>
                    <div class="main-keypoint">
                        <h3>VAGINAL DRYNESS</h3>
                        <p>Stimulates your natural moisture and hydrates dry skin and eyes.</p>
                    </div>
                </div>
                <div class="span6">
                    <div class="main-keypoint">
                        <h3>FAST ACTING</h3>
                        <p>Provides relief in as few as 7-days. 6x faster than black cohosh.</p>
                    </div>
                    <div class="main-keypoint">
                        <h3>INSOMNIA</h3>
                        <p>The hormone balancing effect promotes restful, deep sleep for increased energy.</p>
                    </div>
                    <div class="main-keypoint">
                        <h3>ZERO SIDE EFFECTS</h3>
                        <p>Hormones are linked to cancer, Black cohosh to liver toxicity.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="tile-cta">
        <div class="container">
            <div class="row">
                <h3>Fast Relief in 7-10 days <br />Feel Better Faster</h3>
                <a class="main-cta-btn" href="#">BUY NOW!</a>
                <span>FREE BOTTLE WITH AUTO-REFILL</span>
            </div>
        </div>
    </section>

    <section id="tile-clinical-keypoints">
        <div class="container">
            <div class="row">
                <div class="span4 clinical-keypoint">
                    <img class="icon-tulip" src="img/icon-tulip.png" />
                    <h4>FDA REVIEWED</h4>
                    <p>Three FDA “Gold Medal Standard” trials show Femina Plus with the Herbal Blend, Fem-Fleur effectivley relieves the 10 most common symptoms of peri-menopause and menpause.</p>
                </div>
                <div class="span4 clinical-keypoint">
                    <img class="icon-tulip" src="img/icon-tulip.png" />
                    <h4>FAST RELIEF</h4>
                    <p>In as few as 7-10 days the majority of women saw significant improvement in 10 of the toughest symptoms of menopause . Women felt better faster with Femina Plus.</p>
                </div>
                <div class="span4 clinical-keypoint">
                    <img class="icon-tulip" src="img/icon-tulip.png" />
                    <h4>CLINICAL EVIDENCE</h4>
                    <p>Femina plus has proven , patented, in-depth science. Three double blind, randomized , placebo controlled Human studies validated that femina plus performs safely and quickly.</p>
                </div>
            </div>
        </div>
    </section>
</div>

<section id="tile-lifestyle">
    <h1>
        <div class="container">
            <span>THE FASTEST, SAFEST, MOST EFFECTIVE</span> <span>HERBAL MENOPAUSE RELIEF</span> <span>IN THE WORLD.</span>
        </div>
    </h1>
</section>

@endsection
