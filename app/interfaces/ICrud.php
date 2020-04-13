<?php

namespace app\interfaces;

interface ICrud
{
	public static function save($prep, $exec);
	public static function select($fields, $prep, $exec);
	public static function update($prep, $exec);
	public static function delete($prep, $exec);
}