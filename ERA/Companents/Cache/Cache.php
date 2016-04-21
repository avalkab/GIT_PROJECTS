<?php namespace ERA\Companents;
class Cache extends \ACompanentAdapter implements \ICompanent {
    public $version = '0.1.32';
    public $expire = 500;
    public $handle;
    public $debug = 0;

    public $file;
    public $folder;

    function __construct() {
        parent::__construct();
        $this->file = new \File;
        $this->folder = new \Folder;
    }


    /* ÖNBELLEK YÖNETİMİ */
    public function startCache() {
        hook()->allowCompile(0);
        $this->debug = 0;
        $this->handle = route()->getRouteUrl();

        if (empty($this->getCacheFile()) && hook()->isCompile() == 0) {
            $this->reCache();
        }

        if ($this->isExpired() && hook()->isCompile() == 0) {
            $this->reCache();
            echo '<p id="cache_time" style="display:inline-block; font-size:11px; padding:0 6px; background-color:#0cf; border-radius:2px;">Önbellek yenilendi</p>';
        }
    }

    public function setCache() {
        //header("Content-Type:text/html; charset=utf8");
        $data = '<p id="cache_time" style="display:inline-block; font-size:11px; padding:0 6px; background-color:#fc0; border-radius:2px;">Önbellek';
        $data .= ' : <strong color="white">'.($this->fileMT()-time()).'sn</strong></p> ';
        $data .= $this->getCacheFile();
        $data .= $this->cacheExpireCounter();
        route()->setResponse($data);

    }

    public function getCache() {
        $this->file->delete($this->cacheFile());
        $data = $this->createCacheFile(route()->getResponse());
    }

    public function reCache() {
        hook()->allowCompile(1);
        $this->getCache();
        $this->setCache();
    }

    public function cacheExpireCounter() {
        return '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script>
        function isTimeUp(t) {
            if (t <= 0 || isNaN(t) || t == undefined) { /* location.reload(); */ }
        }
        $(document).ready(function() {
            var s = $("#cache_time strong").eq(0);
            var t = s.text();
                t = t.replace("sn", "");
                t = parseInt(t,10);

            isTimeUp(t);
            setInterval(function(){
                isTimeUp(t);
                t -= 1;
                s.text(t+"sn");
            }, 1000);
        });
        </script>';
    }

    /* DOSYA YÖNETİMİ */
    private function createCacheFile($data) {
        $filename = $this->cacheFile();
        $this->file->create($filename);
        $this->file->set($filename, $data);
        return $data;
    }

    private function getCacheFile() {
        return $this->file->get($this->cacheFile());
    }

    private function cacheFile() {
        return __CACHE.md5($this->handle).'.html';
    }

    private function fileMT() {
        return $this->file->modifiedTime($this->cacheFile())+$this->expire;
    }
    private function isExpired() {
        return ($this->fileMT()<time()) ? 1 : 0;
    }

    /* DEBUG */
    public function debugCache() {
        if ($this->debug) {
            echo '<pre>';
            echo '<hr><h2>Önbellek Yapısı</h2>';
            echo '<time>Şuanki zaman: '.(date('d-m-Y H:i:s')).'</time>';
            echo '<br>';
            echo '<time>Önbellek sonlanma tarihi: '.(date('d-m-Y H:i:s', $this->fileMT())).'</time><br>';
            print_r( $this->folder->listFiles(__CACHE) );
            echo '</pre>';
        }
    }
}
