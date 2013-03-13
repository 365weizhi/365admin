<style>
	#search-list {overflow:hidden;*zoom:1;text-align:center;}
	#search-list p {margin:2px 0;}
	#search-list li {float:left;padding:5px;background: #F7F7F7;margin:0 10px 10px 0;list-style-type:none;color:#B3B3B3;}
	#search-list li a {display:block;cursor:pointer;}
	#search-list li img {height:120px;}
	#MessageBox{
		position: absolute;
		top: -50px;
		margin-left: 30%;
		height: 50px;
		width: 200px;
		background: #ccc;
		text-align: center;
		line-height: 40px;
		color: #fff;
		font-size: 25px;
	}
	.save{
	}
	.delete {
	}

</style>
<div id="MessageBox">
	添加成功
</div>

<ul id='search-list'>
<?php
	foreach($items as $item){
?>
	<li>
		<a href='<?php echo $item['Item']['click_url']; ?>'>
			<img src="<?php echo $item['Item']['pic_url'];?>" alt="<?php echo $item['Item']['title'];?>"/>
		</a>
		<p>
		    <span class="right"><?php echo $item['Item']['volume']; ?>件/30天</span>
		    <span><?php echo $item['Item']['commission']; ?></span> /
		    <span><?php echo $item['Item']['price'];?></span>
		</p>
		<p>
			<input name="description_<?php echo $item['Mitem']['id'];?>" value="<?php echo $item['Mitem']['description'];?>" style="width: 100%"/>
		</p>
		<p>
		  	<a id="<?php echo $item['Mitem']['id'];?>" class="btn save" style="display:inline">保存</a>
		  	<a id="<?php echo $item['Mitem']['id'];?>" class="btn delete" style="display:inline">删除</a>
	  	</p>
	</li>
<?php
    }
?>
</ul>
<script>
var webroot = '<?php echo $this->webroot;?>';
$(function(){
	function showMessage(message){
		$("#MessageBox").text(message);
		$("#MessageBox").animate({
			top: "0px",
		}, 500, function(){
			$("#MessageBox").animate({
				top: "-50px",
			}, 1000)
		});
	}
	
	$(".btn.save").click(function(){
		var description = $("input[name=description_"+this.id+"]").val();
		$.ajax({
			type: 'post',
			url: '',
			data: {
				id: this.id,
				description: description
			},
			success: function(data){
				if(data == "success"){
					showMessage("修改成功");
				}
				else {
					showMessage("修改失败");
				}
			}
		});
	});
});
</script>