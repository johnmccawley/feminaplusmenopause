@extends('master')

@section('page_title', 'Home')
@section('page_id', 'home')

<?php
    $page_id = "home";
?>

@section('content')

<script>
    $(document).ready(function(){
        fbq('track', 'PageView');
    });
</script>

<section id="tile-hero">
    <div class="container">
        <div class="row">
            <img class="product-image" src="img/bottle.png" />
            <ul class="bullet-points">
                <li>
                    <div class="bullet-icon">
                        <i class="fa fa-hourglass-half fa-lg" aria-hidden="true"></i>
                    </div>
                    Works in as few as <strong>7-10 days</strong>.<sup>*</sup>
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
                        <p>Outstanding FDA reviewed studies. <br />Significant relief for 96% of women.</p>
                    </div>
                    <div class="main-keypoint">
                        <h3>FAST ACTING</h3>
                        <p>Provides relief in as few as <strong>7-10 days</strong>, <br /><strong>TAKE DAILY</strong>. 6X faster than black cohosh.</p>
                    </div>
                    <div class="main-keypoint">
                        <h3>ZERO SIDE EFFECTS</h3>
                        <p>Hormones are linked to cancer, <br />black cohosh to liver toxicity.</p>
                    </div>
                </div>
                <div class="span6">
                    <h3>PROVEN RELIEF FROM</h3>
                    <ul>
                        <li>HOT FLASHES</li>
                        <li>NIGHT SWEATS</li>
                        <li>INSOMNIA</li>
                        <li>VAGINAL DRYNESS</li>
                        <li>JOINT DISCOMFORT</li>
                        <li>MOOD SWINGS</li>
                        <li>NERVOUSNESS</li>
                        <li>FATIGUE</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="tile-cta">
        <div class="container">
            <div class="row">
                <div class="center-box">
                    <h3>Fast Relief in <strong>7-10 days</strong> <br />Feel Better Faster - <strong>Best Taken Daily</strong></h3>
                </div>
                <a class="main-cta-btn" href="/buy">BUY NOW!</a>
                <span>FREE BOTTLE WITH FEMINA PLUS CLUB</span>
            </div>
        </div>
    </section>

    <section id="tile-clinical-keypoints">
        <div class="container">
            <div class="row">
                <div class="span4 clinical-keypoint">
                    <img class="icon-tulip" src="img/icon-tulip.png" />
                    <h4>FDA REVIEWED</h4>
                    <p>Three FDA “Gold Medal Standard” trials show Femina Plus<sup>&reg;</sup> with the Herbal Blend, Fem-Fleur<sup>&#8482;</sup> effectivley relieves the 10 most common symptoms of peri-menopause and menopause.</p>
                </div>
                <div class="span4 clinical-keypoint">
                    <img class="icon-tulip" src="img/icon-tulip.png" />
                    <h4>FAST RELIEF</h4>
                    <p>In as few as <strong>7-10 days</strong> the majority of women saw significant improvement in 10 of the toughest symptoms of menopause. Women felt better faster with Femina Plus<sup>&reg;</sup>.</p>
                </div>
                <div class="span4 clinical-keypoint">
                    <img class="icon-tulip" src="img/icon-tulip.png" />
                    <h4>CLINICAL EVIDENCE</h4>
                    <p>Femina Plus<sup>&reg;</sup> has proven, patented, in-depth science. Three double blind, randomized, placebo controlled Human studies validated that Femina Plus<sup>&reg;</sup> performs safely and quickly.</p>
                </div>
            </div>
        </div>
    </section>
</div>

<section id="tile-lifestyle">
    <h1>
        <div class="container">
            <span>THE FASTEST, SAFEST,</span> <span>MOST EFFECTIVE HERBAL</span> <span>MENOPAUSE RELIEF IN THE WORLD.</span>
        </div>
    </h1>
</section>

@endsection
