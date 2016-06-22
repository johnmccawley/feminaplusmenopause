@extends('master')

@section('page_title', 'Clinical')
@section('page_id', 'clinical')

<?php
    $page_id = "clinical";
?>

@section('content')

<section id="tile-hero">
    <div class="container">
        <div class="row">
            <img class="product-image" src="img/bottle.png" />
            <div class="hero-copy">
                <h2><span>Natural Relief</span> with <span>Proven Results</span></h2>
                <p>Femina<sup>®</sup> Plus contains the proprietary blend of three botanical root extracts, known as Fem-Fleur<sup>™*</sup>. It has been scientifically developed for the purpose of providing relief from the symptoms of menopause. This exclusive herbal formula has been FDA reviewed and clinically tested. Fem-Fluer is shown to be safe and effective in as few as 7-10 days, relieving some of the toughest symptoms in menopausal women of varying ages.</p>
            </div>
        </div>
    </div>
</section>

<section id="tile-clinical-info">
    <div class="container">
        <div class="row">
            <p>The groundbreaking results for safety and effectiveness in managing the most common menopause symptoms have been replicated across the three FDA “Gold Standard” clinical human studies, in which the following symptoms improved:</p>
            <ul>
                <li>Hot Flashes/Night Sweats</li>
                <li>Nervousness</li>
                <li>Insomnia</li>
                <li>Headaches</li>
                <li>Vaginal Dryness</li>
                <li>Paresthesia (Tingling Skin)</li>
                <li>Joint Discomfort</li>
                <li>Vertigo</li>
                <li>Mood Swings</li>
                <li>Formication (Crawling Skin)</li>
                <li>Fatigue</li>
                <li>Palpitations</li>
            </ul>
            <p>Download the studies below to see proof of how Femina Plus with Fem-Fleur can effectively help women manage their symptoms through perimenopause and menopause.</p>
            <p>Femina Plus is completely estrogen free, non GMO, gluten free and has sold over 50 million bottles worldwide.</p>
            <p>Enjoy the benefits of Femina Plus with multiple options to buy. Whether it is an auto-refill or just one bottle, experience the safe, natural benefits of Femina Plus now!</p>
        </div>
    </div>
</section>
<section id="tile-clinical-previews">
    <div class="container">
        <div class="row clinical-previews">
            <div class="span4">
                <div class="clinical-preview">
                    <a href="/clinical-studies/feminaplus-clinical-study-1.pdf" target="_blank">
                        <img class="icon-tulip" src="img/icon-tulip.png" />
                        <h4>CLINICAL STUDY #1</h4>
                        <button class="main-cta-btn">DOWNLOAD</button>
                    </a>
                </div>
            </div>
            <div class="span4">
                <div class="clinical-preview">
                    <a href="/clinical-studies/feminaplus-clinical-study-2.pdf" target="_blank">
                        <img class="icon-tulip" src="img/icon-tulip.png" />
                        <h4>CLINICAL STUDY #2</h4>
                        <button class="main-cta-btn">DOWNLOAD</button>
                    </a>
                </div>
            </div>
            <div class="span4">
                <div class="clinical-preview">
                    <a href="/clinical-studies/feminaplus-clinical-study-3.pdf" target="_blank">
                        <img class="icon-tulip" src="img/icon-tulip.png" />
                        <h4>CLINICAL STUDY #3</h4>
                        <button class="main-cta-btn">DOWNLOAD</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="clinical-mainpoint-bar">
    <div class="container">
        <div class="row">
            <h6><span>FEMINA PLUS</span> <span>IS COMPLETELY</span> <span>ESTROGEN FREE,</span> <span>NON GMO,</span> <span>GLUTEN FREE</span> <span>AND HAS</span> <span>SOLD OVER</span> <span>50 MILLION</span> <span>BOTTLES WORLD WIDE</span></h6>
        </div>
    </div>
</div>

@endsection
