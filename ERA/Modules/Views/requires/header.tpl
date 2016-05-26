@mark:html_top@
<!DOCTYPE html>
<html lang="tr_TR">
<head>
<base href="@assets:@">
<meta charset="utf8">
@mark:html_head_top@
<link rel="stylesheet" type="text/css" href="js/carousel/css/carousel.css">
<link rel="stylesheet" type="text/css" href="http://owlgraphic.com/owlcarousel/owl-carousel/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@mark:html_head_bot@
</head>
<body style="background:url(images/bgs.jpg) 48.4% top no-repeat;">
@mark:html_body_top@

<!-- .header -->
<div class="header container">

<!-- .grid -->
<div class="grid">

<!-- .logo -->
<a class="logo" href="#"><img src="images/logo.png"></a>

<!-- .menü -->
<ul class="menu">
@mark:html_header_menu@
<li>
<a href="#">
<i class="icon ball"></i>
<span class="title">Bahis Siteleri</span>
</a>
</li>
<li>
<a href="#">
<i class="icon card"></i>
<span class="title">Casino Siteleri</span>
</a>
</li>
<li>
<a href="#">
<i class="icon coin"></i>
<span class="title">Poker Siteleri</span>
</a>
</li>
<li>
<a href="#">
<i class="icon spade"></i>
<span class="title">Güncel Bonuslar</span>
</a>
</li>
<li>
<a href="#">
<i class="icon news"></i>
<span class="title">Site Haberleri</span>
</a>
</li>
</ul>
<!-- /.menü -->
</div>
<!-- .grid -->

<!-- .header-search -->
<div class="header-search">
<i class="icon headerSearch"></i>
<?php searchForm('GET'); ?>
</div>
<!-- .header-search -->
</div>
<!-- /.header -->