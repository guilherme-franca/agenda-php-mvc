<?php

use app\controllers\ContactsControllers;
use app\controllers\AppControllers;

function list_all() 
{
	$cc = new ContactsControllers();
	$cc->showall();
	$appC = new AppControllers();
}
