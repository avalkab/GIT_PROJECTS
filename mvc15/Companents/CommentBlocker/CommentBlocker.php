<?php namespace ERA\Companents;
class CommentBlocker extends \ACompanentAdapter implements \ICompanent {
    public $version = '5.2.0';

    public function getCss() {
        return '<style type="text/css">
        .comments{
            width:300px;
            padding:0;
            margin:0;
        }
        .comments li{
            background-color:#ccc;
            list-style:none;
            padding:10px;
            margin-bottom:5px;
        }
        .comments li p{
            padding:0;
            margin:0;
        }
        </style>';
    }

    public function getComments() {
        foreach ($this->gvar('comments') as $key => $value) {
            $comments .= $value.'<br>';
        }
        return $comments;
    }

    public function endProccess() {
        return '<p>Yorumlar temizlendi</p>';
    }
}
