<?php
App::import('Vendor', 'TopApi');

class MitemsController extends AppController{
	
	public function index(){
		if(!$this->request->is("post")){
			$this->set("items", $this->Mitem->find("all"));
		}
		else{
			$this->autoRender = false;
			$id = $_POST['id'];
			$description = $_POST['description'];
			$mitem = array();
			$mitem['Mitem']['id'] = $id;
			$mitem['Mitem']['description'] = $description;
			if($this->Mitem->save($mitem)){
				echo "success";
			}
			else 
				echo "failed";
		}
	}
	
	public function add(){
		if(!$this->request->is("post")){
			$this->Mitem->Item->recursive = -1;
			$this->set("items", $this->Mitem->Item->find("all"));	
		}
		else {
			$this->autoRender = false;
			$id = $_POST['id'];
			$description = $_POST['description'];
			if($this->Mitem->find("count", array('conditions'=>array('item_id'=>$id))) > 0){
				echo "exist";
			}
			else {
				$mitem = array();
				$mitem['Mitem']['item_id'] = $id;
				$mitem['Mitem']['description'] = $description;
				if($this->Mitem->save($mitem))
					echo "success";
				else
					echo "failed";
			}
		}
	}
}
?>