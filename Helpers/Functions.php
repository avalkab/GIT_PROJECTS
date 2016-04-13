<?php
function app_debug() {
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>';
    echo '<div id="ajax_password_wrapper"><input id="ajax_password" type="password" name="password"></div>';
    echo '<script type="text/javascript">
    $(document).ready(function(){

        var ajax_password_input = $("#ajax_password");
        ajax_password_input.on("keyup", function() {
            $.ajax({
                method : "POST",
                url : "http://localhost/dev/mvc/decorator.php?param=passwordValidator",
                data : {
                    password : ajax_password_input.val()
                },
                success: function(response) {
                    $("#ajax_password_wrapper_message").remove();
                    if ("ok" == response) {
                        $("#ajax_password_wrapper").append("<strong id=\"ajax_password_wrapper_message\" style=\"background-color:#0f7; padding:5px;\">OK</strong>");
                    }else{
                        $("#ajax_password_wrapper").append("<strong id=\"ajax_password_wrapper_message\" style=\"background-color:#f70; padding:5px;\">NO</strong>");
                    }
                }
            });
        });
    });
    </script>';

    echo '<pre>
    <h1>DEBUG</h1>';
    print_r(app());
    echo '</pre>';
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

//hook()->setEvent('run_end', 'pass_debug');
hook()->setEvent('run_end', 'app_debug');