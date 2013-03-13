<ul class="nav nav-pills">
	<li class="active"><a href="<?php echo $this->webroot."categories/index/1"?>">一级目录</a><li>
	<li><a href="<?php echo $this->webroot."categories/index/2"?>">二级目录</a></li>
	<li><a href="<?php echo $this->webroot."categories/index/3"?>">三级目录</a></li>
</ul>

<table>
	<thead>
	<tr>
		<th>
			淘宝目录ID
		</th>
		<th>
			淘宝目录
		</th>
		<th>
			未知目录
		</th>
		<th>
			子目录数
		</th>
		<th>
			分享次数
		</th>
		<th>
			 喜欢次数
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
foreach($categories as $category){
	$category = $category['CategoryAncestor'];
	echo "<tr>";
	echo "<form method='post' action=".$this->webroot."categories/update>";
	echo "<th>
		<input type='hidden' name='type' value='1' />
		<input type='hidden' name='CategoryAncestor[id]' value='$category[id]' />
		<input type='hidden' name='CategoryAncestor[name]' value='$category[name]' />
		<input name='CategoryAncestor[cid]' value='$category[cid]' />
		</th>";
	echo "<th><input name='CategoryAncestor[nick]' value='".$category['nick']."'</input></th>";
	echo "<th><input name='CategoryAncestor[name]' value='$category[name]'</input></th>";
	echo "<th><input name='CategoryAncestor[son_count]' value='$category[son_count]'</input></th>";
	echo "<th><input name='CategoryAncestor[favor_count]' value='$category[favor_count]'</input></th>";
	echo "<th><input name='CategoryAncestor[like_count]' value='$category[like_count]'</input></th>";
	echo "<th><input type='submit' value='保存' /></th>";
	echo "<th><a href='".$this->webroot."categories/move/1/$category[id]'>移动</a><th>";
	echo "<th><a href='".$this->webroot."categories/delete/1/$category[id]'>删除</a></th>";
	echo "</form>";
	echo "<tr>";
}
?>
</table>
