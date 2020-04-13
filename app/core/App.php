<?php

namespace app\core;

/**
* App
*/
class App
{
	protected $controller = 'HomeControllers';
	protected $method     = 'index';
	protected $params     = [];
	
	public function __construct()
	{
		$url = $this->parseUrl();
		
		if (isset($url[0]) && file_exists('app/controllers/'. ucfirst($url[0]) .'Controllers.php')):
			$this->controller = ucfirst($url[0]) . 'Controllers';
			unset($url[0]);
		endif;

		$c = '\app\controllers\\'.$this->controller;
		$this->controller = new $c();

		if (isset($url[1])):
			if (method_exists($this->controller, $url[1])):
				$this->method = $url[1];
				unset($url[1]);
			endif;
		endif;

		$this->params = $url ? array_values($url) : [];

		call_user_func([$this->controller, $this->method], $this->params);
	}

	public function parseUrl()
	{
		if (isset($_GET['url']))
			return $url = explode('/', filter_var(rtrim( $_GET['url'], '/' ), FILTER_SANITIZE_URL));
	}
}