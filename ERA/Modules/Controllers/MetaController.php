<?php namespace ERA\Controllers;

class MetaController extends \BaseController{

    public static function pull() {
        return db()->get_row("SELECT title,keywords,description FROM meta WHERE kayit_id = $id AND tablo = '$table'");
    }

    public static function baseTags($id, $table) {
        $meta = self::pull($id, $table);
        html()->createElement('title', null, $meta->title, false);
        ->createElement('meta', ['name'=>'keywords', 'content' => $meta->keywords], null, false);
        ->createElement('meta', ['name'=>'description', 'content' => $meta->description], null, false);
        echo html()->getElements();
    }
}