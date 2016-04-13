<?php namespace ERA\Core;
class Route
{
    const PATTERN_PARAM = '/{(int|str|any|opt)}/';
    const PATTERN_INT = '([0-9]+)';
    const PATTERN_STR = '([a-zA-Z-_]+)';
    const PATTERN_ANY = '([\w+-_]+)';
    const PATTERN_OPT = '/?([a-zA-Z0-9]+)?';
    const CONTROLLER_PATTERN = '/^([a-zA-Z]+)Controller:([a-zA-Z]+)$/';

    private $bootstrap;
    private $route_handle = false;
    private $routes = array();

    function __construct() {
        $this->bootstrap = new Bootstrap();
    }

    public function getRouteUrl() {
        return $this->bootstrap->url;
    }

    public function request($type, $url, $closure = null) {
        hook()->mark('request_start');
        if ($this->route_handle == false) {
            $page_name = md5($url);
            $pattern_data = $this->setPattern($url);
            $this->routes[$page_name]['pattern'] = $pattern_data['pattern'];
            if (preg_match('/'.$pattern_data['pattern'].'/', $this->getRouteUrl(), $route_matches)) {
                print_r( $route_matches );
                $this->route_handle = $page_name;
                hook()->mark('out_compile_start');
                if (hook()->isCompile()) {
                    if (is_object($closure)) {
                        $reflection = new \ReflectionFunction($closure);
                        $arguments  = $reflection->getParameters();
                        if($reflection->getNumberOfParameters()>0) {
                            //$values = $this->bootstrap->url_scheme['path'];
                            //$values = $route_matches;
                            foreach ($arguments as $key => $value) {
                                $parameters[$value->name] = $route_matches[$key+1];
                            }
                            $this->routes[$page_name]['vars']  = $parameters;
                            $this->routes[$page_name]['response'] = call_user_func_array($closure, $parameters);
                            extract($parameters);
                        }else{
                            $this->routes[$page_name]['response'] = call_user_func($closure);
                        }
                    }else{
                        if (preg_match(self::CONTROLLER_PATTERN, $closure, $matches)) {
                            $controller_name = $matches[1].'Controller';
                            require_once('Modules/Controllers/'.$controller_name.'.php');
                            $this->routes[$page_name]['response'] = call_user_method($matches[2], new $controller_name());
                        }
                    }
                    hook()->mark('in_compile_end');
                }else{
                    hook()->mark('compile_response');
                }
            }else{
                $this->route_handle = 0;
            }
        }
        hook()->mark('request_end');
    }

    public function get($url, $closure = null) {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->request('GET', $url, $closure);
        }
    }

    public function post($url, $closure = null) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->request('POST', $url, $closure);
        }
    }

    public function any($url, $closure = null) {
        $this->request('ANY', $url, $closure);
    }

    private function setPattern($url) {
        $url = str_replace('?', '\?', $url);
        if (preg_match(self::PATTERN_PARAM, $url)) {
            preg_match_all(self::PATTERN_PARAM, $url, $matches);
            foreach ($matches[0] as $key => $value) {
                $url = str_replace($value, $this->typeToPattern($matches[1][$key]), $url);
            }
            $url_parameters = array(
                'pattern' => '^'.str_replace('/', '\/', $url).'$'
            );
        }else{
            $url_parameters = array(
                'pattern' => '^'.str_replace('/', '\/', $url).'$'
            );
        }
        return $url_parameters;
    }

    public function getHandle() {
        return $this->route_handle;
    }

    public function getResponse() {
        return $this->routes[$this->route_handle]['response'];
    }

    public function setResponse($response) {
        $this->routes[$this->route_handle]['response'] = $response;
    }

    private function typeToPattern($type = null) {
        switch ($type) {
            case 'int': $pattern = self::PATTERN_INT; break;
            case 'str': $pattern = self::PATTERN_STR; break;
            case 'any': $pattern = self::PATTERN_ANY; break;
            case 'opt': $pattern = self::PATTERN_OPT; break;
            //default: $pattern = $this->typeToPattern('str'); break;
        }
        return $pattern;
    }

    public function run() {
        hook()->mark('run_begin');

        if ($this->route_handle) {
            echo $this->getResponse();
        }else{
            //view()->error('404');
            //header('HTTP/1.0 404 Not Found', true, 404);
            header('Location:http://localhost/dev/mvc/decorator.php?param=404');
        }

        hook()->mark('run_end');

        exit;
    }
}