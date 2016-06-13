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
                    <a href="#" class="product-option">TESTING</a>
                    <a href="#" class="product-option">TESTING</a>
                    <a href="#" class="product-option">TESTING</a>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="product-info-tabs">
    <div class="container">
        <nav>
            <ul>
                <li class="active-tab"><a href="#">DESCRIPTION</a></li>
                <li><a href="#">INGREDIENTS</a></li>
                <li><a href="#">REVIEWS</a></li>
                <li><a href="#">F.A.Q.</a></li>
            </ul>
        </nav>
    </div>
</div>
<section id="tile-product-info">
    <div class="container">
        <div class="row">
            <h2>Find Your Balance with Femina Plus<sup>&reg;</sup></h2>
            <p>Nam egestas tempus nisi sit amet fringilla. Vivamus non faucibus mauris. Morbi suscipit feugiat porta. Phasellus sed justo nunc. Nulla sagittis, risus a commodo posuere, est turpis egestas tellus, et efficitur mauris nunc sit amet ligula. Praesent tincidunt ultrices felis, sit amet efficitur dolor sagittis a. In pulvinar erat nec lacinia volutpat. Sed efficitur ut elit eget aliquet. Morbi tempus semper elit. Praesent vestibulum hendrerit nisl, quis mollis urna consequat id. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec venenatis dolor eu justo tincidunt rhoncus. Nam mi dolor, tincidunt eu nibh vitae, auctor tempus nisl. Maecenas nec enim lacinia, vestibulum elit nec, maximus elit.</p>
            <p>In nec enim pharetra, lacinia mauris id, ultrices felis. Donec sit amet enim aliquet, dignissim leo id, convallis enim. Morbi at metus ultrices leo placerat pretium sit amet a felis. Quisque vel justo et eros interdum pharetra. Quisque rhoncus interdum augue, vehicula molestie risus viverra sed. Sed sit amet dictum eros, maximus interdum libero. In a elit in magna fringilla molestie quis non diam. Integer eu ullamcorper arcu. Nullam aliquet eget erat ut volutpat. Pellentesque pharetra venenatis tincidunt. Morbi vitae dapibus massa, id accumsan libero. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin fringilla arcu ac lorem eleifend lacinia. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>
            <p>Integer ullamcorper faucibus commodo. Morbi blandit velit quam, vitae facilisis justo cursus at. Nulla a libero non ante vulputate faucibus. Nulla hendrerit interdum ipsum, ut molestie velit lobortis vitae. Etiam id fermentum diam. Praesent quam velit, accumsan eget bibendum quis, tincidunt ut mauris. Phasellus condimentum hendrerit mauris vel lacinia. Nullam a ullamcorper magna. Quisque porttitor fermentum aliquet. Mauris eget massa nec erat molestie faucibus. Integer id vehicula mi. Suspendisse vitae magna felis. Nunc ultrices iaculis leo tempor efficitur. Vivamus non tortor tellus.</p>
        </div>
    </div>
</section>

@endsection
