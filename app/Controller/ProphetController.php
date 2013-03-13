<?php

/**
 * Controller for Admin
 * @author whenjonny
 */

App::import('Vendor', 'TopApi');

class ProphetController extends AppController{
	public $uses = array('Item', 'Category','User');

	/**
	* Getting the items from taobao database, and crud for item
	*/
	public function index(){
		$this->set("data", $this->Item->find("all"));
		$this->set("Category", $this->Category->find("all", array(
				'group'=>'Category.name'
			)
		));
		
		if(isset($_POST['Search'])){
			$this->set("search", true);	
			//$this->set("input", $_POST['Search']);
			$this->set("datas", $this->search(
				$_POST['Search']['keyword'],
				$_POST['Search']['category'], 
				$_POST['Search']['area']
			));
		}
		else{
			$this->set("search", false);
		}
	}
	
	public function batchAdd(){
		$this->autoRender=false;
		$category = $this->Category->find("first", array(
			'conditions'=>array(
				'name'=>$_POST['Search']['category'],
			)
		));
		if($category){
			$this->Session->setFlash("添加成功了");
			foreach($_POST['Item'] as $data){
				if(isset($data['check']) && $data['check'] == "on"){
					$item['Item'] = $data;
					$item['Item']['cid'] = $category['Category']['id'];
					//pr($item['Item']);
					if($this->Item->save($item)){
					}
				}
			}
		}else{
			$this->Session->setFlash("好像有什么问题哦，等等再试试");			
		}
		$this->redirect("index");
	}

	/**
	* ======================== Item method Below above category method ===========================
	*/
	public function itemadd($num_iid){
		$this->autoRender = false;
		$item = $this->getItemById($num_iid);
		if($item != false && $this->Item->save($item)){
			$record['success'][] = $num_iid;
			$this->Session->setFlash("添加成功");		
		}
		else{
			$record['failed'][] = $num_iid;
			$this->Session->setFlash("添加失败");	
		}
		
		$this->redirect("index");
		//print_r($this->getItemById($num_iid));
	}
	
	public function itemsadd(){
	    if(isset($_POST['urls'])){
		    $arr = preg_split("/([^\S]+)\n/", $_POST['urls']);
	        $api = new TopApi();
			foreach($arr as $row){
			   //echo $row;
			    $num_iid = $api->get_id($row);
			    $resq = $api->fetch($num_iid);
			    $resq['item']['id'] = '';
			    $resq['item']['num_iid'] = $num_iid;
			    if($resq != false && $this->Item->save($resq['item'])){
			    	$record['success'][] = $num_iid;		
			    }
			    else{
				    $record['failed'][] = $num_iid;
			    }	
			}
	    }
	//   pr($resq);
	}

	public function itemslist(){
	    $this->set('data', $this->Item->find('all'));
	}

	/**
	* Search item by id from the taobao database;
	*/
	public function getItemById($num_iid){
	    if(isset($num_iid)){
			$api = new TopApi();
			$resq = $api->fetch($num_iid);
			return $resq;
	    }
	}

	/**
	* Search item with urls copy from Alimama
	*/
	public function getItemByUrl($url){
		$api = new TopApi();
		$num_iid = $api->get_id($url);
		$resq = $api->fetch($num_iid);
		return $resq;
	}
	/**
	* Search items by keywords
	*/
	function search($keyword, $name, $area =''){
		$api = new TopApi();
		$data['keyword'] = $keyword;
		
		$this->Category->recursive = -1;
		$categories = $this->Category->find("all", array(
			'conditions'=>array(
				'name'=>$name
			)
		));
		$rt_obj = array();
		foreach($categories as $category){
			//echo $category['Category']['id'];
			$resq = $api->searchItem($keyword, $category['Category']['id'], $area);
			if(isset($resq->total_results) && $resq->total_results > 0){
				$data['resq'] = $resq->taobaoke_items;
				$data['count'] = $resq->total_results;
			}
			else {
				$data['resq'] = '';
				$data['count'] = 0;
			}	
			$rt_obj[] = $data;
		}	
		return $rt_obj;
	}
	
	/**
	* Search items by keywords
	function search($keyword, $cid = 0, $area =''){
		$api = new TopApi();
		$data['keyword'] = $keyword;
		$resq = $api->searchItem($keyword, $cid, $area);
		if(isset($resq->total_results) && $resq->total_results > 0){
			$data['resq'] = $resq->taobaoke_items;
			$data['count'] = $resq->total_results;
		}
		else {
			$data['resq'] = '';
			$data['count'] = 0;
		}	
		return $data;
	}
	*/
	
	/**
	* Get all category list from taobao database;
	* If $cid isset , then get the parent_id cid
	* If data is posted, save content & cat then direct to "manage content" page
	* ======================== Below are the crud method for category ================================
	*/
	public function category($cid=0){
		if(isset($_POST['data'])){
		    $this->addCategory($_POST['data']['cid'], $_POST['data']['content'], $_POST['data']['category']);
		    $this->redirect('mancon');
		}
		$api = new TopApi();
        $data['parent_cid'] = $cid;
        $data['resq'] = $api->getCats($cid)->item_cats;
		$this->set('data', $data);
	}

	/**
	* mancon means Manage Content
	* manage content in our database;
	*/
	public function mancon($cid = 0){
		$this->set("category", $this->Category->find("all"));
	}

	/**
	* Delete content from Content table
	*/
	function delcon($cid){
		if($this->Category->delete($cid)){
		    $this->redirect("mancon");
		}
		else {
     		$this->redirect('/pages/error');
		}
	}

	/**
	* Add Category from Taobao into our database;
	*/
	function addCategory($cid, $name, $nick){
		$arr = array();
		$arr['Category']['id'] = $cid;
        $arr['Category']['name'] = $name;
        $arr['Category']['nick'] = $nick;
		if($this->Category->save($arr))
		    return true;
		else
		    return false;
	}

	/**
	* Add Category into our content database;
	*/
	function addcon($cid, $name){
		$content = array();
		$content['id'] = $cid;
		$content['name'] = $name;
		if($this->Content->save($content))
		    return true;
		else 
		    return false;
	}
}
