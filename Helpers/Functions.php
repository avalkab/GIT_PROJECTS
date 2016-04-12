<?php
function app_debug() {
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
    echo '<input type="text" class="bio-pass" maxlength="1" tabindex="6">';
    echo '<input type="hidden" readonly="readonly">';
    echo '</div>';
    BiometricPassword::init('.bio-pass');

}

hook()->setEvent('run_end', 'pass_debug');
//hook()->setEvent('run_end', 'app_debug');