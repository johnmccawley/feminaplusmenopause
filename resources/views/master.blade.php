<!DOCTYPE HTML>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>@yield('page_title') | Femina Plus</title>
<link href="css/style.css" rel="stylesheet">
<script type="text/javascript" src="js/all.js"></script>

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
                                    <li><a href="/contact"><i class="fa fa-comment" aria-hidden="true"></i>CONTACT</a></li>
                                    <li><a href="/cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i>CART (0)</a></li>
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
                                    <img class="full" src="img/logo.png" />
                                </a>
                            </div>
                            <div class="span10">
                                <nav id="desktop-nav">
                                    <ul>
                                        <li><a class="<?=($page_id == 'home') ? 'active-nav' : '';?>" href="/">HOME</a></li>
                                        <li><a class="<?=($page_id == 'product') ? 'active-nav' : '';?>" href="/product">PRODUCT</a></li>
                                        <li><a class="<?=($page_id == 'clinical') ? 'active-nav' : '';?>" href="/clinical">CLINICALS</a></li>
                                        <li class="accent-nav"><a href="#">BUY NOW!</a></li>
                                    </ul>
                                </nav>
                                <nav id="mobile-nav">
                                    <div class="cart">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>Cart: 0
                                        <br />
                                        <a href="#">VIEW CART</a>
                                    </div>
                                    <ul>
                                        <li><a class="<?=($page_id == 'home') ? 'active-nav' : '';?>" href="/">HOME</a></li>
                                        <li><a class="<?=($page_id == 'product') ? 'active-nav' : '';?>" href="/product">PRODUCT</a></li>
                                        <li><a class="<?=($page_id == 'clinical') ? 'active-nav' : '';?>" href="/clinical">CLINICALS</a></li>
                                        <li><a class="<?=($page_id == 'contact') ? 'active-nav' : '';?>" href="/contact">CONTACT</a></li>
                                        <li class="accent-nav"><a href="#">BUY NOW!</a></li>
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
                                        <li><a href="#">Femina Plus Club</a></li>
                                        <li><a href="/product/faq">F.A.Q.</a></li>
                                        <li><a href="/contact">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div id="contact-info" class="span4">
                                <ul>
                                    <span>STAY IN TOUCH</span>
                                    <li><a href="tel:800-219--4599"><i class="fa fa-phone" aria-hidden="true"></i>800.219.4599</a></li>
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
                                    <a href="https://www.facebook.com/feminaplusforwomen/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </li>
                            </ul>
                            <span class="copy align-right">&copy; 2016 FEMINAPLUS ALL RIGHTS RESERVED</span>
                        </div>
                        <div class="row disclaimer-text">
                            <p><sup>*</sup>Femina Plus is clinically proven to relieve the uncomfortable symptoms of menopause in as few as 7 days.</p>
                            <p><sup>*</sup>These statements have not been evaluated by the Food and Drug Administration. This product is not intended to cure, treat or prevent any disease.</p>
                        </div>
                    </div>
                </div>
            </footer>
            @yield('scripts')
        </div>
    </div>
</body>
</html>
