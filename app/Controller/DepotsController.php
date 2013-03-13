<?php
class DepotsController extends AppController{
	public $uses = array('Category', 'Item', 'CategoryItem');
	
	public function index($category_id = null){
		if(isset($category_id)){
			$items = $this->CategoryItem->find("all", array(
				'conditions'=>array(
					'category_id'=>$category_id,
				)
			));
		}
		else{
			$this->Item->recursive = -1;
			$items = $this->Item->find("all");
		}
		
		$this->Category->recursive = -1;
		$this->set("category_id", $category_id);
		$this->set("categories", $this->Category->find("all"));
		$this->set("items", $items);
	}
}	
?>