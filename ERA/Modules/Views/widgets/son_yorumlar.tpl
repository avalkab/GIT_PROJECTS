<?php $comments = commentsWidget(); ?>
<!-- .side-comments-->
<div class="side-comments container">
<h3>SON YORUMLAR</h3>
<ul class="side-comments-list">
    <?php foreach($comments as $key => $comment) { ?>
    <li id="yorum_<?php echo $comment->kullanici_adi.'_'.$comment->id; ?>">
        <i class="icon comment"></i>
        <a class="title" href="<?php echo __WEBROOT.$comment->sef; ?>" title="<?php echo $comment->kullanici_adi.' '.$comment->yorum.' diyor.'; ?>"><?php echo $comment->kullanici_adi; ?></a>
        <p><?php echo $comment->yorum; ?></p>
    </li>
    <?php } ?>
</ul>
</div>
<!-- /.side-commentsss-->

