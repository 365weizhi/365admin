<table>
   <tr>
      <th>
	编号
      </th>
      <th>
淘宝目录名
      </th>
      <th>
      </th>
      <th>
   未知专刊
      </th>
      <th>
               操作
      </th>
   <tr>

<?php
$counter = 0;
foreach($data['resq']->item_cat as $item){
   echo "<tr>";
   echo "<form method='post'>";
	// nick为淘宝目录名
   echo "<th>
	   <input type='hidden' name='data[cid]' value='".$item->cid."' />
	   <input type='hidden' name='data[nick]' value='".$item->name."' />
	   ".$item->cid."
	</th>";
   if($item->is_parent == 'true'){
 	echo "<th><a href='".$this->webroot."categories/add/".$item->cid."'>".$item->name."</th>";
   }
   else {
   	echo "<th><a style='color:#000'>".$item->name."</a></th>";
   }
   echo "<th>";
   echo "<select id='select$counter' style='display:none'>";
   echo "</select>";
   echo "</th>";
   //name 为我们的命名
   echo "<th><input style='width:200px' name='data[name]' value='".$item->name."' /></th>";
   echo "<th><input type='submit' value='添加' /></th>";
   echo "</form>";
   echo "<tr>";
   $counter++;
}
?>
</table>

<script type="text/javascript">
<!--
$("select[name='level']").change(function(){
	var form = $(this).parent().parent()[0].innerHTML;
	var select = "#"+$($(form)[8]).attr('id');
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
					var option = "<option value="+id+">"+name+"</option>"
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
