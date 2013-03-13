<?php
class RebotsController extends AppController{
	public $uses = array('User', 'Content');
	public function index(){
		$this->set("rebots", $this->User->find("all", array(
			'conditions'=>array(
				'is_rebot'=>1
			)
		)));
	}
	public function add(){
		if($this->request->is("post")){
			$dir     = dirname(dirname(__FILE__)).DS."webroot";
			$pre_dir = $dir.DS."storage";
			$pst_dir = $dir.DS."avatar";
			
			$names   = split("\n", $this->request->data['names']);
			$avatars = scandir($dir.DS."storage");		
			$counter = 0;
			foreach($avatars as $avatar){
				if($counter++ < 2 || $counter-2 >= sizeof($names)){
					continue;
				}
				$username = $names[$counter-2];
				$pic_name = md5($username).".jpg";
				$pre_file = $pre_dir.DS.$avatar;
				$pst_file = $pst_dir.DS.$pic_name;
				
				copy($pre_file,$pst_file); //copy
				unlink($pre_file); //delete
				
				$rebot = array();
				$this->User->Create();
				$rebot['User']['username'] = $username;
				$rebot['User']['pic_url'] = $pic_name;
				$rebot['User']['is_rebot'] = 1;
				$new_user = $this->User->save($rebot);
				
				$content = array();
				$this->Content->Create();
				$content['Content']['name'] = "我的专刊";
				$content['Content']['description'] = "默认专刊";
				$content['Content']['user_id'] = $new_user['User']['id'];
				$this->Content->save($content);
			}
			$this->set("success", sizeof($names) - $counter + 2);
		}
	}
}	
?>