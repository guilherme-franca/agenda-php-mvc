<?php

namespace app\models;

use app\interfaces\ICrud;
use app\models\ConnDB;

class Crud extends ConnDB implements ICrud {

	private static $query;

	private static function prepExec($sql, $exec) {
		self::$query = ConnDB::getConn()->prepare($sql);
		self::$query->execute($exec);
	}

	public static function save($table, $prep, $exec) {
		$sql = trim("INSERT INTO $table $prep");
		self::prepExec($sql, $exec);
		return ConnDB::getConn()->lastInsertId();
	}

	public static function select($fields, $table, $prep, $exec) {
		$sql = trim("SELECT $fields FROM $table $prep");
		self::prepExec($sql, $exec);
		return self::$query->fetchAll();
	}

	public static function update($table, $prep, $exec) {
		$sql = trim("UPDATE $table SET $prep");
		self::prepExec($sql, $exec);
		return self::$query->rowCount();
	}

	public static function delete($table, $prep, $exec) {
		$sql = trim("DELETE FROM $table $prep");
		self::prepExec($sql, $exec);
		return self::$query->rowCount();
	}
}
