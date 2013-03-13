<?php
App::uses('AppModel', 'Model');

class Follow extends AppModel {
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'follow_id',
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
