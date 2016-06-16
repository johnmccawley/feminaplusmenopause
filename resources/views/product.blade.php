@extends('master')

@section('page_title', 'Product')
@section('page_id', 'product')

<?php
    $page_id = "product";
?>

@section('content')

<section id="tile-product">
    <div class="container">
        <div class="row">
            <div class="span4 product-image">
                <img src="img/bottle.png" class="full" />
            </div>
            <div class="span8">
                <div class="row">
                    <h2>Feel Better Faster with <br /> Femina<sup>&reg;</sup> Plus with Fem-Fleur<sup>&trade;</sup></h2>
                    <ul>
                        <li>No natural or synthetic estrogens, making it safer for daily use.</li>
                        <li>Typically starts working in 7 to 10 days.</li>
                        <li>Effectively relieves symptoms 6 times faster than black cohosh.</li>
                        <li>Free of synthetic and natural hormones, GMOs and gluten.</li>
                        <li>Backed by multiple studies that demonstrate its saftey and effectiveness.</li>
                    </ul>
                </div>
                <div id="product-options" class="row">
                    <a href="#" class="product-option">AUTO-REFILL<span>$36.00</span></a>
                    <a href="#" class="product-option">TWO-PACK<span>$77.90</span></a>
                    <a href="#" class="product-option">FOUR-PACK<span>$149.90</span></a>
                    <a href="#" class="product-option">SINGLE BOTTLE<span>$39.50</span></a>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="product-info-tabs">
    <div class="container">
        <nav>
            <ul class="tabs">
                <li class="current"><a class="tab" href="#tab-description">DESCRIPTION</a></li>
                <li><a class="tab" href="#tab-directions">DIRECTIONS</a></li>
                <li><a class="tab" href="#tab-ingredients">INGREDIENTS</a></li>
                <li><a class="tab" href="#tab-reviews">REVIEWS</a></li>
                <li><a class="tab" href="#tab-faq">F.A.Q.</a></li>
            </ul>
        </nav>
    </div>
</div>
<section id="tile-product-info">
    <div class="container">
        <div class="row">
            <div id="tab-description" class="tab-content">
                <h3>Find Your Balance with Femina Plus<sup>&reg;</sup></h3>
                <p>Finding a healthy balance for both body and mind is especially important during menopause, when hormonal changes can make you feel like you’ve lost control of many aspects of your life. Many women turn to therapies that introduce additional hormones into their system – or use some herbal remedies that can do more harm than good – causing potentially dangerous or unpleasant side effects.</p>
                <p>Femina Plus is a groundbreaking supplement that offers women a new menopause experience. It is natural, effective and safe relief with no risk of side effects. The exclusive botanical blend, Fem-Fleur™, is shown to significantly relieve many of the most common symptoms of menopause. Femina Plus even relieves symptoms six times faster than black cohosh, one of the more common herbal supplements taken by women in menopause.</p>
            </div>
            <div id="tab-directions" class="tab-content">
                <h3>Directions</h3>
                <p>Take 1 capsule, twice daily, with a mail. Suitable for vegetarians, Non-GMO, water extracted. We do not use ingredients produced using biotechnology.</p>
                <h3>Dietary Supplement</h3>
                <p>Made without Phytoestrogens or Soy.<br /><strong>Net Qty:</strong> 60 Soft Gel Capsules.</p>
                <h3>CAUTION:</h3>
                <p>For adults only. Not for pregnant or lactating women. Consult a physician if taking medication or have a medical condition. Keep out of reach of children. Do not eat the freshness packet. Keep in the bottle.</p>
            </div>
            <div id="tab-ingredients" class="tab-content">
                <h3>Ingredients</h3>
                <p>Fem-Fleur is an extract of these gentle, yet powerful botanicals.</p>
                <ul>
                    <li>Angelica Gigas Nakai Root Extract</li>
                    <li>Cynanchum Wilfordii Root Extract</li>
                    <li>Phlomis Umbrosa Root Extract</li>
                </ul>
            </div>
            <div id="tab-reviews" class="tab-content">
                <h3>Reviews</h3>
            </div>
            <div id="tab-faq" class="tab-content">
                <h3>Frequently Asked Questions</h3>
                <div class="question-box">
                    <h4>Lorem Ipsum</h4>
                    <div class="answer">
                        <p>Lorem ipsum</p>
                    </div>
                </div>
                <div class="question-box">
                    <h4>Lorem Ipsum</h4>
                    <div class="answer">
                        <p>Lorem ipsum</p>
                    </div>
                </div>
                <div class="question-box">
                    <h4>Lorem Ipsum</h4>
                    <div class="answer">
                        <p>Lorem ipsum</p>
                    </div>
                </div>
                <div class="question-box">
                    <h4>Lorem Ipsum</h4>
                    <div class="answer">
                        <p>Lorem ipsum</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
