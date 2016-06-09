<?php
    $comments = comment()->post();

    function getSubCommentsById($id, $comments) {
        echo '<ul class="side-comments-list replies">';
        foreach ($comments as $key => $comment) {
            if($comment['yorum_id'] == $id) {
                echo '<li data-comment-id="'.$comment['id'].'">';
                echo '<span class="reply">Yanıtla</span>';
                echo '<a class="title" href="#">'.($comment['kullanici_adi']).'&nbsp;<i class="time">'.(dater($comment['ekleme_tarihi'])).'</i></a>';
                echo '<p>'.$comment['yorum'].'</p>';
                getSubCommentsById($comment['id'], $comments);
                echo '</li>';
            }
        }
        echo '</ul>';
    }
?>
<div class="container">
<span class="tab-btn tabItem active" data-target="#fullComments">YORUMLAR</span>
<span class="tab-btn tabItem" data-target="#leaveComment">YORUM YAP</span>
<div id="fullComments" class="side-comments content-table inContents container tabContent">
<?php if(sizeof($comments)>0) { ?>
<ul class="side-comments-list">
    <?php
    foreach($comments as $key => $comment) {
    if($comment['yorum_id'] == 0) {
    ?>
    <li data-comment-id="<?php echo $comment['id']; ?>">
        <i class="icon comment"></i>
        <a class="title" href="#"><?php echo $comment['kullanici_adi']; ?>&nbsp;<i class="time"><?php dater($comment['ekleme_tarihi']); ?></i></a>
        <p><?php echo $comment['yorum']; ?></p>
    <?php
            getSubCommentsById($comment['id'], $comments);
        }
    }
    ?>
    </li>
</ul>
<?php }else{ ?>
<p class="noComment">Hiç yorum bulunmamaktadır.</p>
<?php } ?>
</div>
<div id="leaveComment" class="content-table inContents container tabContent">
    <form id="yorumAlani" class="commentArea" method="post" _lpchecked="1">
        <input class="comment-text" type="text" name="yorum" placeholder="Yorum yaz...">
        <input type="hidden" name="yorum_id" value="0">
        <input class="comment-btn" type="submit" name="yorum_gonder" value="Gönder">
    </form>
</div>
</div>
<script type="text/javascript">
$(window).ready(function() {
    var id = '<?php echo id(); ?>';
    var url = '<?php echo __WEBROOT; ?>ajax/newComment';

    $("#yorumAlani").submit(function(e) {
        e.preventDefault();
        var url_data = $(this).serializeArray(); //+'&post_id=<?php echo id(); ?>';
        url_data[url_data.length] = {name: "icerik_id", value: '<?php echo id(); ?>'};
        $.post(url, url_data, function(response){
            console.log(response);
        });
    });
});
</script>