<style>
	#search-list {overflow:hidden;*zoom:1;}
	#search-list p {margin:2px 0;}
	#search-list li {float:left;padding:5px;background: #F7F7F7;margin:0 10px 10px 0;list-style-type:none;color:#B3B3B3;}
	#search-list li a {display:block;cursor:pointer;}
	#search-list li img {height:120px;}
</style>

<form method="post">
   <table>
	<tr>
		<th>
			<label>关键字</label>
		</th>
		<th>
			<label>目录</label>
		</th>
		<th>
			<label>地域</label>
		</th>
		<th>
		</th>
	</tr>
	<tr>
		<th>
			<input name="Search[keyword]" value="<?php echo isset($_POST['Search']['keyword'])?$_POST['Search']['keyword']:'';?>" />
		</th>
		<th>
			<select name="Search[category]">
			<?php
			foreach($Category as $cat){
				if(isset($_POST['Search']['category']) && $_POST['Search']['category'] == $cat['Category']['name']){
					echo "<option value=".$cat['Category']['name']." selected >".$cat['Category']['name']."</option>";
				}
				else {
					echo "<option value=".$cat['Category']['name'].">".$cat['Category']['name']."</option>";
				}
			}
			?>
			</select>
		</th>
		<th>
			<input name="Search[area]" value="<?php echo (isset($_POST['Search']['area'])?$_POST['Search']['area']:'');?>" />
		</th>
		<th>
	   		<input type="submit" value="Search"/>
		</th>
	</tr>
   </table>
</form>

<input id="search-select-all" value="全选" type="button" />
<form method="post" action="<?php echo $this->webroot."items/batchAdd"?>">
<?php 
if(isset($_POST['Search'])){
?>
	<input type="hidden" name="Search[keyword]" value="<?php echo $_POST['Search']['keyword'];?>" />
	<input type="hidden" name="Search[category]" value="<?php echo $_POST['Search']['category'];?>" />
	<input type="hidden" name="Search[area]" value="<?php echo $_POST['Search']['area'];?>" />
<?php 
}
?>
<ul id='search-list'>
<?php
$counter = 0;
if(!$search){
	echo '没有找到商品，改一下关键词或者类别。';
} else{
	foreach($datas as $data){
	    if(!isset($data['count']) || $data['count'] <= 0){
		echo '没有找到商品，改一下关键词或者类别。';
	    }
	    else {
			foreach($data['resq']->taobaoke_item as $taobaoke_item){
				$counter ++;
?>
	<li>
		<input type="hidden" name="Item[Item<?php echo $counter;?>][num_iid]" value="<?php echo $taobaoke_item->num_iid;?>" />
		<input type="hidden" name="Item[Item<?php echo $counter;?>][nick]" value="" />
		<input type="hidden" name="Item[Item<?php echo $counter;?>][title]" value="<?php echo $taobaoke_item->title; ?>" />
		<input type="hidden" name="Item[Item<?php echo $counter;?>][cid]" value="<?php echo $data['cid']; ?>" />
		<input type="hidden" name="Item[Item<?php echo $counter;?>][click_url]" value="<?php echo $taobaoke_item->click_url; ?>" />
		<input type="hidden" name="Item[Item<?php echo $counter;?>][shop_click_url]" value="<?php echo $taobaoke_item->shop_click_url; ?>" />
		<input type="hidden" name="Item[Item<?php echo $counter;?>][pic_url]" value="<?php echo $taobaoke_item->pic_url; ?>" />
		<input type="hidden" name="Item[Item<?php echo $counter;?>][price]" value="<?php echo $taobaoke_item->price; ?>" />
		<input type="hidden" name="Item[Item<?php echo $counter;?>][item_location]" value="<?php echo $taobaoke_item->item_location; ?>" />
		<input type="hidden" name="Item[Item<?php echo $counter;?>][commission_rate]" value="<?php echo $taobaoke_item->commission_rate; ?>" />
		<input type="hidden" name="Item[Item<?php echo $counter;?>][commission]" value="<?php echo $taobaoke_item->commission; ?>" />
		<input type="hidden" name="Item[Item<?php echo $counter;?>][commission_num]" value="<?php echo $taobaoke_item->commission_num; ?>" />
		<input type="hidden" name="Item[Item<?php echo $counter;?>][commission_volume]" value="<?php echo $taobaoke_item->commission_volume; ?>" />
		<input type="hidden" name="Item[Item<?php echo $counter;?>][volume]" value="<?php echo $taobaoke_item->volume; ?>" />
		<input class="_checkbox" type="checkbox" name="Item[Item<?php echo $counter;?>][check]"/>
	<a href='<?php echo $taobaoke_item->click_url; ?>'
		target="_blank"
		data-taobaoke_id='<?php echo $taobaoke_item->num_iid; ?>' 
		title='<?php echo strip_tags($taobaoke_item->title);?>' 
		data-price='<?php echo $taobaoke_item->price;?>' 
		data-commission='<?php echo $taobaoke_item->commission; ?>' 
		data-sellernick='<?php echo $taobaoke_item->nick; ?>'
	>
		<img src="<?php echo $taobaoke_item->pic_url."_120x120.jpg";?>" alt="<?php echo $taobaoke_item->title;?>"/>
	</a>
	<p>
	    <span class="right"><?php echo $taobaoke_item->volume; ?>件/30天</span>
	    <span><?php echo $taobaoke_item->commission; ?></span> /
	    <span><?php echo $taobaoke_item->price;?></span>
	    <!-- 
	    <a href="<?php echo $this->webroot."prophet/itemadd/".$taobaoke_item->num_iid?>" class="btn btn-info">添加</a>
	     -->
	</p>
	<p>
	    <input name="Item[Item<?php echo $counter;?>][description]" >
	</p>
	</li>
<?php
			}
	    }
    }
}
?>
	</ul>
<input type="submit" value="提交" />
</form>

<script type="text/javascript">
$("#search-select-all").bind("click", function(){
	$('input[type="checkbox"]').each(
		function() {
			 $(this).attr("checked", true); 
		}
    );
});
</script>
