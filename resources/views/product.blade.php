@extends('master')

@section('page_title', 'Product')
@section('page_id', 'product')

<?php
    $page_id = "product";
?>

@section('content')

<section id="tile-hero">
    <div class="container">
        <div class="row">
            <img class="product-image" src="img/bottle.png" />
            <div class="hero-copy">
                <h2><span>Safe and Effective</span> <span>Femina Plus<sup>&reg;</sup></span> <span>with Fem-Fleur<sup>&#8482;</sup></span></h2>
                <p>Made with all natural botanical ingredients, Femina Plus<sup>&reg;</sup> with Fem-Fleur<sup>&#8482;</sup> is clinically proven to be safe and effective in relieving menopausal symptoms in as few as <strong>7-10 days</strong>.</p>
                <a href="/clinical" class="secondary-btn">READ MORE</a>
            </div>
        </div>
    </div>
</section>
<div class="background-area">
    <section id="tile-product-info">
        <div class="container">
            <div class="row">
                <h2>Feel Better Faster</h2>
                <p>After taking Femina Plus<sup>&reg;</sup> for as few as <strong>7-10 days</strong> women of varying ages have reported significant relief from the following menopausal symptoms:</p>
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
    </section>
</div>

<section id="tile-testimonials">
    <div class="container">
        <div class="my-slider">
            <!-- <h2>Testimonials</h2> -->
            <ul>
                <li>
                    <p>WOW!  Nothing better than a good nights sleep!  Thanks to "Femina Plus", dependable sleep is available for me!  For at least 6 years, I suffered with regular DR.s rolling their eyes and saying "hummm", when I said I had HOT FLASHES.  I would wake every two hours from a sound sleep and then the HOT FLASH arrived.  It left in a few minutes, but so did my sound sleep.  My DR would recommend NOTHING.  I was fortunate enough to find FEMINA PLUS and I am the happiest 76 years old WOMAN on the planet. If you are having HOT FLASHES here is A guaranteed answer.  I take two in the evenings before retiring and sleep like a baby.  I have been taking them for 2 years.  I highly recommend FEMINA PLUS. Thank you!</p>
                    <span class="quote-author">-Dot Dougherty, retired teacher</span>
                </li>
                <li>
                    <p>At 50 years old, I was heading to the World Cup in New Zealand when I experienced a horrific day.  Hot flashes and headaches, followed by unbelievable night sweats and head spins. So I tried Femina Plus and in just two short weeks all my symptoms were gone! Thank you Femina Plus!!! </p>
                    <span class="quote-author">-Sheri Hunt, PhD</span>
                </li>
                <li>
                    <p>When it comes to herbal help for menopausal symptoms, I recommend Femina Plus. Made with a combination of three herbs, water extracted, all natural, with three double-blind placebo-controlled studies that show it is extremely effective at alleviating the uncomfortable symptoms of menopause including hot flashes, mood swings, insomnia and vaginal dryness. All in as few as 7-10 days</p>
                    <span class="quote-author">-Christine Horner, MD</span>
                </li>
                <li>
                    <p>I started taking Femina for hot flashes and it did so much more for me. I am sleeping well, my skin & hair look better since I began taking it and hot flashes are gone. I feel like myself again! Femina is a great natural product that I recommend to my friends all of the time. The benefits are amazing and life changing!</p>
                    <span class="quote-author">Amy McCawley, Creator/Principal Designer</span>
                </li>
            </ul>

        </div>
    </div>
