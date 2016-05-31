<?php namespace ERA\Models;

class PostModel extends \BaseModel {
    protected $id,
              $meta_id,
              $kullanici_id,
              $tur,
              $baslik,
              $veri,
              $ekleme_tarihi,
              $duzenleme_tarihi,
              $sef_url,
              $kullanici_adi,
              $yorum_sayisi,
              $sifre,
              $icerik_anahtari,
              $erisim_anahtari,
              $durum;

    protected $request_method = 'POST';
    protected $table = 'icerikler';

    protected $fillable = [
        'id'                => ['type' => 'int'],
        'meta_id'           => ['type' => 'int'],
        'kullanici_id'      => ['type' => 'int'],
        'tur'               => ['type' => 'str', 'min' => 5, 'max' => 25],
        'baslik'            => ['type' => 'str', 'min' => 5, 'max' => 150],
        'veri'              => ['type' => 'str'],
        'ekleme_tarihi'     => ['type' => 'str'],
        'duzenleme_tarihi'  => ['type' => 'str'],
        'sef_url'           => ['type' => 'str', 'min' => 5, 'max' => 255],
        'kullanici_adi'     => ['type' => 'str', 'min' => 5, 'max' => 50],
        'yorum_sayisi'      => ['type' => 'int'],
        'sifre'             => ['type' => 'str', 'min' => 8, 'max' => 50],
        'icerik_anahtari'   => ['type' => 'str', 'min' => 5, 'max' => 50],
        'erisim_anahtari'   => ['type' => 'str', 'min' => 5, 'max' => 50],
        'durum'             => ['type' => 'str', 'min' => 0, 'max' => 1]
    ];

    function __construct() {
        parent::__construct();
        $this->validRequestData();
    }

    public function pullAll($e = 10, $s = 0, $w = 1, $se = '*', $join = null) {
        return sql()
        ->select($se)
        ->from([$this->table])
        ->where($w)
        ->join($join['type'], $join['table'], $join['on'])
        ->limit($s,$e)
        ->all();
    }

    public function pullOne($where = 1, $select = '*') {
        return sql()
        ->select($select)
        ->from([$this->table])
        ->where($where)
        ->limit(0,1)
        ->row();
    }

    public function sefToId($sef) {
        return sql()
        ->select(['id'])
        ->from([$this->table])
        ->where(['sef_url','=',$sef])
        ->limit(0,1)
        ->one();
    }

    public function insert() {
    }

    public function update() {
    }

    public function delete() {
    }

}