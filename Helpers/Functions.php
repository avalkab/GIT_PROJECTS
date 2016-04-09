<?php

function cache_expire_counter() {
    return '<p>selam</p>';
}
hook()->setEvent('body_end', 'cache_expire_counter');