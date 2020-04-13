<?php

namespace app\controllers;
use app\core\Controller;
use app\core\Page;

/**
* Home Controller
*/
class HomeControllers extends Controller
{
	public function index()
	{
		Page::setTitle('Pagina Incial');
		Page::setView('home/index');
		Page::setMenu('home');
		parent::layout('shared/layout');
	}

	public function test()
	{
		echo 'HomeControllers.php :: test';
		$crud = parent::model('Crud');
		print_r( $crud->select('nome', 'clientes', '', array()) );
	}

}