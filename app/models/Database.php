<?php 

namespace app\models;

abstract class Database extends Connect
{
    // Database
    private $instance = NULL;
	protected $table = '';
    protected $primaryKey = 'id';
    private $rows = 0;
    // Pagination
    private $current = 1;
    private $perPage = 10;
    private $pageLink = '';
    // Statement
    private $stmt = '';
    private $_select = '';
    private $_where = '';
    private $_order = '';
    //
    private $error = false;
	private $query;
    
    
    public function __construct()
    {
        //$this->instance = Connect::getInstance();
    }

    public static function all() {}

    public function table($name)
    {
        $this->table = $name;
        return $this;
    }

    public function where($field, $operator = '=', $clause='')
    {
        $this->_where = empty($this->_where) ? 'WHERE' : '';
        if (!in_array($operator, ['=', '!=', '>', '<', '<>', '>=', '<='])):
            $clause = $operator;
            $operator = '=';
        endif;
        $this->_where .= " $field $operator $clause";
        return $this;
    }

    public function whereAnd() {}
    public function whereOr() {}

    public function query($query = '')
    {}

    public function get()
    {
        // self::$db    = DB::getInstance();
		// self::$query = self::$db->prepare($sql);
        // self::$query->execute($exec);
        // self::$query->fetchAll();

        echo "SELECT {$this->_select} FROM {$this->table} {$this->_where}";
    }

    public function select($param, $data = array())
    {
        // $param = 'name, address' || '*'
        $this->_select = "{$param}";
		return $this;
    }

    public function save()
    {}

    public function delete($id)
    {}

    public function find() {}

    public function findById($id)
    {}

    public function rowsAffected()
    {}

    public function rowsCount()
    {}

    public function paginator()
    {
        return json_encode([
            'total' => count([]),
            'current' => $this->current,
            'items' => []
        ]);
    }

    public function paginatorLink()
    {}
}