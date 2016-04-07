<?php namespace ERA\Core;

class View {
    const PATTERN_VAR = '/\{([a-z_\.]+)\}/';
    const PATTERN_INC = '/\@inc:(.*)\@/';
    const PATTERN_MARK = '/\@mark:(.*)\@/';

    /* private $templates_path; */
    private $views_path;
    /* private $is_template = false; */

    private $content;
    private $last_content;

    private $vars = array();
    private $rendered_collection = array();

    function __construct() {
        $this->views_path = 'modules/views/';
        /* $this->templates_path = $this->views_path.'templates/'; */
        $this->setVars([
            'project_name' => app()->project_name,
            'project_version' => app()->project_version
        ]);
    }

    public function setVars(Array $vars = null) {
        $this->vars['values'] = array_merge($this->vars, $vars);
        return $this;
    }

    public function setVar($name, $value) {
        $this->vars['values'][$name] = $value;
        return $this;
    }

    public function getVar($name) {
        return $this->vars['values'][$name];
    }

    private function replaceVars() {
        if ($this->vars['values']) {
            foreach ($this->vars['values'] as $key => $value) {
                if (array_key_exists($key, $this->vars['collection'])) {
                    $vars_keys[] = $this->vars['collection'][$key];
                    $vars_vals[] = $value;
                }
            }
            $this->content = str_replace($vars_keys, $vars_vals, $this->content);
        }
    }

    private function findVars() {
        preg_match_all(self::PATTERN_VAR, $this->content, $vars); //PREG_SET_ORDER
        if (sizeof($vars)>0) {
            $this->vars['collection'] = array_combine($vars[1], $vars[0]);
            $this->replaceVars();
        }
    }

    private function findInc() {
        preg_match_all(self::PATTERN_INC, $this->last_content, $inc); //PREG_SET_ORDER
        if (sizeof($inc[0])>0) {
            foreach ($inc[1] as $key => $value) {
                $this->render($this->views_path.$value);
            }
        }
    }

    private function findMark() {
        preg_match_all(self::PATTERN_MARK, $this->last_content, $marks); //PREG_SET_ORDER
        if (sizeof($marks[0])>0) {
            foreach ($marks[1] as $key => $value) {
                $this->last_content = str_replace($marks[0][$key], Hook::mark($value), $this->last_content);
            }
        }
    }

    public function setRender($filename = null) {
        $pure_filename = str_replace($this->views_path, '', $filename);
        $this->rendered_collection[] = $pure_filename;
        if (empty($this->content)) {
            $this->content = $this->last_content;
        }else{
            $this->content = str_replace('@inc:'.$pure_filename.'@', $this->last_content, $this->content);
        }
    }

    public function render($filename = null) {
        if (file_exists($filename)) {
            ob_start('ob_gzhandler');
            header("Content-Type:text/html; charset=utf8");
            if ($this->vars['values']) {
                extract($this->vars['values']);
            }
            require_once($filename);
            $this->last_content = ob_get_clean();
            $this->findMark();
            $this->setRender($filename);
            $this->findInc();
        }
    }

    /*
    public function tpl($filename = null) {
        $this->is_template = true;
        $this->templates_path = $this->templates_path.$filename.'.tpl';
        return $this->run();
    }

    public function run() {
        if ($this->is_template) {
            $this->render($this->templates_path);
            $this->findVars();
            return $this->printContent();
        }
    }
    */

    public function make($filename = null) {
        $this->render($this->views_path.$filename.'.tpl');
        $this->findVars();
        return $this->printContent();
    }

    public function page($filename) {
        return $this->make('pages/'.$filename);
    }

    public function tpl($filename) {
        return $this->make('templates/'.$filename);
    }

    public function error($filename) {
        return $this->make('errors/'.$filename);
    }

    public function mail($page) {
        return $this->make('mails/'.$page);
    }

    public function master($page) {
        return $this->make('masters/'.$page);
    }

    public function main($page, $master) {
        $this->setVar('page', $page);
        return $this->make('masters/'.$master);
    }

    public function printContent() {
        return $this->content;
    }
}