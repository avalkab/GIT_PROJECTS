<?php namespace ERA\Core;

class SqlBuilder {
    /* DEFAULT VARS */
    private $sql = [
        'INSERT'    => [],
        'UPDATE'    => [],
        'DELETE'    => [],
        'SELECT'    => [],
        'SET'       => [],
        'FROM'      => [],
        'JOIN'      => [],
        'WHERE'     => [],
        'HAVING'    => [],
        'GROUP'     => [],
        'ORDER'     => [],
        'LIMIT'     => []
    ];

    private $output_type = 'OBJECT';

    public function outputType($type) {
        $this->output_type = $type;
        return $this;
    }

    /* INSERT */
    public function insert($table = null) {
        $this->sql['INSERT'] = $table;
        return $this;
    }

    /* UPDATE */
    public function update($table = null) {
        $this->sql['UPDATE'] = $table;
        return $this;
    }

    /* DELETE */
    public function delete() {
        $this->sql['DELETE'] = $table;
        return $this;
    }

    /* SELECT */
    public function select($columns = null) {
        if (!is_array($columns)) {
            $columns = [$columns];
        }
        $this->sql['SELECT'] = $columns;
        return $this;
    }

    public function set(Array $case = null) {
        $this->sql['SET'] = $case;
        return $this;
    }

    /* FROM */
    public function from($columns = null) {
        if (!is_array($columns)) {
            $columns = [$columns];
        }
        $this->sql['FROM'] = $columns;
        return $this;
    }

    /* JOIN */
    public function join($type, $table, Array $on = null) {
        if (!empty($type) && !empty($table) && sizeof($on)>0) {
            $this->sql['JOIN'][] = [
                'type'  => strtoupper($type),
                'table' => $table,
                'on'    => $on
            ];
        }
        return $this;
    }

    /* ORDER BY */
    public function order(Array $cols = null, $sort = 'DESC') {
        $this->sql['ORDER'] = ['cols' => $cols, 'sort' => $sort];
        return $this;
    }

    /* WHERE */
    public function whereGroup(Array $case = null) {
        $this->whereGroupImplode('', $case);
        return $this;
    }

    public function whereGroupAnd(Array $case = null) {
        $this->whereGroupImplode('AND', $case);
        return $this;
    }

    public function whereGroupOr(Array $case = null) {
        $this->whereGroupImplode('OR', $case);
        return $this;
    }

    public function orWhereGroupOr(Array $case = null) {
        $this->whereGroupImplode('OR', $case,  ['direction' => 'left', 'glue' => 'OR']);
        return $this;
    }

    public function andWhereGroupOr(Array $case = null) {
        $this->whereGroupImplode('OR', $case, ['direction' => 'left', 'glue' => 'AND']);
        return $this;
    }

    public function orWhereGroupAnd(Array $case = null) {
        $this->whereGroupImplode('AND', $case,  ['direction' => 'left', 'glue' => 'OR']);
        return $this;
    }

    public function andWhereGroupAnd(Array $case = null) {
        $this->whereGroupImplode('AND', $case, ['direction' => 'left', 'glue' => 'AND']);
        return $this;
    }

    public function whereOr(Array $case = null) {
        $this->sql['WHERE'][] = $this->mergeWith($this->caseImplode($case), ['direction' => 'right', 'glue' => 'OR']);
        return $this;
    }

     public function orWhere(Array $case = null) {
        $this->sql['WHERE'][] = $this->mergeWith($this->caseImplode($case), ['direction' => 'left', 'glue' => 'OR']);
        return $this;
    }

    public function whereAnd(Array $case = null) {
        $this->sql['WHERE'][] = $this->mergeWith($this->caseImplode($case), ['direction' => 'right', 'glue' => 'AND']);
        return $this;
    }

    public function andWhere(Array $case = null) {
        $this->sql['WHERE'][] = $this->mergeWith($this->caseImplode($case), ['direction' => 'left', 'glue' => 'AND']);
        return $this;
    }

    public function where(Array $case = null) {
        $this->sql['WHERE'][] = $this->caseImplode($case);
        return $this;
    }

    public function whereGroupImplode($glue = 'AND', Array $case = null, Array $outerGlue = null) {
        foreach ($case as $key => $value) {
            $where[] = $this->caseImplode($value);
        }
        $sql = '('.implode(' '.$glue.' ', $where).')';
        $this->sql['WHERE'][] = $this->mergeWith($sql, $outerGlue);
    }

    public function caseImplode(Array $case = null) {
        if (sizeof($case)>1) {
            if (isset($case[3]) && $case[3] === true) {
                unset($case[3]);
                $case_model = implode(' ', $case);
            }else{
                $case_model = $case[0].' '.$case[1].' \''.$case[2].'\'';
            }
        }else{
            $case_model = 1;
        }
        return $case_model;
    }

