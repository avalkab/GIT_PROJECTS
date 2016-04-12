<?php
function app_debug() {
    echo '<pre>
    <h1>DEBUG</h1>';
    print_r(app());
    echo '</pre>';
}

function pass_debug() {

    $password = Password::valid('eE1$2345678');
    echo '<input type="text" value="'.Password::generate(10).'">';

}

hook()->setEvent('run_end', 'pass_debug');
hook()->setEvent('run_end', 'app_debug');