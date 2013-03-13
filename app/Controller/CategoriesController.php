<?php
App::import('Vendor', 'TopApi');

class CategoriesController extends AppController{
	public $uses = array("Category", "CategoryParent", "CategoryAncestor");
	
	public function index($type = 3){
		if($type == 1){
			$this->set("categories", $this->CategoryAncestor->find("all"));
			$this->render("ancestor");
		}
		else if($type == 2){
			$this->set("ancestors", $this->CategoryAncestor->find("all"));
			$this->set("categories", $this->CategoryParent->find("all"));
			$this->render("parent");
		}
		else {
			$this->CategoryParent->recursive = -1;
			//pr($this->CategoryParent->find("all"));
			//pr($this->Category->find("all"));
			$this->set("categories", $this->Category->find("all"));
			$this->set("parents", $this->CategoryParent->find("all"));
			$this->render("category");
		}
	}
	
	public function add($cid=0){
		if(isset($_POST['data'])){
			$conditions = array(
				'conditions'=>array(
					'Category.nick'=>$_POST['data']['nick'],
					'Category.name'=>$_POST['data']['name']
				)
			);
			$parent_count = $this->Category->find("count",$conditions);
			if($parent_count > 0){
				$this->Session->setFlash("该专刊已存在.");
				$this->redirect($this->referer());
			}
			$this->addCategory($_POST['data']['cid'], $_POST['data']['name'], $_POST['data']['nick']);
		}
		$api = new TopApi();
        $data['parent_cid'] = $cid;
        $data['resq'] = $api->getCats($cid)->item_cats;
		$this->set('data', $data);
	}
	
	public function update(){
		$this->autoRender = false;
		//header("Content-type: text/html; charset=utf-8"); 
		$type = $_POST['type'];
		
		$this->Session->setFlash("ok, 更新成功");
		if($type == 1){
			$this->CategoryAncestor->save($this->request->data);
			$this->redirect("index/1");
		}
		else if($type == 2){
			$this->CategoryParent->save($this->request->data);
			$this->redirect("index/2");
		}
		else if($type == 3){
			$this->Category->save($this->request->data);
			$this->redirect("index/3");
		}
		$this->Session->setFlash("更新失败，稍后重试吧~");
		$this->redirect("index");
	}
	
	public function move($type, $id){
		if($type == 1){
			$ancestor = $this->Category->CategoryParent->CategoryAncestor->find("first", array(
				'conditions'=>array(
					'CategoryAncestor.id'=>$id
				)
			));
			$category = $ancestor['CategoryAncestor'];
		}
		if($type == 2){
			$parent = $this->Category->CategoryParent->find("first", array(
				'conditions'=>array(
					'CategoryParent.id'=>$id
				)
			));
			$category = $parent['CategoryParent'];
		}
		if($type == 3){
			$category = $this->Category->find("first", array(
				'conditions'=>array(
					'Category.id'=>$id
				)
			));
			$category = $category['Category'];
		}
		$this->set("category", $category);
		$this->set("type", $type);
	}

	public function delete($type, $id){
		$this->autoRender = false;
		$flag = null;
		if($type == 1){
			$flag = $this->Category->CategoryParent->CategoryAncestor->delete($id);
		}
		else if($type == 2){
			$ancestor_id = $this->Category->CategoryParent->field("category_ancestor_id", array(
				'CategoryParent.id'=>$id
			));
			$flag = $this->Category->CategoryParent->delete($id);
			$this->Category->CategoryParent->CategoryAncestor->query("update 365wzs_category_ancestors set son_count=son_count-1 where id=".$ancestor_id);
		}
		else if($type == 3){
			$parent = $this->Category->field("category_parent_id", array(
				'Category.id'=>$id
			));
			$flag = $this->Category->delete($id);
			$this->Category->CategoryParent->query("update 365wzs_category_parents set son_count=son_count-1 where id=".$parent);
		}
		else {
			$this->Session->setFlash("错误的专刊类型");
		}
		
		if($flag){
			$this->Session->setFlash("删除成功");
		}
		else {
			$this->Session->setFlash("删除失败");
		}
		$this->redirect("index/$type");
	}
	
