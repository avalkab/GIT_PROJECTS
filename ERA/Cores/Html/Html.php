<?php namespace ERA\Core;

class Html extends \Singleton {

    public $element_list;
    public $guard;

    function __construct() {
        $this->guard = \FormGuard::getInstance();
    }

    public function createElement($tagname, Array $parameters = null, $content = null, $is_end = true) {
        $element_base = '<'.$tagname.' '.$this->getParameters($parameters).'>';
        $element = $element_base.$content;

        if (!isset($parameters['method'])) {
            $parameters['method'] = 'POST';
        }

        if ($is_end == true) {
            $this->closeElement($tagname);
        }

        $this->setHtmlElement($element);

        if ($tagname == 'form' && $parameters['csrf'] == true) {
            $token_name = '__INPT'.md5($element_base);
            $token_key = $this->guard->protect($parameters['method'], $token_name);
            $this->createElement('input', ['type' => 'hidden', 'name' => $token_name, 'value' => $token_key], null, false);
        }

        return $this;
    }

    public function closeElement($tagname) {
        $this->setHtmlElement('</'.$tagname.'>');
        return $this;
    }

    private function getParameters($parameters = null) {
        if ($parameters) {
            foreach ($parameters as $key => $value) {
                $param .= $key.'="'.$value.'" ';
            }
            return rtrim($param, ' ');
        }
    }

    private function setHtmlElement($element) {
        $this->element_list[] = $element;
    }

    public function getElements() {
        $elements = implode('',$this->element_list);
        unset($this->element_list);
        return $elements;
    }

    public function isValidToken() {
        return $this->guard->token_status;
    }

}