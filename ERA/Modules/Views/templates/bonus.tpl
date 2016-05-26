<!-- .carousel -->
<div id="bonuslarContainer" class="carousel container">
    <span class="btn line tabItem active" data-target="#sonBonuslar">Son Bonuslar</span>
    <span class="btn line ml3 tabItem" data-target="#populerBonuslar">Popüler Bonuslar</span>
    <div class="carousel-content container">
    <div class="owlCarouselSelector tabContent" id="sonBonuslar">
        <?php foreach (Bonus::getAll() as $key => $value) { ?>
        <div class="item">
        <a href="<?php echo Url::make('bonus-detay', [$value->sef]); ?>">
            <img src="<?php echo __WEBROOT ?>public/<?php echo $value->gorsel_url; ?>" alt="<?php echo $value->baslik; ?>">
            <span class="baslik"><?php echo $value->baslik; ?></span>
        </a>
        </div>
        <?php } ?>
    </div>
    <div class="owlCarouselSelector tabContent" id="populerBonuslar">
        <?php foreach (Bonus::getAllPopular() as $key => $value) { ?>
        <div class="item">
        <a href="<?php echo Url::make('bonus-detay', [$value->sef]); ?>">
            <img src="<?php echo __WEBROOT ?>public/<?php echo $value->gorsel_url; ?>" alt="<?php echo $value->baslik; ?>">
            <span class="baslik"><?php echo $value->baslik; ?></span>
        </a>
        </div>
        <?php } ?>
    </div>
    </div>
</div>
<!-- /.carousel -->