    public function caseImplodeTwice(Array $case = null) {
        if (isset($case[2]) && $case[2] === true) {
            unset($case[2]);
            $case_model = implode(' ', $case);
        }else{
            $case_model = $case[0].' = \''.$case[1].'\'';
        }
        return $case_model;
    }

    public function mergeWith($sql, Array $outerGlue = null) {
        if ($outerGlue['direction'] && $outerGlue['glue']) {
            switch ($outerGlue['direction']) {
                case 'left': $sql = ' '.$outerGlue['glue'].' '.$sql; break;
                case 'right': $sql = $sql.' '.$outerGlue['glue'].' '; break;
            }
        }
        return $sql;
    }

    /* HAVING */
    public function having(Array $case = null) {
    }

    /* GROUP BY */
    public function group(Array $cols = null) {
        $this->sql['GROUP'] = $cols;
        return $this;
    }

    /* LIMIT */
    public function limit($start = 0, $end = 0) {
        $this->sql['LIMIT'] = intval($start).','.intval($end);
        return $this;
    }

    /* PREPARING */
    public function prepare($key) {
        if (array_key_exists($key, $this->sql)) {
            switch ($key) {
                case 'INSERT': $part = $this->prepareInsert(); break;
                case 'UPDATE': $part = $this->prepareUpdate(); break;
                case 'DELETE': $part = $this->prepareDelete(); break;
                case 'SELECT': $part = $this->prepareSelect(); break;
                case 'SET': $part = $this->prepareSet(); break;
                case 'FROM': $part = $this->prepareFrom(); break;
                case 'JOIN': $part = $this->prepareJoin(); break;
                case 'ORDER': $part = $this->prepareOrder(); break;
                case 'WHERE': $part = $this->prepareWhere(); break;
                case 'HAVING': $part = $this->prepareHaving(); break;
                case 'GROUP': $part = $this->prepareGroup(); break;
                case 'LIMIT': $part = $this->prepareLimit(); break;
            }
        }
        return trim($part);
    }

    public function prepareInsert() {
        return 'INSERT INTO '.$this->sql['INSERT'];
    }

    public function prepareUpdate() {
        return 'UPDATE '.$this->sql['UPDATE'];
    }

    public function prepareDelete() {
        return 'DELETE FROM '.$this->sql['DELETE'];
    }

    public function prepareSet() {
        foreach ($this->sql['SET'] as $key => $value) {
            $sets[] = $this->caseImplodeTwice($value);
        }
        return ' SET '.implode(',', $sets);
    }

    public function prepareSelect() {
        return 'SELECT '.implode(',', $this->sql['SELECT']);
    }

    public function prepareFrom() {
        return ' FROM '.implode(',', $this->sql['FROM']);
    }

    public function prepareJoin() {
        foreach ($this->sql['JOIN'] as $key => $value) {
            if (!$value['on'][3]) {
                $value['on'][3] = true;
            }
            $join[] = strtoupper($value['type']).' JOIN '.$value['table'].' ON '.$this->caseImplode($value['on']);
        }
        return implode(' ', $join);
    }

    public function prepareOrder() {
        return 'ORDER BY '.implode(',', $this->sql['ORDER']['cols']).' '.$this->sql['ORDER']['sort'];
    }

    public function prepareWhere() {
        return ' WHERE '.implode('', $this->sql['WHERE']);
    }

    public function prepareHaving() {
        return ' HAVING '.implode('', $this->sql['HAVING']);
    }

    public function prepareGroup() {
        return ' GROUP BY '.implode(',', $this->sql['GROUP']);
    }

    public function prepareLimit() {
        return ' LIMIT '.$this->sql['LIMIT'];
    }

    /* CREATE */
    public function create() {
        foreach ($this->sql as $key => $value) {
            if (sizeof($value)>0) {
                $sql[$key] = $this->prepare($key);
            }
        }
        $sql = implode(' ', $sql);
        return $sql;
    }

    /* PULL */
    public function all() {
        return db()->get_results($this->create(), $this->output_type);
    }

    public function row() {
        return db()->get_row($this->create(), $this->output_type);
    }

    public function one() {
        return db()->get_var($this->create());
    }

    public function query() {
        return db()->query($this->create());
    }
}

/*
function sqlBuilder() {
    return new SqlBuiler();
}

$query_string = sqlBuilder()->from(['users'])
->select(['user_id', 'first_name'])
->join('inner', 'users_detail', ['users.user_id','=','users_detail.id', true])
->join('inner', 'images', ['images.record_id','=','users_detail.id', true])
->order(['id','tarih'], 'DESC')
->where(['date', '<=', '28.05.2016'])
->orWhereGroupOr([
    ['durum', '=', '1'],
    ['date', '=', 'CURRENT_DATE()', true]
])
->orWhere(['name', 'LIKE', '%erhan%'])
->group(['username'])
->limit(0,10)
->create();


echo $query_string;
*/