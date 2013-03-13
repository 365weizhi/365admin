<style>
#depots-category{
	width: 500px;
	margin-bottom: 10px;
}
#depots-category span{
	float: right;
}
.span2 {
	width: 120px;
	margin-left: 5px;
	height: 133px;
}
.span2 img{
	cursor: pointer;
}
</style>
<div>
	<select id="depots-category">
	<?php
		$items_left = 0;
		foreach($categories as $category){
			$size = $category['Category']['son_count'];
			$items_left += $size;
			if($category['Category']['id'] == $category_id)
				echo "<option value='".$category['Category']['id']."' selected>商品剩余($size)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$category['Category']['name']."</option>";
			else 
				echo "<option value='".$category['Category']['id']."'>商品剩余($size)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$category['Category']['name']."</option>";
		} 
		if(!isset($category_id))
			echo "<option value='' selected>所有商品</option>";
		else 
			echo "<option value=''>所有商品</option>";
	?>
	</select>
	<a href="/365admin/depots/index">所有商品</a>
	剩余:<?php echo $items_left;?>件
</div>


<?php 
	if(isset($category_id)){
		$items = $items['Item'];
	}
	foreach($items as $item){
		if(!isset($category_id)){
			$item = $item['Item'];	
		}
?>
	<div class="span2" >
		<div class="thumbnail" id="carousel-selector-0">
			<img onclick="window.location.href='<?php echo $item['click_url'];?>'" class="thumbnail" src="<?php echo $item['pic_url']."_100x100.jpg"?>" />
			<a target="_blank" href="<?php echo $item['click_url'];?>">查看</a>
			<a href="">删除</a>
			<a href="">移动</a>
		</div>
	</div>
<?php 
	}
?>

<script>
$("#depots-category").change(function(){
	window.location.href = "/365admin/depots/index/"+this.value;
});	
</script>

<!--
		<tr>
			<td><img src="<?php echo $item['pic_url']."_80x80.jpg";?>" /></td>
			<td><?php echo $item['nick'];?></td>
			<td><img src="<?php echo $item['pic_url']."_80x80.jpg";?>" /></td>
			<td><?php echo $item['nick'];?></td>
			<td><img src="<?php echo $item['pic_url']."_80x80.jpg";?>" /></td>
			<td><?php echo $item['nick'];?></td>
			<td><img src="<?php echo $item['pic_url']."_80x80.jpg";?>" /></td>
			<td><?php echo $item['nick'];?></td>
			<td><img src="<?php echo $item['pic_url']."_80x80.jpg";?>" /></td>
			<td><?php echo $item['nick'];?></td>
			<td><img src="<?php echo $item['pic_url']."_80x80.jpg";?>" /></td>
			<td><?php echo $item['nick'];?></td>
			<td><img src="<?php echo $item['pic_url']."_80x80.jpg";?>" /></td>
			<td><?php echo $item['nick'];?></td>
		</tr>
-->