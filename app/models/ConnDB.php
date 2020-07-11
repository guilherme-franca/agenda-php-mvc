<?php

namespace app\models;

use \PDO;

abstract class ConnDB
{

	private static $conn = '';

	/**
	 *  set a connection with to Database
	 */
	private static function setConnection()
	{
		$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
		self::$conn = new PDO("mysql:host=localhost;dbname=db_schedule_php", "guilherme", "&!Lc7K$5q#", $options);
		self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	}

	/**
	 * Return the instance with to Database
	 * @return $conn
	 */
	public static function getInstance()
	{
		self::setConnection();
		return self::$conn;
	}

}
