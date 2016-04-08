<?php namespace ERA\Core;

class Auth extends \BaseModel implements \IAuth {

    protected $is_login = 0;
    protected $last_login_date;
    protected $member;

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
        echo 'Logged';
    }

    public function isLogin() {
        return ($this->is_login) ? true : false;
    }

    public function lastLoginDate() {
        return $last_login_date;
    }

    public function getMember() {
        return $this->isLogin() ? $this->member : false;
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
        } else if (is_string()) {
           $w = $where_cols;
        }

        $this->login_sql = sprintf($this->login_sql, $c, $this->table, $w);
    }

}