<label>请输入商品num_iid</label>
<form method="post">
	<input name="num_iid" />
	<select name="content_id" style="margin: 0">
	</select> 
	<label>描述：</label>
	<textarea name="description"></textarea>
	<br/>
	<br/>
	<input type="submit" value="提交" />
</form>

<script type="text/javascript">
$.ajax({
	type:'get',//可选get
	url: '/365admin/categories/categories/',
	success: function(msg){
		var arr = eval(msg);
		$(arr).each(function(index){
			var name = arr[index].Category.name;
			var id = arr[index].Category.id;
			var option = "<option value="+id+">"+name+"</option>"
			$("select").append(option);
		});
	},
	error:function(){
	}
});
</script>