<!--
<ul class="nav nav-pills">
	<li><a href="<?php echo $this->webroot."categories/index/1"?>">一级目录</a><li>
	<li><a href="<?php echo $this->webroot."categories/index/2"?>">二级目录</a></li>
	<li class="active"><a href="<?php echo $this->webroot."categories/index/3"?>">三级目录</a></li>
</ul>
-->
<table>
	<thead>
	<tr>
		<th>
			编号
		</th>
		<th>
			淘宝目录名
		</th>
		<th>
			未知目录
		</th>
		<th>
			分享次数
		</th>
		<th>
			 喜欢次数
		</th>
		<th>
			商品数量
		</th>
		<th>
		</th>
		<th>
		</th>
		<th>
		</th>
	<tr>
	</thead>

<?php
//pr($parents);
foreach($categories as $_category){
//	pr($category['CategoryParent']);
	$category = $_category['Category'];
	echo "<tr>";
	echo "<form method='post' action=update>";
	/*
	echo "<th><select name='Category[category_parent_id]'>";
	//echo "<option value=".$_category['CategoryParent']['id']." selected>".$_category['CategoryParent']['name']."-".$_category['CategoryParent']['nick']."</option>"; 
	foreach($parents as $parent){
		if($parent['CategoryParent']['id'] == $_category['CategoryParent']['id']){
			echo "<option value=".$parent['CategoryParent']['id']." selected>".$parent['CategoryParent']['name']."-".$parent['CategoryParent']['nick']."</option>";
		}
		else 
			echo "<option value=".$parent['CategoryParent']['id'].">".$parent['CategoryParent']['name']."-".$parent['CategoryParent']['nick']."</option>";
	}
	echo "</th></select>";
	*/
	echo "<th>
		<input type='hidden' name='Category[id]' value='$category[id]' />
		<input type='hidden' name='Category[name]' value='$category[name]' />
		<label>$category[id]&nbsp;&nbsp;&nbsp;</label>
		</th>";
	echo "<th><input name='Category[nick]' value='$category[nick]'</input></th>";
	echo "<th><input name='Category[name]' value='$category[name]'</input></th>";
	echo "<th><input name='Category[favor_count]' value='$category[favor_count]'</input></th>";
	echo "<th><input name='Category[like_count]' value='$category[like_count]'</input></th>";
	echo "<th><input name='Category[son_count]' value='$category[son_count]'</input></th>";
	echo "<th><input type='submit' value='保存' /></th>";
	echo "<th><a href='".$this->webroot."categories/move/3/$category[id]'>移动</a><th>";
	echo "<th><a href='".$this->webroot."categories/delete/3/$category[id]'>删除</a></th>";
	echo "</form>";
	echo "<tr>";
}
?>
</table>
