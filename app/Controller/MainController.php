<?php
class MainController extends AppController{
	public $uses = array('Category', 'Item');
	public function index(){
		$this->autoRender = false;
		pr($this->Category->find('all'));
	}
}	
?>