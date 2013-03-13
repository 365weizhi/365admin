<?php
App::uses('AppModel', 'Model');

class Fans extends AppModel {
	public $name = "Follow";
	
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => 'id, username',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
}
