<?php $comments = commentsWidget(5); ?>
<!-- .side-comments-->
<div class="side-comments container">
<h3>SON YORUMLAR</h3>
<ul class="side-comments-list">
    <?php foreach($comments as $key => $comment) {
    $title = postTitle($comment->post_id, $comment->tablo_adi, true);
    $url = Url::make($comment->tablo_adi.'-detay', [$title]);
    ?>
    <li id="comment_<?php echo $comment->username.'_'.$comment->comment_id; ?>">
        <i class="icon comment"></i>
        <a class="title" href="<?php echo $url; ?>" title="<?php echo $comment->username; ?>"><?php echo $comment->username; ?></a>
        <p><?php echo $comment->yorum; ?></p>
    </li>
    <?php unset($title); unset($url); } ?>
</ul>
</div>
<!-- /.side-commentsss-->

