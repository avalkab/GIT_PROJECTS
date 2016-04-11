<?php
function app_debug() {
    echo '<pre>
    <h1>DEBUG</h1>';
    print_r(app());
    echo '</pre>';
}

hook()->setEvent('run_end', 'app_debug');