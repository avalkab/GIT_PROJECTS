<?php namespace ERA\Controllers;

class MetaController extends \BaseController{

    public function metaFixed($meta) {
        $keys = array_column($meta, 'anahtar');
        $values = array_column($meta, 'veri');
        $meta_combine = [];
        foreach ($keys as $key => $value) {
            if (!array_key_exists($value, $meta_combine)) {
                $meta_combine[$value] = $values[$key];
            }else{
                if (!is_array($meta_combine[$value])) {
                    $old = $meta_combine[$value];
                    unset($meta_combine[$value]);
                    $meta_combine[$value][] = $old;
                }
                $meta_combine[$value][] = $values[$key];
            }
        }
        return $meta_combine;
    }

}