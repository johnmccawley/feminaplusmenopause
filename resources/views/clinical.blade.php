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
                <p>Femina Plus<sup>®</sup> contains the proprietary blend of three botanical root extracts, known as Fem-Fleur<sup>™*</sup>. It has been scientifically developed for the purpose of providing relief from the symptoms of menopause. This exclusive herbal formula has been FDA reviewed and clinically tested. Fem-Fleur<sup>&#8482;</sup> is shown to be safe and effective in as few as <strong>7-10 days</strong>, relieving some of the toughest symptoms in menopausal women of varying ages.</p>
            </div>
        </div>
    </div>
</section>

<div class="background-area">

    <section id="tile-clinical-info">
        <div class="container">
            <div class="row">
                <h2>Safe and Effective</h2>
                <p>The groundbreaking results for safety and effectiveness in managing the most common menopause symptoms have been replicated across the three FDA “Gold Standard” clinical human studies, in which the following symptoms improved:</p>
                <ul>
                    <li>Hot Flashes/Night Sweats</li>
                    <li>Insomnia</li>
                    <li>Vaginal Dryness</li>
                    <li>Joint Discomfort</li>
                    <li>Mood Swings</li>
                    <li>Fatigue</li>
                    <li>Nervousness</li>
                    <li>Headaches</li>
                    <li>Paresthesia (Tingling Skin)</li>
                    <li>Vertigo</li>
                    <li>Formication (Crawling Skin)</li>
                    <li>Palpitations</li>
                </ul>
                <p>Download the summaries below to see proof of how Femina Plus<sup>&reg;</sup> with Fem-Fleur<sup>&#8482;</sup> can effectively help women manage their symptoms through perimenopause and menopause.</p>
                <p>Enjoy the benefits of Femina Plus<sup>&reg;</sup> with multiple options to buy. Whether it is a monthly auto-refill or just one bottle, experience the safe, natural benefits of Femina Plus<sup>&reg;</sup> now!</p>
            </div>
        </div>
    </section>
    <section id="tile-clinical-previews">
        <div class="container">
            <div class="row clinical-previews">
                <div class="span4">
                    <div class="clinical-preview">
                        <div class="clinical-image">
                            <img src="img/angelica3.png" />
                        </div>
                        <a href="/clinical-studies/feminaplus-clinical-study-1.pdf" target="_blank">
                            <button class="main-cta-btn">VIEW CLINICAL STUDY 1</button>
                        </a>
                    </div>
                </div>
                <div class="span4">
                    <div class="clinical-preview">
                        <div class="clinical-image">
                            <img src="img/cynanchum3.png" />
                        </div>
                        <a href="/clinical-studies/feminaplus-clinical-study-2.pdf" target="_blank">
                            <button class="main-cta-btn">VIEW CLINICAL STUDY 2</button>
                        </a>
                    </div>
                </div>
                <div class="span4">
                    <div class="clinical-preview">
                        <div class="clinical-image">
                            <img src="img/phlomis3.png" />
                        </div>
                        <a href="/clinical-studies/feminaplus-clinical-study-3.pdf" target="_blank">
                            <button class="main-cta-btn">VIEW CLINICAL STUDY 3</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="clinical-mainpoint-bar">
        <div class="container">
            <div class="row">
                <h6><span>FEMINA PLUS<sup>&reg;</sup></span> <span>IS COMPLETELY</span> <span>ESTROGEN FREE,</span> <span>NON GMO,</span> <span>GLUTEN FREE</span> <span>AND HAS</span> <span>SOLD OVER</span> <span>50 MILLION</span> <span>BOTTLES WORLD WIDE</span></h6>
            </div>
        </div>
    </div>
</div>



@endsection
