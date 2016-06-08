<?php namespace ERA\Controllers;

class CommentsController extends \BaseController{
    protected $model;

    function __construct() {
        $this->model = new \CommentsModel();
    }

    public static function getInstance() {
        return new self;
    }

    public function side() {
        return sql()
        ->select('c.kullanici_adi, c.yorum, i.sef_url, i.tur as icerik_tur')
        ->from($this->model->table.' as c')
        ->join('inner','icerikler as i',['i.id','=','c.icerik_id'])
        ->where(['c.durum','=','1'])
        ->order(['c.ekleme_tarihi'], 'DESC')
        ->limit(0,10)
        ->all();
    }

    public function post() {
        return sql()
        ->select('c.id, c.kullanici_adi, c.yorum, c.ekleme_tarihi, c.yorum_id')
        ->from($this->model->table.' as c')
        ->where(['c.durum','=','1'])
        ->andWhere(['c.icerik_id','=',id()])
        ->order(['c.ekleme_tarihi'], 'ASC')
        ->limit(0,100)
        ->outputType('ARRAY_A')
        ->all();
    }

}