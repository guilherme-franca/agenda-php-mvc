<?php 

namespace app\models;
use \PDO;

abstract class Connect
{
    static private $instance = NULL;
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

    public static function getInstance()
    {
        if (self::$instance == NULL):
            $config          = config('database');
            $driverDefault   = $config['driverDefault'];
            
            self::$driver    = $config[$driverDefault]['driver'];
            self::$host      = $config[$driverDefault]['host'];
            self::$port      = $config[$driverDefault]['port'];
            self::$dbname    = $config[$driverDefault]['database'];
            self::$username  = $config[$driverDefault]['username'];
            self::$password  = $config[$driverDefault]['password'];
            self::$charset   = $config[$driverDefault]['charset'];
            self::$collation = $config[$driverDefault]['collation'];
            self::$prefix    = $config[$driverDefault]['prefix'];
            self::$options   = $config[$driverDefault]['options'];

            try {
				$dns = self::$driver . ':host=' . self::$host . ';dbname=' . self::$dbname;
                self::$instance = new PDO($dns, self::$username, self::$password, self::$options);
                return self::$instance;
            } catch(PDOException $exception) {
                self::fail( $exception );
            }
        endif;
    }

    public function fail($error)
    {
        echo 'ERROR >> ' . $error->getMessage();
        return null;
    }
}