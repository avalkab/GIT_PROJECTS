<?php namespace ERA\Companents;
class Cache extends \ACompanentAdapter implements \ICompanent {
    public $version = '2.1.32';
    public $expire = 500;
    public $handle;
    public $debug = 0;


    /* ÖNBELLEK YÖNETİMİ */
    public function startCache() {
        hook()->allowCompile(0);
        $this->debug = 1;
        $this->handle = route()->getRouteUrl();

        if (empty($this->getCacheFile()) && hook()->isCompile() == 0) {
            $this->reCache();
        }

        if ($this->isExpired() && hook()->isCompile() == 0) {
            $this->reCache();
            echo '<p style="display:inline-block; font-size:11px; padding:0 6px; background-color:#0cf; border-radius:2px;">Önbellek yenilendi</p>';
        }
    }

    public function setCache() {
        header("Content-Type:text/html; charset=utf8");
        $data = '<p style="display:inline-block; font-size:11px; padding:0 6px; background-color:#fc0; border-radius:2px;">Önbellek';
        $data .= ' : <strong color="white">'.($this->fileMT()-time()).'sn</strong></p> ';
        $data .= $this->getCacheFile();
        route()->setResponse($data);

    }

    public function getCache() {
        \File::getInstance()->delete($this->cacheFile());
        $data = $this->createCacheFile(route()->getResponse());
    }

    public function reCache() {
        hook()->allowCompile(1);
        $this->getCache();
        $this->setCache();
    }

    /* DOSYA YÖNETİMİ */
    private function createCacheFile($data) {
        $filename = $this->cacheFile();
        $f = new \File;
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

    private function fileMT() {
        return \File::getInstance()->modifiedTime($this->cacheFile())+$this->expire;
    }
    private function isExpired() {
        return ($this->fileMT()<time()) ? 1 : 0;
    }

    /* DEBUG */
    public function debugCache() {
        if ($this->debug) {
            echo '<hr><h2>Önbellek Yapısı</h2>';
            echo '<time>Şuanki zaman: '.(date('d-m-Y H:i:s')).'</time>';
            echo '<br>';
            echo '<time>Önbellek sonlanma tarihi: '.(date('d-m-Y H:i:s', $this->fileMT())).'</time>';
        }
        print_r( \Folder::getInstance()->listFiles(__CACHE) );
    }
}
