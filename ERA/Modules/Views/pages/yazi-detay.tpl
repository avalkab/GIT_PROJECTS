<?php

    $post = post()->row();
    $meta = post()->metaAll('ARRAY_A');

    //print_r($meta);

    comment()->newComment();

?>
<!-- .main -->
    <div class="grid">
    <div class="main container">
        <!-- .content.left -->
        <div class="content left container">
            <!-- /.news-deatil -->
            <div class="news-detail row">
                <h1 class="news-detail-title"><?php echo $post->baslik; ?></h1>
                <img class="news-detail-img" src="<?php img($meta['_era_poster']); ?>" width="100%" height="230">
                <ul class="news-detail-info">
                    <li><?php dater($post->ekleme_tarihi); ?></li>
                    <li><?php echo $post->goruntuleme; ?> Görüntüleme</li>
                    <li>Aktifmi:<strong>Evet</strong></li>
                    <li><span class="stars p1"></span></li>
                </ul>

                <?php echo $post->veri; ?>

                @inc:widgets/diger_siteler.tpl@
            </div>
            <!-- /.news-deatil -->

            @inc:widgets/yorumlar.tpl@

            <!-- .top-bet-sites -->
            <div class="top-bet-sites container">
                <span class="tab-btn green tabItem active" data-target="#tbPopuler">EN POPÜLER</span>
                <span class="tab-btn green tabItem" data-target="#tbYeni">EN YENİ</span>
                <table id="tbPopuler" class="content-table container tabContent">
                    <tr class="titles">
                        <td>Logolar</td>
                        <td class="even">Domainler</td>
                        <td>Bonus</td>
                    </tr>
                    <tr>
                        <td><img src="images/logo.png" width="75"></td>
                        <td class="even">bixbet.com</td>
                        <td>250TL</td>
                    </tr>
                </table>
                <div id="tbYeni" class="tabContent">
                    <p>yeni</p>
                </div>
            </div>
            <!-- /.top-bet-sites -->

            <!-- .carousel -->
            <ul class="custom-sites container">
               <li>
               <i class="icon iCoin"></i>
               <a href="#">
                    <span class="title">%100 bonus veren siteler</span>
                    <p class="text">Lorem ipsum dolar site ameet.</p>
               </a>
               </li>
               <li>
               <i class="icon iEdit"></i>
               <a href="#">
                    <span class="title">Belge istemeyen siteler</span>
                    <p class="text">Lorem ipsum dolar site ameet.</p>
               </a>
               </li>
               <li>
               <i class="icon iBuild"></i>
               <a href="#">
                    <span class="title">Havale kabul eden siteler</span>
                    <p class="text">Lorem ipsum dolar site ameet.</p>
               </a>
               </li>
               <li>
               <i class="icon iMoney"></i>
               <a href="#">
                    <span class="title">Yatırım bonusu veren siteler</span>
                    <p class="text">Lorem ipsum dolar site ameet.</p>
               </a>
               </li>
               <li>
               <i class="icon iCard"></i>
               <a href="#">
                    <span class="title">Kredi kartı kabul eden siteler</span>
                    <p class="text">Lorem ipsum dolar site ameet.</p>
               </a>
               </li>
               <li>
               <i class="icon iSettings"></i>
               <a href="#">
                    <span class="title">Bedava bonus veren siteler</span>
                    <p class="text">Lorem ipsum dolar site ameet.</p>
               </a>
               </li>
            </ul>
            <!-- /.content -->
        </div>
        <!-- /.content.left -->

        <!-- .content.right -->
        <div class="content right container">
            @inc:widgets/html_sidebar_widgets.tpl@
        </div>
        <!-- /.content.right -->

    </div>
    </div>
    <!-- /.main -->