<?php namespace ERA\Core;

class Auth extends \BaseModel implements \IAuth {

    protected $login_sql = 'SELECT %s FROM %s WHERE %s LIMIT 1';

    function __construct($type, $table, Array $fillable = null) {
        $this->prepare($type, $table, $fillable = null);
    }

    public function prepare($type, $table, Array $fillable = null) {
        if (!empty($type) && !empty($table) && sizeof($fillable)>1) {
            $this->setRequestMethod($type);
            $this->setTable($table);
            $this->setFillable($fillable);
            parent::__construct();
        }
    }

    public function login() {
        if (!$_SESSION['is_login']) {
            $logged = db()->query($this->login_sql);
            if ($logged) {
                $_SESSION['is_login'] = 1;
                $this->setMember();
                $_SESSION['login_date'] = date('d-m-Y H:i:s');
            }
            return $logged;
        }else{
            return true;
        }
    }

    public function isLogin() {
        return ($_SESSION['is_login']) ? true : false;
    }

    public function setMember() {
        $_SESSION['member'] = db()->get_row($this->login_sql);
    }

    public function getMember() {
        return $this->isLogin() ? (object)$_SESSION['member'] : false;
    }

    public function setLoginSql($sql_str) {
        $this->login_sql = $sql_str;
    }

    public function buildLoginSql(Array $cols = null, $where_cols = null) {
        $c = implode(',', $cols);

        if (is_array($where_cols)) {
            foreach ($where_cols as $key => $value) {
                $w[$key] = $key.'=\''.$this->{$value}.'\'';
            }
            $w = implode(' AND ', $w);
        } else if (is_string($where_cols)) {
           $w = $where_cols;
        }

        $this->login_sql = sprintf($this->login_sql, $c, $this->table, $w);
    }

}