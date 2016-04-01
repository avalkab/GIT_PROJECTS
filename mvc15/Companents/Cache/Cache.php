<?php namespace ERA\Companents;
class Cache extends \ACompanentAdapter implements \ICompanent {
    public $version = '2.1.32';
    public $expire = 60;
    public $handle;
    public $debug = 0;

    public function startCache() {
        //unset($_SESSION['cache']);
        \Hook::allow_compile(0);
        $this->debug = 1;
        $this->handle = $this->app()->route->getRouteUrl();

        if (empty($this->getCacheFile()) && \Hook::isCompile() == 0) {
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
        $data .= $this->getCacheFile();
        $this->app()->route->setResponse($data);
    }

    public function getCache() {
        unset($_SESSION['cache'][$this->handle]);
        $data = $this->createCacheFile($this->app()->route->getResponse());
        $_SESSION['cache'][$this->handle]['expire'] = time()+$this->expire;
    }

    public function reCache() {
        \Hook::allow_compile(1);
        $this->getCache();
        $this->setCache();
    }

    /* FİLE */
    private function createCacheFile($data) {
        $filename = $this->cacheFile();
        $f = new \File;
        $f->delete($filename);
        $f->create($filename);
        $f->set($filename, $data);
        return $data;
    }

    private function getCacheFile() {
        return \File::getInstance()->get($this->cacheFile());
    }

    private function cacheFile() {
        return __CACHE.md5($this->handle).'.html';
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
