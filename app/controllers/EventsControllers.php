<?php

namespace app\controllers;
use app\core\Controller;
use app\core\Page;

/**
*
* Events
*
*/
class EventsControllers extends Controller
{
	public function index()
	{
		Page::setTitle('Evento');
		Page::setView('events/index');
		Page::setMenu('events');
		parent::layout('shared/layout');
	}
}