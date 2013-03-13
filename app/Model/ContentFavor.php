<?php
App::uses('AppModel', 'Model');
/**
 * Content Model
 *
 * @property User $User
 * @property Favor $Favor
 * @property Item $Item
 */
class ContentFavor extends AppModel {

	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => 'id, username, email',
			'order' => ''
		),
		'Content'=>array(
			'classname'=>'Content',
			'foreignKey'=>'content_id',
		)
	);

}
