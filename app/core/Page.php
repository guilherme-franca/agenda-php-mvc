<?php

namespace app\core;

class Page
{
	public static $title;
	public static $menu;//Menu Selected
	public static $view;
	public static $data;

	public static function setTitle($title)
	{
		self::$title = $title;
	}

	public static function setMenu($menu)
	{
		self::$menu = $menu;
	}

	public static function setData($data)
	{
		self::$data = $data;
	}

	public static function setView($view)
	{
		self::$view = $view;
	}
	
	public static function view()
	{
		$data = self::$data;
		require_once 'app/views/'. self::$view .'.php';
	}
}