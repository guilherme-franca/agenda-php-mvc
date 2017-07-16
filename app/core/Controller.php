<?php

namespace app\core;

/**
* Controller
*/
class Controller
{
	public function model( $model )
	{
		$m = '\app\models\\'.$model;
		return new $m();
	}

	public function layout($layout)
	{
		require_once 'app/views/'.$layout.'.php';
	}
}