<?php

namespace app\models;

use app\interfaces\ICrud;
use app\models\ConnDB as DB;

class Crud extends ConnDB implements ICrud
{

	static private $db;
	static private $query;
	static protected $table = '';
	static protected $primaryKey = '';

	private static function prepExec($sql, $exec)
	{
		self::$db    = DB::getConn();
		self::$query = self::$db->prepare($sql);
		self::$query->execute($exec);
	}

	public static function select($fields = '*', $prep = '', $exec = array())
	{
		$table = static::$table;
		$sql   = trim("SELECT $fields FROM $table $prep");

		self::prepExec($sql, $exec);
		return self::$query->fetchAll();
	}

	public static function findByID($key)
	{
		$table = static::$table;
		$primaryKey = static::$primaryKey;
		$fields     = '*';
		$prep       = "WHERE $primaryKey = ?";
		$exec       = [$key];
		$sql        = trim("SELECT $fields FROM $table $prep");

		self::prepExec($sql, $exec);
		return self::$query->fetch();
	}

	/**
	 * 
	 * @return Array
	 */
	private static function buildStatment($data, $save = false)
	{
		$prep      = '';
		$prep2     = '';
		$exec      = [];
		$keys      = array_keys($data);
		$last_key  = end($keys);

		if ($save):
			foreach($data as $key => $item):
				if ($key == $last_key):
					$prep  .= "$key";
					$prep2 .= "?";
				else:
					$prep  .= "$key, ";
					$prep2 .= "?, ";
				endif;
				$exec[] = "$item";
			endforeach;
	
			$prep = trim("($prep) VALUES ($prep2)");
		else:
			foreach($data as $key => $item):
				if ($key == $last_key):
					$prep  .= "$key = ?";
				else:
					$prep  .= "$key = ?, ";
				endif;
				$exec[] = "$item";
			endforeach;
		endif;

		return ['prep' => $prep, 'exec' => $exec];
	}

	public static function save($prep = '', $exec = [])
	{
		$table      = static::$table;
		$primaryKey = static::$primaryKey;
		$stmt       = self::buildStatment($exec, true);
		$prep       = $stmt['prep'];
		$exec       = $stmt['exec'];

		// $prep2      = '';
		// $exec2      = [];
		// $keys       = array_keys($exec);
		// $last_key   = end($keys);

		// foreach($exec as $key => $item):
		// 	if ($key == $last_key):
		// 		$prep  .= "$key";
		// 		$prep2 .= "?";
		// 	else:
		// 		$prep  .= "$key, ";
		// 		$prep2 .= "?, ";
		// 	endif;
		// 	$exec2[] = "$item";
		// endforeach;

		// $prep = trim("($prep) VALUES ($prep2)");
		$sql  = "INSERT INTO $table $prep";
		
		self::prepExec($sql, $exec);
		return self::$db->lastInsertId( $primaryKey );

	}

	public static function update($prep = '', $exec, $code = 0)
	{
		$table      = static::$table;
		$primaryKey = static::$primaryKey;
		
		$stmt   = self::buildStatment($exec);
		$prep   = $stmt['prep'];
		$exec   = $stmt['exec'];
		$exec[] = $code;
		
		$sql    = trim("UPDATE $table SET $prep WHERE $primaryKey = ?");
		
		self::prepExec($sql, $exec);
		return self::$query->rowCount();
	}

	/**
	 * Delete
	 * 
	 * @var String $prep String for statement | Example: WHERE id = ?
	 * @var Array $exec Array for get data | Example: array('id' => 1)
	 */
	public static function delete($prep, $exec)
	{
		$table      = static::$table;
		$primaryKey = static::$primaryKey;
		$sql        = trim("DELETE FROM $table WHERE $primaryKey = ?");
		
		self::prepExec($sql, $exec);
		return self::$query->rowCount();
	}
}
