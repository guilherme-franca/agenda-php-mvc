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

	public function segment($index)
	{
		$url = [];
		if ( isset( $_GET['url'] ) )
			$url = explode( '/', filter_var( rtrim( $_GET['url'], '/' ), FILTER_SANITIZE_URL ) );
		return ( count ( $url ) > 0 && array_key_exists ( $index, $url ) ) ? $url[$index] : 0;
	}
}