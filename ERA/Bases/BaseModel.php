<?php namespace ERA\Bases;

class BaseModel {

    const PATTERN_STR       = '/^[a-zA-Z]+$/';
    const PATTERN_STRS      = '/^[a-zA-Z\s]+$/';
    const PATTERN_INT       = '/^[0-9]+$/';
    const PATTERN_INTS      = '/^[0-9\s]+$/';
    const PATTERN_ALN       = '/^[a-zA-Z0-9]+$/';
    const PATTERN_ALNS      = '/^[a-zA-Z0-9\s]+$/';
    const PATTERN_MAIL      = '/^([a-zA-Z0-9-_.]+)@([a-zA-Z-.]+)$/';
    const PATTERN_USERNAME  = '/^[a-zA-Z0-9-_.]+$/';

    protected $request_method = 'POST';
    protected $table;
    protected $fillable;

    protected $request_data;
    protected $validate = 0;

    //'token' => ['type' => 'alns',  'min' => 32, 'max' => 32]

    function __construct() {
       $this->setRequestData();
    }

    function __get($key) {
        return $this->request_data[$key];
    }

    public function setRequestMethod($method) {
        $this->request_method = $method;
    }

    public function setTable($table) {
        $this->table = $table;
    }

    public function setFillable(Array $parameters = null) {
        $this->fillable = $parameters;
    }

    public function setRequestData() {
        $rm = strtoupper($this->request_method);
        $input = (array)request()->getRequest($rm);
        $fillable_keys = array_keys($this->fillable);
        if (sizeof($fillable_keys)>1) {
            foreach ($fillable_keys as $value) {
                $this->request_data[$value] = !empty($input[$value]) ? ($this->fillable[$value]['hash']) ? md5($input[$value]) : $input[$value] : '';
            }
        }
    }

    protected function validMethod() {
        return ($_SERVER['REQUEST_METHOD'] == $this->request_method) ? 1 : 0;
    }

    protected function validBetween($name, $min = 8, $max = 18) {
        $data_length = strlen($this->request_data[$name]);
        return ($data_length >= intval($min) && $data_length <= intval($max)) ? 1 : 0;
    }

    protected function validType($name, $type) {
        $value = $this->request_data[$name];
        switch ($type) {
            case 'str'       : $response = preg_match(self::PATTERN_STR, $value); break;
            case 'strs'      : $response = preg_match(self::PATTERN_STRS, $value); break;
            case 'int'       : $response = preg_match(self::PATTERN_INT, $value); break;
            case 'ints'      : $response = preg_match(self::PATTERN_INTS, $value); break;
            case 'aln'       : $response = preg_match(self::PATTERN_ALN, $value); break;
            case 'alns'      : $response = preg_match(self::PATTERN_ALNS, $value); break;
            case 'mail'      : $response = preg_match(self::PATTERN_MAIL, $value); break;
            case 'username'  : $response = preg_match(self::PATTERN_USERNAME, $value); break;
            default          : $response = null; break;
        }
        return (integer)$response;
    }

    public function validRequestData($return_validate = false) {
        if ($this->validMethod()) {
            foreach ($this->fillable as $key => $value) {
                if ($this->validType($key, $value['type']) && $this->validBetween($key, $value['min'], $value['max'])) {
                    $this->validate = 1;
                }else{
                    $this->validate = 0;
                    break;
                }
            }
        }else{
            $this->validate = 0;
        }

        if ($return_validate == true) {
            return $this->validate;
        }
    }

    public function isValidate() {
        return ($this->validate == 1) ? true : false;
    }
}