</section>
<div class="background-area">
    <section id="tile-product-options">
        <div class="container">
            <div class="row">
                <div class="product-option">
                    <div class="product-wrapper">
                        <div class="product-image">
                            <img src="img/bottle.png" />
                        </div>
                        <div class="product-name">
                            MONTHLY AUTO-REFILL
                        </div>
                        <div class="product-price">
                            $36.00
                        </div>
                        <span class="product-info">per bottle</span>
                        <div class="product-banner">
                            FREE SHIPPING
                        </div>
                        <div class="product-more special">
                            <a href="#"><strong>13TH BOTTLE FREE!</strong></a>
                        </div>
                    </div>
                    <form action="{{ url('/cart/fpClub/plan') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <button type="submit" class="atc-btn">ADD TO CART</button>
                    </form>
                </div>

                <div class="product-option">
                    <div class="product-wrapper">
                        <div class="product-image">
                            <img src="img/bottle-two.png" />
                        </div>
                        <div class="product-name">
                            TWO-PACK
                        </div>
                        <div class="product-price">
                            $77.90
                        </div>
                        <span class="product-info">$38.95 per bottle</span>
                        <div class="product-banner">
                            FREE SHIPPING
                        </div>
                        <div class="product-more">
                            <a href="#">More info</a>
                        </div>
                    </div>
                    <form action="{{ url('/cart/twoBottle/product') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <button type="submit" class="atc-btn">ADD TO CART</button>
                    </form>
                </div>

                <div class="product-option">
                    <div class="product-wrapper">
                        <div class="product-image">
                            <img src="img/bottle-four.png" />
                        </div>
                        <div class="product-name">
                            FOUR-PACK
                        </div>
                        <div class="product-price">
                            $149.90
                        </div>
                        <span class="product-info">$37.95 per bottle</span>
                        <div class="product-banner">
                            FREE SHIPPING
                        </div>
                        <div class="product-more">
                            <a href="#">More info</a>
                        </div>
                    </div>
                    <form action="{{ url('/cart/fourBottle/product') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <button type="submit" class="atc-btn">ADD TO CART</button>
                    </form>
                </div>

                <div class="product-option">
                    <div class="product-wrapper">
                        <div class="product-image">
                            <img src="img/bottle.png" />
                        </div>
                        <div class="product-name">
                            SINGLE BOTTLE
                        </div>
                        <div class="product-price">
                            $39.50
                        </div>
                        <span class="product-info">per bottle</span>
                        <div class="product-banner no-banner">
                            + Shipping & Handling
                        </div>
                        <div class="product-more">
                            <a href="#">More info</a>
                        </div>
                    </div>
                    <form action="{{ url('/cart/oneBottle/product') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <button type="submit" class="atc-btn">ADD TO CART</button>
                    </form>
                </div>

            </div>
        </div>
    </section>
