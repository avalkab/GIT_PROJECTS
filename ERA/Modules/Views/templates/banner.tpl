<?php

$banners = $this->getVar('banners'); $banner_count = sizeof($banners);
?>
<!-- .banner -->
<div class="banner container">
<div id="bonus_kazan_banner" class="carousel slide" data-ride="carousel">

<!-- Indicators -->
<ol class="carousel-indicators">
<?php for($i = 0; $i<$banner_count; $i++) { ?>
<li data-target="#bonus_kazan_banner" data-slide-to="<?php echo $i; ?>" <?php if($i == 0) { echo 'class="active"'; } ?>></li>
<?php } ?>
</ol>

<!-- Wrapper for slides -->
<div class="carousel-inner" role="listbox">
    <?php foreach($banners as $key => $value) { ?>
    <div class="item <?php if($key == 0) { echo 'active'; } ?>">
    <img class="img-responsive" src="<?php echo __UPLOADS.$value->img; ?>" title="<?php echo $value->baslik; ?>">
    <div class="carousel-caption">
        <h3><?php echo $value->baslik; ?></h3>
        <p><?php echo $value->veri; ?></p>
        <?php if($value->url) { ?>
        <a href="<?php echo $value->url; ?>">Detay</a>
        <?php } ?>
    </div>
    </div>
    <?php } ?>
</div>
<!-- Left and right controls -->

<a class="left carousel-control" href="#bonus_kazan_banner" role="button" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
</a>
<a class="right carousel-control" href="#bonus_kazan_banner" role="button" data-slide="next">
<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
</a>
</div>
</div>
<!-- /.banner -->