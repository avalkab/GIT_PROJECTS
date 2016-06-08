<div class="news-others">
<h4>Bu siteleri denediniz mi?</h4>
<?php foreach(post()->other() as $other) { ?>
<div class="news-other-item">
    <img src="<?php img($other['_era_poster']); ?>" width="140" height="90">
    <a class="news-other-itemR" href="<?php echo Url::make($other['tur'], [$other['sef_url']]); ?>">İncele</a>
    <a class="news-other-itemG" href="<?php echo $other['_era_site_url']; ?>" rel="external" target="_blank">Siteye git</a>
</div>
<?php } ?>
</div>