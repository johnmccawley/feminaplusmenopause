<!DOCTYPE HTML>
<html>

<head>

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('meta_description')
    @yield('meta_keywords')
    <meta name="google-site-verification" content="oneSN1pJW_b41ye81_Nk-cCV-ssltIqxaTJtu6Y7L14"/>
    <link rel="canonical" href=<?php echo URL::current(); ?> />


    <title>@yield('page_title') | Femina Plus</title>
    <link href="{{ url('/css/style.css') }}" rel="stylesheet">
    <script src="{{ url('/js/all.js') }}"></script>

    <link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicons/favicon-194x194.png" sizes="194x194">
    <link rel="icon" type="image/png" href="/favicons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/favicons/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/favicons/manifest.json">
    <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#9f00a7">
    <meta name="msapplication-TileImage" content="/favicons/mstile-144x144.png">
    <meta name="msapplication-config" content="/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    @yield('styles')

</head>

<body id="@yield('page_id')" class="site">
    <div id="site-wrapper">
        <div id="site-canvas">
            <div id="menu-overlay">
            </div>
            <header>
                <div id="sub-header" class="row">
                    <div class="container">
                        <div class="row">
                            <nav>
                                <ul>
                                    <li><a href="/home"><i class="fa fa-user" aria-hidden="true"></i></i>MY ACCOUNT</a></li>
                                    <li><a href="/contact"><i class="fa fa-comment" aria-hidden="true"></i>CONTACT</a></li>
                                    <li><a href="/cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i>CART</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div id="main-header" class="row">
                    <div class="container">
                        <div class="row">
                            <div class="span2 logo">
                                <a href="/">
                                    <img class="full" src="{{ url('/img/logo.png') }}" />
                                </a>
                            </div>
                            <div class="span10">
                                <nav id="desktop-nav">
                                    <ul>
                                        <li><a class="<?=($page_id == 'home') ? 'active-nav' : '';?>" href="/">HOME</a></li>
                                        <li><a class="<?=($page_id == 'product') ? 'active-nav' : '';?>" href="/product">PRODUCT</a></li>
                                        <li><a class="<?=($page_id == 'clinical') ? 'active-nav' : '';?>" href="/clinical">CLINICALS</a></li>
                                        <li class="accent-nav"><a href="/buy">BUY NOW!</a></li>
                                    </ul>
                                </nav>
                                <nav id="mobile-nav">
                                    <div class="cart">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>Cart: 0
                                        <br />
                                        <a href="/cart">VIEW CART</a>
                                    </div>
                                    <ul>
                                        <li><a class="<?=($page_id == 'home') ? 'active-nav' : '';?>" href="/">HOME</a></li>
                                        <li><a class="<?=($page_id == 'product') ? 'active-nav' : '';?>" href="/product">PRODUCT</a></li>
                                        <li><a class="<?=($page_id == 'clinical') ? 'active-nav' : '';?>" href="/clinical">CLINICALS</a></li>
                                        <li><a class="<?=($page_id == 'contact') ? 'active-nav' : '';?>" href="/contact">CONTACT</a></li>
                                        <li class="accent-nav"><a href="/buy">BUY NOW!</a></li>
                                    </ul>
                                </nav>
                                <button id="mobile-nav-btn">
        							<span>MENU</span>
        							<i id="menu-open" class="fa fa-4x fa-bars"></i>
        							<i id="menu-close" class="fa fa-4x fa-times"></i>
        						</button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <main class="site-content">
                @yield('content')
            </main>

            @if ($page_id != "cart" AND $page_id != "checkout" AND $page_id != "home" AND $page_id != "account" AND $page_id != "coupon"  AND $page_id != "receipt")
            <div id="attachment-fpc">
                <div class="container">
                    <div class="row">
                        <div class="product-image">
                            <img class="product-image" src="img/bottle.png" />
                        </div>
                        <div class="offer-info">
                            <h5>Join the Femina Plus<sup>&reg;</sup> Auto-Refill Club!</h5>
                            <p>You will receive one bottle per month, delivered monthly for 12 months and receive the 13th bottle for free.
Buy Femina Plus for best results in managing menopause symptoms. Embrace aging with Femina Plus which works fast, effective and is proven and tested. </p>
                            @if ($page_id != "buy")
                            <a href="/buy" class="secondary-cta-btn">BUY NOW</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <footer>
                <div id="main-footer">
                    <div class="container">
                        <div class="row">
                            <div id="footer-nav" class="span4">
                                <nav>
                                    <ul>
                                        <li><a href="/">Home</a></li>
                                        <li><a href="/product">Product</a></li>
                                        <li><a href="/clinical">Clinicals</a></li>
                                        <li><a href="/buy">Buy Now</a></li>
                                        <!-- <li><a href="#">Femina Plus Club</a></li> -->
                                        <li><a href="/product#tab-faq">Q & A</a></li>
                                        <li><a href="/contact">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div id="contact-info" class="span4">
                                <ul>
                                    <span>STAY IN TOUCH</span>
                                    <li><a href="tel:800-219-4599"><i class="fa fa-phone" aria-hidden="true"></i>800.219.4599</a></li>
                                    <li><a href="mailto:info@feminaplusmenopause.com"><i class="fa fa-envelope" aria-hidden="true"></i>info@feminaplusmenopause.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="sub-footer">
                    <div class="container">
                        <div class="row">
                            <ul>
                                <li><a href="/privacy">PRIVACY POLICY</a></li>
                                <li><a href="/terms">TERMS OF SERVICE</a></li>
                                <li>
                                    FOLLOW US
                                    <a href="https://www.facebook.com/MyFeminaPlus/?hc_ref=SEARCH&fref=nf"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="https://twitter.com/MyFeminaPlus"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    <a href="https://www.instagram.com/feminaplusmenopause/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                </li>
                            </ul>
                            <span class="copy align-right">&copy; 2016 FEMINAPLUS ALL RIGHTS RESERVED</span>
                        </div>
                        <div class="row disclaimer-text">
                            <p><sup>*</sup>These statements have not been evaluated by the Food and Drug Administration. This product is not intended to cure, treat or prevent any disease.</p>
                        </div>
                    </div>
                </div>

                @if(env('APP_ENV') == 'production')
                    <!-- Facebook Pixel Code -->
                    <script>
                        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                                n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
                            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
                            t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
                                document,'script','https://connect.facebook.net/en_US/fbevents.js');

                        fbq('init', '628465503996501');
                    </script>
                    <noscript>
                        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=628465503996501&ev=PageView&noscript=1"/>
                    </noscript>
                    <!-- End Facebook Pixel Code -->

                    @if ($page_id != "receipt")
                        <!-- Google Analytics Code -->
                        <script>
                            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                                        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

                            ga('create', 'UA-77053752-1', 'auto');
                            ga('send', 'pageview');
                        </script>
                        <!-- End Google Analytics Code -->
                    @endif

                    <!-- Hotjar Tracking Code for https://feminaplusmenopause.com/ -->
                    <script>
                        (function(h,o,t,j,a,r){
                            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                            h._hjSettings={hjid:292068,hjsv:5};
                            a=o.getElementsByTagName('head')[0];
                            r=o.createElement('script');r.async=1;
                            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                            a.appendChild(r);
                        })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
                    </script>

                @endif
            </footer>
            @yield('scripts')
        </div>
    </div>
</body>
</html>
