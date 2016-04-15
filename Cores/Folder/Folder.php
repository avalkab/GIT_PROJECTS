<?php namespace ERA\Core;

class Folder extends \Singleton {

    public function id() {
        return 1;
    }

    public function isFolder($folder) {
        return is_dir($folder) ? true : false;
    }

    public function create($folder) {
        if ($this->isFolder($folder) === false) {
            mkdir($folder, 0777, true);
        }
    }

    public function listFiles($dir) {
        $file_instance = \File::getInstance();
        $folder = opendir($dir);
        while (($file = readdir($folder)) !== false) {

            $dir_item = $dir.$file;

            if ($file != '.' && $file != '..') {

                if (is_dir($dir_item)) {
                    $dir_item = $dir_item.'/';
                    $files[$dir_item] = $this->listFiles($dir_item);
                }

                if (is_file($dir_item)) {
                    $files[$dir_item]['file'] = $dir_item;
                    $files[$dir_item]['size'] = $file_instance->getFileSize($dir_item);
                }

            }
        }
        closedir($folder);
        return $files;
    }
}