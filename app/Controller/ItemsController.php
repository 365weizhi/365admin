<?php
App::import('Vendor', 'TopApi');

class ItemsController extends AppController{
	
	public function index(){
		$this->Item->recursive = -1;
		$this->set("categories", $this->Item->Category->find("all", array(
			'field'=>"id, name",
		)));
		$this->set("items", $this->Item->find("all",array(
			'order'=>array(
				'update_time'=>'desc',
			)
		)));
	}
	
	public function multiplesave(){
		$items = $this->request->data;
		foreach($items as $item){
			$Item = array();
			$Item['Item'] = $item;
			$Item['Item']['id'] = '';
			$this->Item->Category->query("update 365wzs_categories set son_count=son_count+1 where id=".$Item['Item']['content_id']);
			$this->Item->save($Item);
		}
		$this->redirect("/items/multiple");
	}
	
	public function multiple(){
	    if(isset($_POST['urls'])){
	    	$items = array();
	    	$exist = array();
			$arr = preg_split("/([^\S]+)\n/", $_POST['urls']);
			$api = new TopApi();
			foreach($arr as $row){
				$num_iid = $api->get_id($row);
				if($num_iid == 0)
					continue;
				$count = $this->Item->find("count",array(
					'conditions'=>array(
						'num_iid'=>$num_iid,
					)
				));
				$resq = $api->fetch($num_iid);
				$resq['Item']['id'] = '';
				$resq['Item']['num_iid'] = $num_iid;
				$resq['Item']['url'] = $row;
				if($count > 0){
					$exist[] = $resq;
					continue;
				}
				$items[] = $resq;
				/*
				if($resq != false && $this->Item->save($resq['Item'])){
					$record['success'][] = $num_iid;		
				}
				else{
					$record['failed'][] = $num_iid;
				}
				*/
			}
			$this->Item->Category->recursive = -1;
			$this->set("categories", $this->Item->Category->find("all"));
			$this->set("items", $items);
			$this->set("exist", $exist);
			$this->render("multiple-form");
	    }
	    else {
	    	$this->render("multiple");
	    }
	}
	
	public function search(){
		$this->set("data", $this->Item->find("all"));
		$this->set("Category", $this->Item->Category->find("all", array(
				'group'=>'Category.name'
			)
		));
		
		if(isset($_POST['Search'])){
			$this->set("search", true);	
			//$this->set("input", $_POST['Search']);
			$this->set("datas", $this->fetch(
				$_POST['Search']['keyword'],
				$_POST['Search']['category'], 
				$_POST['Search']['area']
			));
		}
		else{
			$this->set("search", false);
		}
	}

	public function edit(){
		if($this->request->is("post") && isset($_POST['Item'])){
			if($this->Item->save($_POST)){
				$this->Session->setFlash("修改成功");
			}	
			else {
				$this->Session->setFlash("修改失败");
			}
		}
		$this->redirect($this->referer());
	}

	public function batchAdd(){
		//header("Content-type: text/html; charset=utf-8");
		$this->autoRender=false;
		$category = $this->Item->Category->find("first", array(
			'conditions'=>array(
				'Category.name'=>$_POST['Search']['category'],
			)
		));
		if($category){
			$this->Session->setFlash("添加成功了");
			foreach($_POST['Item'] as $data){
				if(isset($data['check']) && $data['check'] == "on"){
					$count = $this->Item->find("count", array(
						'conditions'=>array(
							'num_iid'=>$data['num_iid'],							
						)
					));
					if($count>0){
						$this->Session->setFlash("有重复商品");
						continue ;
					}
					$item['Item'] = $data;
					// time用时间戳即可，用于排序
					$item['Item']['update_time'] = time();
					//$item['Item']['cid'] = $category['Category']['id'];
					$this->Item->create();
					if(!$this->Item->save($item)){
						$this->Session->setFlash("好像有什么问题哦，等等再试试");
					}
				}
			}
		}else{
			$this->Session->setFlash("好像有什么问题哦，等等再试试");			
		}
		$this->redirect("index");
	}
	/**
	 * 根据商品num_iid添加到数据库
	 */
	public function add(){
		if($this->request->is("post")){
			$num_iid = $_POST['num_iid'];
			$content_id = $_POST['content_id'];
			
			$count = $this->Item->find('count', array(
				'conditions'=>array(
					'num_iid' => $num_iid,
				)		
			));
			
			if($count > 0){
				$this->Session->setFlash("已有该商品.");
				$this->redirect("add");			
			}
			$item = $this->getItemById($num_iid);
			if($item == ""){
				$this->Session->setFlash("商品不存在.");
				$this->redirect("add");
			}
			
			if(isset($_POST['description'])){
				$item['Item']['description'] = $_POST['description'];
				$item['Item']['content_id'] = $content_id;
				$item['Item']['update_time'] = time();
				$rt = $this->Item->save($item);
				$this->Item->Category->query("update 365wzs_categories set son_count=son_count+1 where id=".$item['Item']['content_id']);
				if($rt){
					$this->Session->setFlash("保存成功.");
					$this->redirect("index");
				} 
				else {
					$this->Session->setFlash("保存失败.");
					$this->redirect("index");
				}
			}
			$this->set('item', $item);
		}
		else 
			$this->render('input');
	}

	/**
	 * 根据商品num_iid获取商品信息
	 */
	public function getItemById($num_iid){
	    if(isset($num_iid)){
			$api = new TopApi();
			$resq = $api->fetch($num_iid);
			return $resq;
	    }
	}

	/**
	* 根据关键字从淘宝获取商品信息
	*/
	function fetch($keyword, $name, $area =''){
		$api = new TopApi();
		$data['keyword'] = $keyword;
		
		$this->Item->Category->recursive = -1;
		$categories = $this->Item->Category->find("all", array(
			'conditions'=>array(
				'name'=>$name
			)
		));
		
		$rt_obj = array();
		foreach($categories as $category){
			$resq = $api->searchItem($keyword, $category['Category']['id'], $area);
			if(isset($resq->total_results) && $resq->total_results > 0){
				$data['resq'] = $resq->taobaoke_items;
				$data['count'] = $resq->total_results;
			}
			else {
				$data['resq'] = '';
				$data['count'] = 0;
			}	
			$data['cid'] = $category['Category']['id'];
			
			$rt_obj[] = $data;
		}
		return $rt_obj;
	}
}
?>