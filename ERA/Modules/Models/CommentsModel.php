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
              $ip;

    protected $request_method = 'GET';
    protected $table = 'yorumlar';

    protected $fillable = [
        'yorum'         => ['type' => 'str', 'min' => 5, 'max' => 500],
        'kullanici_adi' => ['type' => 'str', 'min' => 5, 'max' => 50],
        'icerik_id'     => ['type' => 'int'],
        'yorum_id'      => ['type' => 'int']
    ];

    function __construct() {
        parent::__construct();
        $this->validRequestData();
    }

    public function pull($limit = null, $order = null, $where = null, $select = null) {
        $this->createQuery('SELECT', [
            $select.' (SELECT concat(tur,"/",sef_url) as sef FROM icerikler WHERE id = icerik_id) as sef,id,yorum_id,kullanici_id,durum,yorum,kullanici_adi,ekleme_tarihi',
            $this->table." $where $order $limit"
        ]);
        return db()->get_results($this->query_string);
    }

    protected function add() {
        $this->createQuery('INSERT', [
            $this->table,
            "icerik_id = '".$this->icerik_id."'
             yorum_id = '".$this->yorum_id."',
             kullanici_id = '".$this->kullanici_id."',
             durum = '1',
             yorum = '".$this->yorum."',
             kullanici_adi = '".$this->kullanici_adi."',
             kullanici_mail = '".$this->kullanici_mail."',
             ekleme_tarihi = '".$this->ekleme_tarihi."',
             agent = '".$this->agent."',
             ip = '".$this->ip."'"
        ]);
        echo $this->query_string;
    }


}