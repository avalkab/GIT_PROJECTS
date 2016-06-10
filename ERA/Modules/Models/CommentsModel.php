<?php namespace ERA\Models;

class CommentsModel extends \BaseModel {
    protected $icerik_id,
              $yorum_id,
              $kullanici_id,
              $durum,
              $yorum,
              $kullanici_adi,
              $kullanici_mail,
              $ekleme_tarihi,
              $agent,
              $referer,
              $ip;

    protected $request_method = 'POST';
    public $table = 'yorumlar';

    protected $fillable = [
        'yorum'         => ['type' => 'str', 'min' => 5, 'max' => 500],
        'kullanici_adi' => ['type' => 'str', 'min' => 5, 'max' => 50],
        'icerik_id'     => ['type' => 'int'],
        'yorum_id'      => ['type' => 'int']
    ];

    function __construct() {
        parent::__construct();

        $this->validRequestData();

        $this->ekleme_tarihi = __CURRENT__;
        $this->durum = 1;
        $this->kullanici_adi = !empty($this->kullanici_adi) ? $this->kullanici_adi : 'Misafir';
    }

    public function insert() {
        return sql()
        ->insert($this->table)
        ->set([
             ['icerik_id', $this->icerik_id],
             ['yorum_id', $this->yorum_id],
             ['kullanici_id', $this->kullanici_id],
             ['durum', $this->durum],
             ['yorum', $this->yorum],
             ['kullanici_adi', $this->kullanici_adi],
             ['kullanici_mail', $this->kullanici_mail],
             ['ekleme_tarihi', $this->ekleme_tarihi],
             ['referer', $this->referer],
             ['agent', $this->agent],
             ['ip', $this->ip]
        ])
        ->query() ? 1 : 0;
    }


}