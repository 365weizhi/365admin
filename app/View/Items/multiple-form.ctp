<form method="POST" action="/365admin/items/multiplesave">
	<ul class="multiple">
<?php 
	foreach($items as $item){
		$item = $item['Item'];
?>
		<li>
			<div class="multiple-thumb">
				<a target="_blank" href="<?php echo isset($item['click_url'])?$item['click_url']:$item['url'];?>">
					<img src="<?php echo $item['pic_url'];?>_80x80.jpg" />
				</a>
			</div>
			<div class="multiple-detail">
				<input type="hidden" name="Item<?php echo $item['num_iid'];?>[num_iid]" value="<?php echo $item['num_iid'];?>"/>
				<input type="hidden" name="Item<?php echo $item['num_iid'];?>[pic_url]" value="<?php echo $item['pic_url'];?>"/>
				<input type="hidden" name="Item<?php echo $item['num_iid'];?>[click_url]" value="<?php echo isset($item['click_url'])?$item['click_url']:$item['url'];?>"/>
				<input type="hidden" name="Item<?php echo $item['num_iid'];?>[shop_click_url]" value="<?php echo isset($item['shop_click_url'])?$item['shop_click_url']:$item['url'];?>"/>
				<input type="hidden" name="Item<?php echo $item['num_iid'];?>[nick]" value="<?php echo isset($item['nick'])?$item['nick']:'';?>"/>
				<input type="hidden" name="Item<?php echo $item['num_iid'];?>[cid]" value="<?php echo $item['cid'];?>"/>
				<input type="hidden" name="Item<?php echo $item['num_iid'];?>[content_id]" id="content_id<?php echo $item['num_iid'];?>"/>
				标题：<input style="width:80%" value="<?php echo $item['title'];?>" name="Item<?php echo $item['num_iid'];?>[title]"/>
				<br><br>
				位置：<input value="<?php echo isset($item['item_location'])?$item['item_location']:'';?>" name="Item<?php echo $item['num_iid'];?>[item_location]"/>
				&nbsp;&nbsp;&nbsp;&nbsp;
				价格：<?php echo $item['price'];?>￥
				&nbsp;&nbsp;&nbsp;&nbsp;
				专刊：<select name="Item<?php echo $item['num_iid'];?>[content_id]">
						<?php 
							foreach($categories as $category) {
								$category = $category['Category'];
								echo "<option value=".$category['id'].">".$category['name']."</option>";
							}
						?>
					  </select>
				<br>
				<!-- 描述：<textarea name="Item<?php echo $item['num_iid'];?>[description]"></textarea>  -->
			</div>
			<div class="clear"></div>
		</li>
<?php 
	}
?>
	</ul>
	<div class="multiple-submit">
		<input type="submit" class="btn btn-success"/>
		<a href="/365admin/items/multiple" class="btn btn-info">返回</a>
	</div>
</form>


<script type="text/javascript">
<!--
/*
$("select[name='content0']").change(function(){
	var ancestor_id = $(this).val();
	var num_iid = $(this)[0].id;
	$("#content_id"+num_iid).val(ancestor_id);
	
	$("select#content1"+num_iid+" option").remove();
	$("select#content2"+num_iid+" option").remove();
	$.ajax({
		type:'get',//可选get
		url: '/365admin/categories/parents/'+ancestor_id,
		success: function(msg){
			var arr = eval(msg);
			$(arr).each(function(index){
				var name = arr[index].CategoryParent.name;
				var id = arr[index].CategoryParent.id;
				var option = '';
				if(index == 0){
					$("#content_id"+num_iid).val(id);
					option = "<option value="+id+" checked>"+name+"</option>"
				}
				else {
					option = "<option value="+id+">"+name+"</option>"
				}
				$("select#content1"+num_iid).append(option);
			});
			$.ajax({
				type:'get',//可选get
				url: '/365admin/categories/categories/'+arr[0].CategoryParent.id,
				success: function(msg){
					var arr = eval(msg);
					$(arr).each(function(index){
						var name = arr[index].Category.name;
						var id = arr[index].Category.id;
						var option = '';
						if(index == 0){
							$("#content_id"+num_iid).val(id);
							option = "<option value="+id+" checked>"+name+"</option>"
						}
						else {
							option = "<option value="+id+">"+name+"</option>"
						}
						$("select#content2"+num_iid).append(option);
					});
				},
				error:function(){
				}
			});
		},
		error:function(){
		}
	});
	
});

$("select[name='content1']").change(function(){
	var id = $(this).val();
	var num_iid = $(this)[0].id;
	num_iid = num_iid.substring(8);
	$("#content_id"+num_iid).val(id);
	
	$("select#content2"+num_iid+" option").remove();
//	$("select[name='content2'] option").remove();
	$.ajax({
		type:'get',//可选get
		url: '/365admin/categories/categories/'+id,
		success: function(msg){
			var arr = eval(msg);
			$(arr).each(function(index){
				var name = arr[index].Category.name;
				var id = arr[index].Category.id;
				var option = '';
				if(index == 0){
					$("#content_id"+num_iid).val(id);
					option = "<option value="+id+" checked>"+name+"</option>"
				}
				else {
					option = "<option value="+id+">"+name+"</option>"
				}
				$("select#content2"+num_iid).append(option);
			});
		},
		error:function(){
		}
	});
});
$("select[name='content2']").change(function(){
	var id = $(this).val();
	var num_iid = $(this)[0].id;
	num_iid = num_iid.substring(8);
	console.log(num_iid);
	$("#content_id"+num_iid).val(id);
});
*/
//-->
</script>