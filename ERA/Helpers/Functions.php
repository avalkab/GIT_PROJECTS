<?php
function login_form($method) {
    echo html()
    ->createElement('form',['id' => 'loginForm','method' => $method, 'action' => 'http://localhost'.__REQ, 'csrf' => true], null, false)
    ->createElement('input', ['type' => 'text', 'name' => 'username', 'placeholder' => 'Kullanıcı adı'], null, false)
    ->createElement('input', ['type' => 'password', 'name' => 'password', 'placeholder' => 'Şifre'], null, false)
    ->createElement('input', ['type' => 'submit', 'name' => 'submit_login_form', 'value' => 'Giriş Yap'], null, false)
    ->closeElement('form')
    ->getElements();
    return html()->isValidToken();
}

function searchForm($method = 'POST') {
    $token_value = html()->guard->store('headerSearchToken');

    html()
    ->createElement('form',['id' => 'headerSearchForm','method' => 'GET', 'action' => __WEBROOT.'arama', 'csrf' => false], null, false)
    ->createElement('input', ['class' => 'q', 'type' => 'text', 'name' => 'q', 'placeholder' => 'Senin için ne yapabilirim?'], null, false)
    ->createElement('input', ['type' => 'hidden', 'name' => 'headerSearchToken', 'value' => $token_value], null, false)
    ->closeElement('form');

    echo html()->getElements();
}

function app_debug() {
    /*
    echo '<form method="post" action="ajax/login" onsubmit="return false;">';
    echo '<h3>Üye girişi</h3>';
    echo '<input id="username" type="text" name="username" maxlenght="24">';
    Password::createElement("password", "ajax/passwordValidator", true);
    echo '<input id="login" type="submit" name="login">';
    echo '</form>';
    ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#login").click(function(){
            var form = $(this).parent('form');
            var i_username = form.find('#username').val();
            var i_password = form.find('#ajax_password').val();
            $.ajax({
                method : 'POST',
                url : 'http://localhost/dev/mvc/decorator.php?param=ajax/login',
                data : {
                    username : i_username,
                    password : i_password
                },success:function(response) {
                    console.log(response);
                }
            });
        });
    });
    </script>
    <?php
    //Password::createElement('password', 'ajax/passwordValidator', true);
    */

    /*
    $post_status = login_form('POST');
    echo 'POST STATUS : '.$post_status;
    */

    /*
    echo '<pre>
    <h1>DEBUG</h1>';
    print_r(app());
    echo '</pre>';
    */
}

function pass_debug() {
    /*
    $password = Password::valid('eE1$2345678');
    echo '<input type="text" value="'.Password::generate(10).'">';
    */
    echo '<div class="bio-pass-wrapper">';
    echo '<input type="text" class="bio-pass" maxlength="1" tabindex="1">';
    echo '<input type="text" class="bio-pass" maxlength="1" tabindex="2">';
    echo '<input type="text" class="bio-pass" maxlength="1" tabindex="3">';
    echo '<input type="text" class="bio-pass" maxlength="1" tabindex="4">';
    echo '<input type="text" class="bio-pass" maxlength="1" tabindex="5">';
    echo '<input type="text" class="bio-pass" maxlength="1" tabindex="6" id="bio_pas_end">';
    echo '<input type="hidden" readonly="readonly">';
    echo '</div>';
    BiometricPassword::init('.bio-pass');
}

function image($url, $watermark = false) {
    $handle = new Image($url);
    $handle->jpeg_quality = 70;
    $handle->file_new_name_body = 'image_resized';
    $handle->image_resize       = true;
    $handle->image_x            = 100;
    $handle->image_ratio_y      = true;

    if ($watermark == true) {
        $handle->image_watermark = 'watermark.png';
        $handle->image_watermark_position = 'BR';
    }

    header('Content-type: ' . $handle->file_src_mime);
    echo $handle->process();
    die();
}

function banners() {
    $banners = sql()
    ->select(['icerikler.baslik', 'icerik_meta.veri as img'])
    ->from(['icerikler'])
    ->join('inner', 'icerik_meta', ['icerikler.id','=', 'icerik_meta.icerik_id', true])
    ->where(['icerik_meta.anahtar','=','_era_slider_image'])
    ->limit(0,10)
    ->all();
    return view()->setVars(['banners' => $banners])->template('banner');
}

function javascriptSettings() {
    return '<script type="text/javascript">
    var root_url = "'.(__WEBROOT).'";
    </script>';
}

hook()->setEvent('page_top', 'banners');
hook()->setEvent('html_head_top', 'javascriptSettings');

//hook()->setEvent('run_end', 'app_debug');
//hook()->setEvent('run_end', 'pass_debug');
//hook()->setEvent('document_top', 'image', [__ROOT.'sample.jpg', true]);
//image(__ROOT.'sample.jpg', false);
