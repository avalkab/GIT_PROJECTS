<?php namespace ERA\Controllers;

class PostController extends \BaseController {
    private $model;

    protected $parameters = [];

    protected $allowed_have_pages = ['yazi', 'sayfa'];

    function __construct(Array $parameters = null) {
        $this->parameters = $parameters;
        $this->model = new \PostModel();
    }

    public function checkPostPage() {
        if ($this->isPostPage() === true) {
            if ($this->have() === false) {
                __404();
            }
        }
    }

    public function isPostPage() {
        return in_array(type(), $this->allowed_have_pages, true) ? true : false;
    }

    public function have() {
       return $this->model->isHave();
    }

    public function all($e = 10, $s = 0, $where = 1, $select = '*') {
        if (!is_array($where)) {
            $where = [1];
        }
        return $this->model->pullAll($e, $s, $where, $select);
    }

    public function row($select = '*') {
        return $this->model->pullRow($select);
    }

    public function id($sef) {
        return $this->model->sefToId($sef);
    }

    public function  metaAll($output_type = 'OBJECT') {
        $meta = sql()
        ->select('anahtar, veri')
        ->from('icerik_meta')
        ->where(['anahtar','LIKE','_era_%'])
        ->andWhere(['icerik_id', '=', id()])
        ->limit(0,10)
        ->outputType($output_type)
        ->all();
        return meta()->metaFixed($meta);
    }

     public function other() {
        $related_posts = [];

        $triple = sql()
        ->select('i.id, i.sef_url, i.tur')
        ->from('icerikler as i')
        ->where(['i.id','!=',id()])
        ->andWhereGroupOr([
            ['i.tur','=','yazi'],
            ['i.tur','=','sayfa']
        ])
        ->limit(0,3)
        ->all();

        if (sizeof($triple)>0) {
            foreach ($triple as $key => $value) {
                $related_posts[$key] = meta()->metaFixed(
                    sql()
                    ->select('im.anahtar, im.veri')
                    ->from('icerik_meta as im')
                    ->where(['im.icerik_id', '=', $value->id])
                    ->andWhereGroupOr([
                        ['im.anahtar','=','_era_poster'],
                        ['im.anahtar','=','_era_site_url']
                    ])
                    ->limit(0,2)
                    ->outputType('ARRAY_A')
                    ->all()
                );
                $related_posts[$key]['sef_url'] = $value->sef_url;
                $related_posts[$key]['tur'] = $value->tur;
            }
            return $related_posts;
        }
    }

}

