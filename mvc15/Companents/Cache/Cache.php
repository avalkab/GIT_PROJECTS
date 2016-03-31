<?php namespace ERA\Companents;
class Cache extends \ACompanentAdapter implements \ICompanent {
    public $version = '2.1.32';
    public $expire = 500;
    public $handle;
    public $debug = 0;

    public function startCache() {
        //unset($_SESSION['cache']);
        \Hook::allow_compile(0);
        $this->debug = 1;
        $this->handle = $this->app()->route->getRouteUrl();

        if (!isset($_SESSION['cache'][$this->handle]['content']) && \Hook::isCompile() == 0) {
            $this->reCache();
        }

        if ($_SESSION['cache'][$this->handle]['expire'] <= time() && \Hook::isCompile() == 0) {
            $this->reCache();
            echo '<p style="display:inline-block; font-size:11px; padding:0 6px; background-color:#0cf; border-radius:2px;">Önbellek yenilendi</p>';
        }
    }

    public function setCache() {
        header("Content-Type:text/html; charset=utf8");
        $data = '<p style="display:inline-block; font-size:11px; padding:0 6px; background-color:#fc0; border-radius:2px;">Önbellek';
        $data .= ' : <strong color="white">'.($_SESSION['cache'][$this->handle]['expire']-time()).'sn</strong></p> ';
        $data .= $_SESSION['cache'][$this->handle]['content'];
        $this->app()->route->setResponse($data);
    }

    public function getCache() {
        unset($_SESSION['cache'][$this->handle]);
        $_SESSION['cache'][$this->handle]['content'] = $this->app()->route->getResponse();
        $_SESSION['cache'][$this->handle]['expire'] = time()+$this->expire;
    }

    public function reCache() {
        \Hook::allow_compile(1);
        $this->getCache();
        $this->setCache();
    }

    public function debugCache() {
        if ($this->debug) {
            echo '<hr><h2>Önbellek Yapısı</h2><time>Şuanki zaman: '.(time()).'</time>';
            echo '<pre>';
            print_r($_SESSION['cache']);
            echo '</pre>';
        }
    }
}
