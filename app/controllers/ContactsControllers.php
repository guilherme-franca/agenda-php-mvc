<?php

namespace app\controllers;

use app\models\Crud;
use app\core\Controller;
use app\core\Page;

/**
* Contacts Controller
*/
 class ContactsControllers extends Controller
{
	function index()
	{
		Page::setTitle('Contato');
		Page::setView('contacts/index');
		Page::setMenu('contacts');
		parent::layout('shared/layout');
	}

	function showAll()
	{
		$c   = new Crud();
		$rs  = $c->select('num_matricula, nome', 'clientes', '', array());
		$tpl = file_get_contents(APP_PATH.DS.'app/views/tampletes/contacts.tpl.html');
		
		$obj = new \ArrayObject($rs);
		$it  = $obj->getIterator();

		$data = array();
		$data['tpl'] = '';

		$search  = array('#nome#', '#codigo#');

		foreach ($it as $key => $val)
		{
			$replace = array($val->nome, $val->num_matricula);
			$data['tpl'] .= str_replace($search, $replace, $tpl);
			
		}


		Page::setTitle('Lista de Contatos');
		Page::setView('contacts/showAll');
		Page::setMenu('contacts');
		Page::setData($data);
		parent::layout('shared/layout');
	}
}