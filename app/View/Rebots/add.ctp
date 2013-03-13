<?php 
	if(isset($success)){
?>	
	<div id="rebot-message" class="alert alert-block">
	  <h4>添加成功，<?php echo $success;?>个未完成.</h4>
	</div>
	<script>
	$("#rebot-message").addClass("animated fadeOut");
	setTimeout(function(){
		$("#rebot-message").hide();
	}, 500);
	</script>
<?php 
	}
?>

<form method="post">
<h3>批量添加机器人</h3>
<textarea name="names" class="rebot-add" placeHolder="输入类似：netfly 回车分隔"></textarea>
<br>
<input type="submit" class="btn success-btn" value="确定"/>
</form>
<?php
