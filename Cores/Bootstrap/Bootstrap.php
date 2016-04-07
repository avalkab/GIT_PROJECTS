<?php namespace ERA\Core;

class Bootstrap {
    public $url_scheme = null;

    function __construct() {
        $this->url = $_REQUEST['param'];
        $this->url_scheme = $this->parseUrl();
        $this->url_scheme['route_url'] = is_array($this->url_scheme['path'])
        ? implode('/', $this->url_scheme['path'])
        : $this->url_scheme['path'];

    }

    public function parseUrl() {
         $url = parse_url($this->doTrim($this->url));
         if (!empty($url['path'])) {
            $url['path'] = explode('/', $this->doTrim($url['path']));
         }else{
            $url['path'] = '/';
         }
         if (isset($url['query'])) {
            $url['query'] = $this->querystringToArray($url['query']);
         }
         return $url;
    }

    private function querystringToArray($query_string) {
        foreach (explode('&', $query_string) as $key => $value) {
            $param = explode('=', $value);
            $qs[$param[0]] = $param[1];
         }
         return $qs;
    }

    private function doTrim($params = null) {
        $params = trim($params);
        $params = ltrim($params,'/');
        $params = rtrim($params,'/');
        return $params;
    }
}