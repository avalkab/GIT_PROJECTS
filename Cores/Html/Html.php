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

    private function getParameters($parameters = null) {
        if (is_null($parameters)) {
            $parameters = ['id' => '__INPT__'.md5(microtime())];
        }
        foreach ($parameters as $key => $value) {
            $param .= $key.'="'.$value.'" ';
        }
        return rtrim($param, ' ');
    }

}