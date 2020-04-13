<?php

namespace app\controllers;

use app\models\Contact;
use app\core\Controller;
use app\core\Page;

/**
* Contacts Controller
*/
class ContactsControllers extends Controller 
{

	public function index()
	{
		$data = [];
		$data['tpl_contacts'] = $this->list_all();

		Page::setData($data);
		Page::setTitle('Contato');
		Page::setMenu('contacts');
		Page::setView('contacts/index');
		parent::layout('shared/layout');
		
	}

	private function list_all()
	{
		$contacts = Contact::select();

		$tpl = file_get_contents(APP_PATH.DS.'app/views/tampletes/contacts.tpl.html');
		
		$obj = new \ArrayObject($contacts);
		$it  = $obj->getIterator();

		$_tpl = '';
		$search  = array('#contact_id#', '#name#', '#email#', '#cellphone#');

		foreach( $it as $key => $val ):
			$replace = array($val->contact_id, $val->name, $val->email, $val->cellphone);
			$_tpl .= str_replace($search, $replace, $tpl);
		endforeach;

		return $_tpl;
	}

	public function edit()
	{
		$url = $this->segment(2);
		$id = ( $url > 0 ) ? intval( $url ) : 0;

		if (is_integer($id) && $id == 0):
			echo json_encode(['success' => false, 'message' => 'ID is invalid']);
			exit;
		endif;

		#return Contact::find($id)->json();
		echo json_encode( Contact::findByID($id) );
	}

	public function save() 
	{
		if ( ! isset($_POST) ):
			echo json_encode(['success' => false, 'message' => 'Error 500 - Action invalid']);
			exit;
		endif;
			
		extract($_POST);
		
		$code = intval($code);

		if ($code != 0):
			echo json_encode(['success' => false, 'message' => 'ID is invalid']);
			exit;
		endif;

		$result = Contact::save(null, [
			'name' => $name,
			'address' => $address,
			'cellphone' => $cellphone,
			'email' => $email,
			'create_at' => date("Y-m-d h:i:s"),
		]);

		if ($result):
			echo json_encode(['success' => true, 'message' => 'Success to save', 'contact_id' => $result]);
			exit;
		else:
			echo json_encode(['success' => false, 'message' => 'Failed to save', 'contact_id' => 0]);
			exit;
		endif;
	}

	/**
	 * 
	 * Primary key value must be the last element
	 */
	public function update()
	{
		if ( ! isset($_POST) ):
			echo json_encode(['success' => false, 'message' => 'Error 500 - Action invalid']);
			exit;
		endif;

		extract($_POST);

		$code = $this->segment(2);
		
		$code = intval($code);

		if ($code == 0):
			echo json_encode(['success' => false, 'message' => 'ID is invalid']);
			exit;
		endif;

		$lines_affected = Contact::update(
			null,
			[
				'name' => $name,
				'address' => $address,
				'cellphone' => $cellphone,
				'email' => $email
			],
			$code
		);

		if ($lines_affected):
			echo json_encode(['success' => true, 'message' => 'Success to update', 'lines_affected' => $lines_affected]);
			exit;
		else:
			echo json_encode(['success' => false, 'message' => 'Failed to update', 'contact_id' => 0]);
			exit;
		endif;
	}

	public function delete()
	{
		if ( ! isset($_POST) ):
			echo json_encode(['success' => false, 'message' => 'Error 500 - Action invalid']);
			exit;
		endif;

		extract($_POST);

		$code = intval($code);

		if ($code == 0):
			echo json_encode(['success' => false, 'message' => 'ID is invalid']);
			exit;
		endif;

		$lines_affected = Contact::delete(null, [$code]);

		if ($lines_affected):
			echo json_encode(['success' => true, 'message' => 'Success deleted', 'lines_affected' => $lines_affected]);
			exit;
		else:
			echo json_encode(['success' => false, 'message' => 'Failed to deleted', 'contact_id' => 0]);
			exit;
		endif;
	}
}