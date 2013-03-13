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
			<input name="description_<?php echo $item['Item']['id'];?>" value="<?php echo $item['Item']['description'];?>" style="width: 100%"/>
		</p>
	  	<a id="<?php echo $item['Item']['id'];?>" class="btn" >添加到移动平台</a>
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
		}, 1000, function(){
			$("#MessageBox").animate({
				top: "-50px",
			}, 1000)
		});
	}
	
	$(".btn").click(function(){
		var description = $("input[name=description_"+this.id+"]").val();
		$.ajax({
			type: 'post',
			url: webroot+'mitems/add',
			data: {
				id: this.id,
				description: description
			},
			success: function(data){
				if(data == "success"){
					showMessage("添加成功");
				}
				else if (data == "failed"){
					showMessage("添加失败");
				}
				else {
					showMessage("已有该商品");
				}
			}
		});
	});
});
</script>