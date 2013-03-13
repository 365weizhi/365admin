<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 * @property Item $Item
 */
class CategoryItem extends AppModel {

/**
 * Display field
 *
 * @var string
 */

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $hasOne = array(
		'Item' => array(
			'className' => 'Item',
			'foreignKey'=>'id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