	/* Only for first use 
	public function operate(){
		$this->autoRender = false;
		header("Content-type: text/html; charset=utf-8");
		//pr($this->CategoryParent->find("all"));
		$categories = $this->Category->find("all");
		foreach($categories as $_category){
			$category = $_category['Category'];
			$arr = split("-", $category['name']);
			
			$ancestor = null;
			$parent = null;
			if(sizeof($arr) >= 1){
				if(sizeof($arr) == 1) {
					$ancestor = $this->CategoryAncestor->find("first", array(
						'conditions'=>array(
							'CategoryAncestor.name'=>$arr[0],
							'CategoryAncestor.nick'=>$category['nick'],
						)
					));
				}
				else {
					$ancestor = $this->CategoryAncestor->find("first", array(
						'conditions'=>array(
							'CategoryAncestor.name'=>$arr[0],
						)
					));
				}
				
				if(!$ancestor){
					$this->CategoryAncestor->create();
					$ancestor = array();
					$ancestor['CategoryAncestor']['name'] = $arr[0];
					$ancestor['CategoryAncestor']['nick'] = $category['nick'];
					$ancestor = $this->CategoryAncestor->save($ancestor);
				}
				if(sizeof($arr) == 1){
					$ancestor['CategoryAncestor']['cid'] = $category['id'];
					$this->CategoryAncestor->save($ancestor);
					$this->Category->delete($category['id']);
					continue ;
				}
			}
			if(sizeof($arr) >= 2){
				if(sizeof($arr) == 2){
					$parent = $this->CategoryParent->find("first", array(
						'conditions'=>array(
							'CategoryParent.name'=>$arr[1],
							'CategoryParent.nick'=>$category['nick'],
						)
					));
				}
				else {
					$parent = $this->CategoryParent->find("first", array(
						'conditions'=>array(
							'CategoryParent.name'=>$arr[1],
						)
					));
				}
				if(!$parent){
					$this->CategoryParent->create();
					$parent = array();
					$parent['CategoryParent']['name'] = $arr[1];
					$parent['CategoryParent']['nick'] = $category['nick'];
					$parent['CategoryParent']['category_ancestor_id'] = $ancestor['CategoryAncestor']['id'];
					$parent = $this->CategoryParent->save($parent);
				}
				$ancestor['CategoryAncestor']['son_count'] ++;
				$this->CategoryAncestor->save($ancestor);
				if(sizeof($arr) == 2){
					$parent['CategoryParent']['cid'] = $category['id'];
					$this->CategoryParent->save($parent);
					$this->Category->delete($category['id']);
					continue ;
				}
			}
			if(sizeof($arr) >= 3){
				$_category['Category']['name'] = $arr[2];
				$_category['Category']['category_parent_id'] = $parent['CategoryParent']['id'];
				$this->CategoryParent->query("update 365wzs_category_parents set son_count=son_count+1 where id=".$parent['CategoryParent']['id']);
				echo $parent['CategoryParent']['id'];
				//$parent['CategoryParent']['son_count'] ++;
				//echo $parent['CategoryParent']['son_count'];
				//$this->CategoryParent->save($parent);
				$this->Category->save($_category);
			}
		}
	} */
	
	public function ancestors(){
		$this->autoRender = false;
		$this->Category->CategoryParent->CategoryAncestor->recursive = -1;
		$ancestors = $this->Category->CategoryParent->CategoryAncestor->find("all", array(
						'fields'=>array('id', 'name')
					));
		echo json_encode($ancestors);
	}
	
	public function parents($ancestor_id = 0){
		$this->autoRender = false;
		$this->Category->CategoryParent->recursive = -1;
		if($ancestor_id == 0) {
			$parents = $this->Category->CategoryParent->find("all", array(
				'fields'=>array('id', 'name')
			));
		}
		else {
			$parents = $this->Category->CategoryParent->find("all", array(
				'conditions'=>array('category_ancestor_id'=>$ancestor_id),
				'fields'=>array('id', 'name')
			));
		}
		echo json_encode($parents);
	}
	
	public function categories($parent_id = 0){
		$this->autoRender = false;
		$this->Category->CategoryParent->recursive = -1;
		if($parent_id == 0) {
			$parents = $this->Category->find("all", array(
				'fields'=>array('id', 'name')
			));
		}
		else {
			$parents = $this->Category->find("all", array(
				'conditions'=>array('category_parent_id'=>$parent_id),
				'fields'=>array('id', 'name')
			));
		}
		echo json_encode($parents);
	}

	/**
	* 添加目录到数据库
	*/
	function addCategory($cid, $name, $nick){
		$arr = array();
		$arr['Category']['cid'] = $cid;
        $arr['Category']['name'] = $name;
        $arr['Category']['nick'] = $nick;
		if($this->Category->save($arr))
		    return true;
		else
		    return false;
	}
	
	function addParent($cid, $name, $nick, $ancestor_id = 0){
		$arr = array();
		$arr['CategoryParent']['cid'] = $cid;
        $arr['CategoryParent']['name'] = $name;
        $arr['CategoryParent']['nick'] = $nick;
        $arr['CategoryParent']['category_ancestor_id'] = $ancestor_id;
        $this->Category->CategoryParent->CategoryAncestor->query("update 365wzs_category_ancestors set son_count=son_count+1 where id=".$ancestor_id);
		if($this->Category->CategoryParent->save($arr))
		    return true;
		else
		    return false;
	}
	
	function addAncestor($cid, $name, $nick){
		$arr = array();
		$arr['CategoryAncestor']['id'] = $cid;
        $arr['CategoryAncestor']['name'] = $name;
        $arr['CategoryAncestor']['nick'] = $nick;
		if($this->Category->CategoryParent->CategoryAncestor->save($arr))
		    return true;
		else
		    return false;
	}
}
?>