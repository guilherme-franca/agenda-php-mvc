<?php 

namespace app\models;

class Database
{
    static private $conn = NULL;
    private $rows = 0;
    // Pagination
    private $current = 1;
    private $perPage = 10;
    private $pageLink = '';
    // Database
	static protected $table = '';
    static protected $primaryKey = '';
    static private $error = false;
	static private $query;
    static private $driver = '';
    static private $host = '';
    static private $port = '';
    static private $dbname = '';
    static private $username = '';
    static private $password = '';
    static private $charset = '';
    static private $collation = '';
    static private $prefix = '';
    static private $options = '';
    
    public function __construct()
    {
        self::$connection();
    }

    private static function connection()
    {
        if (self::conn == NULL):
            // $options         = [];
            $config          = config('database');
            self::$driver    = config['mysql'][0]['driver'];
            self::$host      = config['mysql'][0]['host'];
            self::$port      = config['mysql'][0]['port'];
            self::$dbname    = config['mysql'][0]['database'];
            self::$username  = config['mysql'][0]['username'];
            self::$password  = config['mysql'][0]['password'];
            self::$charset   = config['mysql'][0]['charset'];
            self::$collation = config['mysql'][0]['collation'];
            self::$prefix    = config['mysql'][0]['prefix'];
            self::$options   = config['mysql'][0]['options'];
            // foreach(self::$options as $key => $value):
            // endforeach;
			// PDO("{mysql}:host=localhost;dbname=db_schedule_php", "root", "&!Lc7K$5q#", $options);
			//self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            try {
				$dns = self::$driver . ':host=' . self::$host . ';dbname=' . self::$dbname;
                self::$conn = new PDO($dns, self::$username, self::$password, self::$options);
                return self;
            } catch(PDOException $e) {
                die('Database Connection failed: ' . $e->getMessage());
            }
        endif;
    }

    public static function table($name)
    {
        self::$table = $name;
        return self;
    }

    public function where($field, $oprator = '=', $clause='')
    {}

    public function query($query = '')
    {}

    public function get()
    {}

    public function select($param, $data = array())
    {
        // $param = 'name, address' || '*'
		return self;
    }

    public function save()
    {}

    public function delete($id)
    {}

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