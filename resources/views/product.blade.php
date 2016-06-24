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
            <div class="span8 product-info">
                <div class="row">
                    <h2><span>Safe and Effective</span> <span>Femina Plus</span> <span>with Fem-Fleur</span></h2>
                    <p>Made with all natural botanical ingredients, Femina Plus with Fem-Fleur is clinically proven to be safe and effective in relieving menopausal symptoms in as few as 7-10 days.</p>
                    <!-- <h2>Feel Better Faster with <br /> Femina<sup>&reg;</sup> Plus with Fem-Fleur<sup>&trade;</sup></h2> -->
                    <!-- <ul>
                        <li>No natural or synthetic estrogens, making it safer for daily use.</li>
                        <li>Typically starts working in 7 to 10 days.</li>
                        <li>Effectively relieves symptoms 6 times faster than black cohosh.</li>
                        <li>Free of synthetic and natural hormones, GMOs and gluten.</li>
                        <li>Backed by multiple studies that demonstrate its saftey and effectiveness.</li>
                    </ul> -->
                </div>
                <div id="product-options" class="row">
                    {{-- <a href="#" class="product-option">AUTO-REFILL<span>$36.00</span></a>
                    <a href="#" class="product-option">TWO-PACK<span>$77.90</span></a>
                    <a href="#" class="product-option">FOUR-PACK<span>$149.90</span></a>
                    <a href="#" class="product-option">SINGLE BOTTLE<span>$39.50</span></a> --}}
                    <form action="{{ url('/cart/fpClub/plan') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <button type="submit" class="product-option">AUTO-REFILL<span>$36.00</span></button>
                    </form>

                    <form action="{{ url('/cart/fpOneBottle/product') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <button type="submit" class="product-option">SINGLE BOTTLE<span>$39.50</span></button>
                    </form>

                    <form action="{{ url('/cart/fpTwoBottle/product') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <button type="submit" class="product-option">TWO-PACK<span>$77.90</span></button>
                    </form>

                    <form action="{{ url('/cart/fpFourBottle/product') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <button type="submit" class="product-option">FOUR-PACK<span>$149.90</span></button>
                    </form>
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
                <h2>Description</h2>
                <h3>Feel Better Faster</h3>
                <p>After taking Femina Plus for <strong>as few as 7-10 days</strong>, women of varying ages have reported significant relief from the following menopausal symptoms</p>
                <!-- <h3>Find Your Balance with Femina Plus<sup>&reg;</sup></h3> -->
                <!-- <p>Finding a healthy balance for both body and mind is especially important during menopause, when hormonal changes can make you feel like you’ve lost control of many aspects of your life. Many women turn to therapies that introduce additional hormones into their system – or use some herbal remedies that can do more harm than good – causing potentially dangerous or unpleasant side effects.</p>
                <p>Femina Plus is a groundbreaking supplement that offers women a new menopause experience. It is natural, effective and safe relief with no risk of side effects. The exclusive botanical blend, Fem-Fleur™, is shown to significantly relieve many of the most common symptoms of menopause. Femina Plus even relieves symptoms six times faster than black cohosh, one of the more common herbal supplements taken by women in menopause.</p> -->
            </div>
            <div id="tab-directions" class="tab-content">
                <h2>Directions</h2>
                <p>Take 1 capsule, twice daily, with a mail. Suitable for vegetarians, Non-GMO, water extracted. We do not use ingredients produced using biotechnology.</p>
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
                        <img src="img/angelica.png" />
                    </div>
                    <div class="span4 ingredient">
                        <h4>Cynanchum Wilfordii Root Extract</h4>
                        <img src="img/cynanchum.png" />
                    </div>
                    <div class="span4 ingredient">
                        <h4>Phlomis Umbrosa Root Extract</h4>
                        <img src="img/phlomis.png" />
                    </div>
                </div>
            </div>
            <div id="tab-reviews" class="tab-content">
                <h2>Reviews</h2>
                <p>NOTE: NEED YOTPO ACCOUNT FOR REVIEWS HERE</p>
            </div>
            <div id="tab-faq" class="tab-content">
                <h2>Frequently Asked Questions</h2>
                <h3>Femina Plus</h3>
                <div class="row">
                    <div class="span6">
                        <div class="question-box">
                            <h4>What is Femina Plus<sup>®</sup>?</h4>
                            <div class="answer">
                                <p>Femina is 100% Fem-Fleur™. Fem-Fleur is the fastest working, safest and most effective herbal menopause relief product on the market, offering relief from menopause symptoms in as few as 7 days with no side effects. It works six times faster than black cohosh.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>Does Femina Plus with Fem-Fleur do more than treat hot flashes and night sweats?</h4>
                            <div class="answer">
                                <p>Yes! One of the main symptoms of menopause is dry skin and dry eyes. With Femina Plus, women’s skin will regain its youthful look. Dryness in the eyes will also improve. Also, in the first clinical study, there was no weight gain in the women who	 took the ingredient Fem-Fleur, whereas black cohosh is linked to weight gain.  Another unique finding was that Fem-Fleur offered support for bone health in the first human clinical study.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>Does Femina Plus work for everyone?</h4>
                            <div class="answer">
                                <p>In rare cases, some women might not experience the benefits of Femina Plus with Fem-Fleur in 7-10 days. We urge you to keep on taking Femina Plus; statistically, 95% of the women in two open-label studies improved by the 3rd week.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>What is the best time to take Femina Plus?</h4>
                            <div class="answer">
                                <p>It doesn’t make a difference when you take Femina Plus, but for the first few times, take the capsules or soft gels with a small serving of food.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>Does Femina contain soy?</h4>
                            <div class="answer">
                                <p>Femina Plus is a combination of three root extracts, and there is no soy or soy derivatives in the formula.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>Is their caffeine in Femina Plus?</h4>
                            <div class="answer">
                                <p>There is no caffeine in Femina Plus.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>Does Femina contain hormone estrogen?</h4>
                            <div class="answer">
                                <p>There are no synthetic or natural hormones in Femina Plus. The ingredients are natural, GMO-free and not estrogenic.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>How long before I see/feel results?</h4>
                            <div class="answer">
                                <p>The active ingredients in Femina Plus have been clinically proven in three placebo-controlled, double-blind studies to work in as few as 7-10 days. You should take Femina Plus daily, 2 capsules or soft gels per day, to achieve the best results.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>Can I take Femina Plus with other dietary supplements or meds?</h4>
                            <div class="answer">
                                <p>There are no contraindications with Femina Plus, which means you can combine it with other dietary supplements without risk. As always consult a physician if you have questions when combining your prescription medications with dietary supplements.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>How should I store Femina Plus once I receive my purchase?</h4>
                            <div class="answer">
                                <p>Store your bottles of Femina Plus in a cool, dry location like a medicine cabinet.</p>
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="question-box">
                            <h4>Does it relieve hot flashes or night sweats?</h4>
                            <div class="answer">
                                <p>Femina Plus is clinically proven to relieve the symptoms of hot flashes and night sweats.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>Does it help boost energy?</h4>
                            <div class="answer">
                                <p>Femina Plus is clinically proven to relieve the symptoms of “tiredness” as defined in the 2nd and 3rd study. You should feel your old self returning.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>Will this help my mood? Memory?</h4>
                            <div class="answer">
                                <p>Femina is clinically proven to relieve the symptoms of “mood swings” and “memory” as defined in the 2nd and 3rd study.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>Is Femina Plus safe?</h4>
                            <div class="answer">
                                <p>The active ingredient in Femina, Fem-Fleur, has been evaluated by the FDA via the NDI process where the active ingredient called Fem-Fleur was proven to be safe.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>What if I miss a day?</h4>
                            <div class="answer">
                                <p>If you miss a day taking Femina Plus, resume taking your usual dose as soon as possible. The success of Femina Plus is driven by taking the product daily so the formula can work more effectively. If you miss a few days, the symptoms of menopause might return. Once you resume your regular dose, the symptoms should subside again after a few days.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>Where can I buy this in stores?</h4>
                            <div class="answer">
                                <p>Femina Plus is not available in retail outlets. It is exclusively available through the website, www.femina-plus.com </p>
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
                                <p>Within 3-5 days of date of order.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>How do I return my order?</h4>
                            <div class="answer">
                                <p>If you take Femina Plus daily, and it still does not work, you may return your order within 30 days. Contact (800) 219-4599 for more information.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <h3>Menopause</h3>
                <div class="row">
                    <div class="span6">
                        <div class="question-box">
                            <h4>What is menopause?</h4>
                            <div class="answer">
                                <p>Menopause means the menstrual cycle stops for at least 3-6 months. Other sources suggest if menstruation stops for 12 months, this is the true definition of being in menopause.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>At what age does menopause occur?</h4>
                            <div class="answer">
                                <p>Most commonly, this happens between the ages of 45 and 55, but it can occur earlier or later.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>What can cause early menopause?</h4>
                            <div class="answer">
                                <p>Early menopause might result from diet, the environment, genetics, autoimmune disease, infection, breast cancer and cancer treatments – including chemotherapy, radiation and surgery, such as hysterectomy and oophorectomy (removal of the ovaries).</p>
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="question-box">
                            <h4>What are the symptoms of menopause?</h4>
                            <div class="answer">
                                <p>As estrogen production decreases dramatically, “physiological changes” can include night sweats, hot flashes, vaginal dryness, dryness of skin, fatigue, hair loss, weakening of bones and cardiovascular problems. “Psychological changes” might include mood swings, irritability, insomnia and depression.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>Do all women experience the symptoms of menopause?</h4>
                            <div class="answer">
                                <p>8 out of 10 women in menopause show one or more of the symptoms. 50% of these women show symptoms that are so severe that it interferes with their daily life.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>How long will menopause last?</h4>
                            <div class="answer">
                                <p>According to the Journal of the American Medical Association (January 2015 report), the average time a woman will experience menopause is 7.4 years. 50% of the 45 million women in menopause will experience severe menopause, which can last up to 14 years.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <h3>Fem-Fleur</h3>
                <div class="row">
                    <div class="span6">
                        <div class="question-box">
                            <h4>What is Fem-Fleur?</h4>
                            <div class="answer">
                                <p>A mixture of three 100% safe and natural herbal extracts. These three herbals have been used and validated in written text for over 300 years. The combination represents the next generation menopause ingredient of choice.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>How is Fem-Fleur produced?</h4>
                            <div class="answer">
                                <p>Fem-Fleur is water extracted from botanicals, and the process is GMO-free and natural.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>Is Fem-Fleur safe?</h4>
                            <div class="answer">
                                <p>Four- and thirteen-week toxicity tests were performed in which Fem-Fleur was found to be non-toxic. When tested for liver-toxicity, Fem-Fleur was found to support the liver. Fem-Fleur was also tested for carcinogenicity with negative results. Additionally, Fem-Fleur is guaranteed to be 100% non-estrogenic, or not producing estrone or estradiol.</p>
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="question-box">
                            <h4>Have there been human clinical studies on Fem-Fleur?</h4>
                            <div class="answer">
                                <p>Yes. There are three human clinical studies conducted with Fem-Fleur. Each study is placebo controlled, double blind, and randomized. Fem-Fleur performed 6X better than placebo, and 10 of the 12 symptoms significantly improved. These were unprecedented results with an ingredient working 6X faster than black cohosh and 6x faster vs. all other nutra choices.</p>
                            </div>
                        </div>
                        <div class="question-box">
                            <h4>What herbal treatments are available?</h4>
                            <div class="answer">
                                <p>1. The most popular choice has been <strong>black cohosh</strong> extract, which was originally developed in Germany. However, several clinical studies in recent years show that black cohosh is no more effective than a placebo, or sugar pill. Additionally, in published studies, black cohosh was linked to liver toxicity and weight gain.</p>
                                <p>2. Another popular phytoestrogen is <strong>genistein</strong>, which the active component of soy isoflavones. This ingredient is ER-beta positive, which suggests links to safety concerns for women similar to the 2002 NIH study. This was shut down before completion, due to a significant percentage of women in the active study group getting forms of cancers when they were ER-alpha and ER-beta positive.</p>
                                <p>3. <strong>Hops extract</strong> is even worse, as it is ER-alpha and ER-beta positive, which is very bad and completely estrogenic.</p>
                                <p>4. <strong>Pueraria mirifica</strong> is another potentially unsafe ingredient that is also estrogenic and is ER-beta positive.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <p><strong><sup>*</sup>These statements have not been evaluated by the Food and Drug Administration. This product is not intended to diagnose, treat, cure, or prevent any disease.</strong></p>
            </div>
        </div>
    </div>
</section>

@endsection
