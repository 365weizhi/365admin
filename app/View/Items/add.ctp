<?php
$item = $item['Item'];
?>
<img src="<?php echo $item['pic_url']."_200x200.jpg";?>" alt="<?php echo $item['title'];?>" />
<form method="post">
<label>描述：</label>
<textarea name="description"></textarea>
<br/>
<br/>
<input type="submit" value="提交" />
</form>