</div>


                        <!-- <form action="{{ url('/cart/fpClub/plan') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <button type="submit" class="product-option">AUTO-REFILL<span>$36.00</span></button>
                        </form>

                        <form action="{{ url('/cart/oneBottle/product') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <button type="submit" class="product-option">SINGLE BOTTLE<span>$39.50</span></button>
                        </form>

                        <form action="{{ url('/cart/twoBottle/product') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <button type="submit" class="product-option">TWO-PACK<span>$77.90</span></button>
                        </form>

                        <form action="{{ url('/cart/fourBottle/product') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <button type="submit" class="product-option">FOUR-PACK<span>$149.90</span></button>
                        </form> -->

    <div id="product-info-tabs">
        <div class="container">
            <nav>
                <ul class="tabs">
                    <li class="current"><a class="tab" href="#tab-description">DESCRIPTION</a></li>
                    <li><a class="tab" href="#tab-directions">DIRECTIONS</a></li>
                    <li><a class="tab" href="#tab-ingredients">INGREDIENTS</a></li>
                    <!-- <li><a class="tab" href="#tab-reviews">REVIEWS</a></li> -->
                    <li><a class="tab" href="#tab-faq">F.A.Q.</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <section id="tile-tab-info">
        <div class="container">
            <div class="row">
                <div id="tab-description" class="tab-content">
                    <h2>Description</h2>
                    <h3>Feel Better Faster</h3>
                    <p>Femina Plus<sup>®</sup> contains the proprietary blend of three botanical root extracts, known as Fem-Fleur<sup>™*</sup>. It has been scientifically developed for the purpose of providing relief from the symptoms of menopause. This exclusive herbal formula has been FDA reviewed and clinically tested. Fem-Fleur<sup>&#8482;</sup> is shown to be safe and effective in as few as <strong>7-10 days</strong>, relieving some of the toughest symptoms in menopausal women of varying ages.  For best results - <strong>TAKE DAILY</strong></p>
                    <!-- <h3>Find Your Balance with Femina Plus<sup>&reg;</sup></h3> -->
                    <!-- <p>Finding a healthy balance for both body and mind is especially important during menopause, when hormonal changes can make you feel like you’ve lost control of many aspects of your life. Many women turn to therapies that introduce additional hormones into their system – or use some herbal remedies that can do more harm than good – causing potentially dangerous or unpleasant side effects.</p>
                    <p>Femina Plus is a groundbreaking supplement that offers women a new menopause experience. It is natural, effective and safe relief with no risk of side effects. The exclusive botanical blend, Fem-Fleur™, is shown to significantly relieve many of the most common symptoms of menopause. Femina Plus even relieves symptoms six times faster than black cohosh, one of the more common herbal supplements taken by women in menopause.</p> -->
                </div>
                <div id="tab-directions" class="tab-content">
                    <h2>Directions</h2>
                    <p>Take 1 capsule, twice daily, with food. Suitable for vegetarians, Non-GMO, water extracted. We do not use ingredients produced using biotechnology.</p>
                    <h3>Dietary Supplement</h3>
                    <p>Made without Phytoestrogens or Soy.<br /><strong>Net Qty:</strong> 60 Soft Gel Capsules.</p>
                    <h3>CAUTION:</h3>
                    <p>For adults only. Not for pregnant or lactating women. Consult a physician if taking medication or have a medical condition. Keep out of reach of children. Do not eat the freshness packet. Keep in the bottle.</p>
                </div>
                <div id="tab-ingredients" class="tab-content">
                    <h2>Ingredients</h2>
                    <p>Fem-Fleur is an extract of these gentle, yet powerful botanicals.</p>
                    <div class="row">
                        <div class="span4 ingredient">
                            <h4>Angelica Gigas Nakai Root Extract</h4>
                            <img src="img/angelica3.png" />
                        </div>
                        <div class="span4 ingredient">
                            <h4>Cynanchum Wilfordii Root Extract</h4>
                            <img src="img/cynanchum3.png" />
                        </div>
                        <div class="span4 ingredient">
                            <h4>Phlomis Umbrosa Root Extract</h4>
                            <img src="img/phlomis3.png" />
                        </div>
                    </div>
                </div>
                <!-- <div id="tab-reviews" class="tab-content">
                    <h2>Reviews</h2>
                    <p>NOTE: NEED YOTPO ACCOUNT FOR REVIEWS HERE</p>
                </div> -->
                <div id="tab-faq" class="tab-content">
                    <h2>Frequently Asked Questions</h2>
                    <h3>Femina Plus</h3>
                    <div class="row">
                        <div class="span6">
                            <div class="question-box">
                                <h4>What is Femina Plus<sup>®</sup>?</h4>
                                <div class="answer">
                                    <p>Femina Plus is the fastest working, safest and most effective herbal menopause relief product on the market, offering relief from menopause symptoms in as little as 7 days with no side effects, and works six times faster than Black Cohosh. The active ingredient of this exception brand is backed by three human clinical studies and 9 clinical support studies.</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>Does Femina Plus do more than treat hot flashes and night sweats?</h4>
                                <div class="answer">
                                    <p>Yes!  One of the main symptoms of menopause is dry skin and dry eyes. With Femina Plus, women’s skin will gain its youthful look. Dryness in the eyes will also improve. Also, in the first clinical study, there was no weight gain in the women who took the active ingredient where as Black Cohosh is linked to weight gain. Another unique finding was that Femina Plus offered support for bone health via dexascan evaluations over 12 months in the first human clinical study.</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>Does Femina Plus work for everyone?</h4>
                                <div class="answer">
                                    <p>In rare cases, some women might not experience the benefits of Femina Plus with in 7-10 days.  However, if you do not experience benefits within 14 days keep on taking Femina Plus; statistically, 95% of the women in two open label studies improved by the 3rd week.</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>What is the best time to take Femina?</h4>
                                <div class="answer">
                                    <p>It doesn’t make a difference when to take Femina but for the first few times take the capsules or soft gels with a small serving of Food. Example: one or two crackers.</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>Does Femina contain soy?</h4>
                                <div class="answer">
                                    <p>Femina Plus is a combination of three root extracts and there is no Soy or Soy derivatives in Femina Plus</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>Is their Caffeine in Femina Plus?</h4>
                                <div class="answer">
                                    <p>There is no caffeine in Femina Plus.</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>Does Femina contain hormone estrogen?</h4>
                                <div class="answer">
                                    <p>There are no synthetic or natural hormones in Femina Plus thus making the ingredients natural, GMO free, and not estrogenic (which is very good proving no estrogen is present)</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>How long before I see/feel results?</h4>
                                <div class="answer">
                                    <p>The active ingredients in Femina Plus have been clinically proven in three placebo controlled double blind studies to work in as few as 7-10 days. You should take Femina Plus daily, 2 capsules or soft gels per day, to achieve the best results comparable to the 3 human clinical studies.</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>Can I take Femina with other dietary supplements or meds?</h4>
                                <div class="answer">
                                    <p>There are no contra indicators with Femina Plus which means you can combine with other dietary supplements. As always consult a physician if you have questions when combining with your doctor prescribed medications with dietary supplements.</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>How should I store Femina once I receive my purchase?</h4>
                                <div class="answer">
                                    <p>Store your bottles of Femina Plus in a cool dry location like a medicine cabinet.</p>
                                </div>
                            </div>
                        </div>
                        <div class="span6">
                            <div class="question-box">
                                <h4>Does it relieve hot flashes or night sweats?</h4>
                                <div class="answer">
                                    <p>Femina is clinically proven to relieve the symptoms of hot flashes and night sweats in 84% of the participants in the non-placebo group.</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>Does it help boost energy?</h4>
                                <div class="answer">
                                    <p>Femina is clinically proven to relieve the symptoms of “tiredness” as defined in the 2nd and 3rd study. You should feel your old self returning in as few as 7-10 days. Take Femina daily for best results.</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>Will this help my mood? memory?</h4>
                                <div class="answer">
                                    <p>Femina is clinically proven to relieve the symptoms of “mood swings and memory” as defined in the 2nd and 3rd study</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>Is Femina Plus safe?</h4>
                                <div class="answer">
                                    <p>The active ingredient in Femina was evaluated by the FDA via the NDI process where the active ingredient called was proven to be safe</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>What if I miss a day?</h4>
                                <div class="answer">
                                    <p>If you miss a day taking Femina get back on the product immediately. The success of Femina is driven by taking the product daily, 2 capsules or soft gels) where the formula can work more effectively. If you miss a few days the symptoms of menopause might return. If so, get back on the product, and in a few days the symptoms should subside again.</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>Where can I buy this in stores?</h4>
                                <div class="answer">
                                    <p>Femina Plus is not available in retail outlets and is only and exclusively available through the website, www.femminaplusmenopause.com</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>Is Femina Plus Gluten Free?</h4>
                                <div class="answer">
                                    <p>Yes</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>How soon will I receive my order?</h4>
                                <div class="answer">
                                    <p>Within 2-4 calendar days of date of order.</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>How do I return my order?</h4>
                                <div class="answer">
                                    <p>When taken daily, every day-2 capsules/ soft gels per day, and Femina Plus does not work in 30 days you may return your order via contact with the Femina Plus 800 number.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3>Menopause</h3>
                    <div class="row">
                        <div class="span6">
                            <div class="question-box">
                                <h4>What is Menopause?</h4>
                                <div class="answer">
                                    <p>Menopause means the menstrual cycle stops for at least 3-6 months. Other sources suggest if menstruation stops for 12 months this is the true definition of being in menopause.</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>At what age does menopause occur?</h4>
                                <div class="answer">
                                    <p>Most commonly this happens between the ages of 45 and 55, but it can occur earlier or later.</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>What can cause early menopause?</h4>
                                <div class="answer">
                                    <p>Early menopause might result from diet, the environment, genetics, autoimmune disease, infection, breast cancer and cancer treatments such as chemotherapy, radiation and surgery, including Hysterectomy and Oophorectomy (removal of the ovaries).</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>What are the symptoms of menopause?</h4>
                                <div class="answer">
                                    <p>As estrogen production decreases dramatically “physiological changes” include night sweats, hot flashes, vaginal dryness, dryness of skin, fatigue, hair loss, weakening of bones and cardiovascular problems. “Psychological changes” might include mood swings, irritability, insomnia, and depression.</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>Do all women experience the symptoms of menopause?</h4>
                                <div class="answer">
                                    <p>8 out of 10 women show one or more of the symptoms of menopause. 50% of the women show symptoms that are so severe it can interfere with their daily life. These severe symptoms can last 10-12 years per JAMA 2015.</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>How long will Menopause last?</h4>
                                <div class="answer">
                                    <p>According to JAMA (January 2015 report) the average time a woman will experience menopause is 7.4 years where as 50% of the 45 million women in menopause will experience severe menopause which can last up to 14 years.</p>
                                </div>
                            </div>
                        </div>
                        <div class="span6">
                            <div class="question-box">
                                <h4>What is Femina Plus?</h4>
                                <div class="answer">
                                    <p>A mixture of three 100% all natural herbal extracts. These three herbalshave been used and validated in written text for over 300 years. The combination represents the next generation menopause ingredient of choice.</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>How is Femina Plus produced?</h4>
                                <div class="answer">
                                    <p>Femina is water extracted from botanicals, and the process is GMO free and natural.</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>Is Femina Plus safe?</h4>
                                <div class="answer">
                                    <p>Four- and thirteen-week toxicity tests were performed in which active ingredient we call Fem-fleur was found to be non-toxic. When tested for liver-toxicity the active ingredient was found to support the liver. The active ingredient was also tested for carcinogenicity with negative results. Additionally, Fem Fleur is guaranteed to be 100% non-estrogenic, or not producing estrone or estradiol.</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>Have there been human clinical studies?</h4>
                                <div class="answer">
                                    <p>Yes. There are three human clinical studies conducted with the active ingredient. Each study is placebo controlled, double blind, and randomized. Fem -Fleur performed 6X better than placebo and 10 of the 12 symptoms significantly improved. Unheard of results with an ingredient working 6X faster than Black Cohosh, and 6x faster vs. all other nutra choices.</p>
                                </div>
                            </div>
                            <div class="question-box">
                                <h4>What herbal treatments are available?</h4>
                                <div class="answer">
                                    <p>1. The most popular choice has been <strong>Black Cohosh</strong> extract, which was originally developed in Germany. However, several clinical studies in recent years show that Black Cohosh is no more effective than a placebo, or sugar pill. Additionally, in published studies, Black Cohosh was linked to liver toxicity, and weight gain</p>
                                    <p>2. Another popular phytoestrogen is <strong>Genistein</strong> which the active component of Soy Isoflavones. This ingredient is ER-beta positive which suggests links to safety concerns for women similar to the 2002 NIH study which was shut down before completion due to a significant percentage of women in the active study group getting forms of cancers and they were ER-alpha and ER-beta positive.</p>
                                    <p>3. <strong>Hops Extract</strong> is even worse where it is ER-alpha and ER-beta positive which is very bad and completely estrogenic.</p>
                                    <p>4. <strong>Pueraria Mirifica</strong> is another potentially unsafe ingredient that is also estrogenic and is ER-beta positive.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p><strong><sup>*</sup>These statements have not been evaluated by the Food and Drug Administration. This product is not intended to diagnose, treat, cure, or prevent any disease.</strong></p>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
	jQuery(document).ready(function($) {
		$('.my-slider').unslider({
            nav: false,
            autoplay: true,
            arrows: false,
            delay: 8000
        });
	});
</script>

@endsection
