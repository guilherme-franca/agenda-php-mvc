<?php

namespace app\interfaces;

interface ICrud {
	public static function save($table, $prep, $exec);
	public static function select($fields, $table, $prep, $exec);
	public static function update($table, $prep, $exec);
	public static function delete($table, $prep, $exec);
}