<?php namespace ERA\Core;

class Html extends \Singleton {

    public function createElement($tagname, $parameters = null, $content = null, $is_end = true) {
        $element = '<'.$tagname.' '.$this->getParameters($parameters).'>'.$content;
        if ($is_end == true) {
            $element .= $this->closeElement($tagname);
        }
        return $element;
    }

    public function closeElement($tagname) {
        return '</'.$tagname.'>';
    }

    public function getParameters($parameters = null) {
        if (is_null($parameters)) {
            $parameters = ['id' => 'ERA_INPT_'.time()];
        }
        foreach ($parameters as $key => $value) {
            $param .= $key.'="'.$value.'" ';
        }
        return rtrim($param, ' ');
    }

}

class Input extends Request {

    private $html;

    function __construct() {
        $this->html = Html::getInstance();
    }

    public function create($tagname, Array $parameters = null, $content, $is_end = true) {
        return $this->html->createElement($tagname, $parameters, $content, $is_end);
    }

}