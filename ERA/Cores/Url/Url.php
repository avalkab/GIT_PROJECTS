<?php namespace ERA\Core;

	class Url {
        protected static $urls;
        public static $base;

        public static function getUrls() {
            static::$urls = require(__ERA.'Configs/Urls.php');
        }

        public static function make($key = null, Array $values = null) {
            static::getUrls();
            return sizeof($values)>0 ? vsprintf(static::$urls[$key], $values) : static::$urls[$key];
        }
	}
