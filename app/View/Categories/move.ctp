<form>
<table style="text-align:center">
<tr>
	<td>
		淘宝目录编号
	</td>
	<td>
		淘宝目录名
	</td>
	<td>
		未知专刊名
	</td>
	<td>
		移动到目录层次
	</td>
	<td>
		设置父目录
	</td>
	<td>
	</td>
</tr>
<tr>
	<td>
		<input type="hidden" name="data[id]" value="<?php echo $category['id'];?>"/>
		<input type="hidden" name="type" value="<?php echo $type;?>" />
		<input name="data[cid]" value="<?php echo $category['cid']?>" />
	</td>
	<td>
		<input name="data[nick]" value="<?php echo $category['nick'];?>" />
	</td>
	<td>
		<input name="data[name]" value="<?php echo $category['name'];?>" />
	</td>
	<td>
		<select name="level">
		<?php if($type != 1){?>
			<option value="1">一级目录</option>
		<?php }
			  if($type != 2){?>
			<option value="2">二级目录</option>
		<?php }
			  if($type != 3){?>
			<option value="3">三级目录</option>
		<?php }?>
		</select>
	</td>
	<td>
		<select id="change_level">
		</select>
	</td>
	<td>
		<input type="submit" value="保存" />
	</td>
</tr>
</table>
</form>

<script type="text/javascript">
<!--
$("select[name='level']").change(function(){
	var select = "#change_level";
	$(select + " option").remove();
	var level = $(this).val();
	if(level == '2'){
		$(select).attr("name", "data[ancestor_id]");
		$.ajax({
			type:'get',//可选get
			url: '/admin/categories/ancestors',
			success:function(msg){
				var arr = eval(msg);
				$(arr).each(function(index){
					var name = arr[index].CategoryAncestor.name;
					var id = arr[index].CategoryAncestor.id;
					var option = '';
					if(index == 0){
						option = "<option value="+id+" checked>"+name+"</option>"
					}
					else {
						option = "<option value="+id+">"+name+"</option>"
					}
					$(select).append(option);
				});
			},
			error:function(){
			}
		})
		$(select).css("display", "block");
	}
	else if(level == '3'){
		$(select).attr("name", "data[parent_id]");
		$.ajax({
			type:'get',//可选get
			url: '/admin/categories/parents',
			success:function(msg){
				var arr = eval(msg);
				$(arr).each(function(index){
					var name = arr[index].CategoryParent.name;
					var id = arr[index].CategoryParent.id;
					if(index == 0){
						option = "<option value="+id+" checked>"+name+"</option>"
					}
					else {
						option = "<option value="+id+">"+name+"</option>"
					}
					$(select).append(option);
				});
			},
			error:function(){
			}
		})
		$(select).css("display", "block");
	}
});
//-->
</script>
