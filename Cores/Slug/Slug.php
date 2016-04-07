<?php namespace ERA\Core;

class Slug {

    public static function make($str = null, $ext = null) {
        if (is_string($str)) {
            $tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',','?');
            $eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','','');
            $str = str_replace($tr,$eng,$str);
            $str = strtolower($str);
            $str = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $str);
            $str = preg_replace('/\s+/', '-', $str);
            $str = preg_replace('|-+|', '-', $str);
            $str = preg_replace('/#/', '', $str);
            $str = str_replace(array('"',"'",'.','%'), '', $str);
            $str = trim($str, '-');
            return is_string($ext) ? $str.'.'.$ext : $str;
        }
    }

}