<?php

namespace app\controllers;
use app\core\Controller;
use app\core\Page;
use app\models\Event;

/**
*
* Events
*
*/
class EventsControllers extends Controller
{
	public function index()
	{
		$eventModel = new Event();

		// echo $eventModel
		// 	->table('tb_contacts_2')
		// 	->select('*')
		// 	->where('name', 'GUI')
		// 	->get();

		Page::setTitle('Evento');
		Page::setView('events/index');
		Page::setMenu('events');
		parent::layout('shared/layout');
	}
}