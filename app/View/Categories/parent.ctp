<ul class="nav nav-pills">
	<li><a href="<?php echo $this->webroot."categories/index/1"?>">一级目录</a><li>
	<li class="active"><a href="<?php echo $this->webroot."categories/index/2"?>">二级目录</a></li>
	<li><a href="<?php echo $this->webroot."categories/index/3"?>">三级目录</a></li>
</ul>

<table>
	<thead>
	<tr>
		<th>
			父目录
		</th>
		<th>
			淘宝目录编号
		</th>
		<th>
			淘宝目录名
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
	echo "<tr>";
	echo "<form method='post' action=".$this->webroot."categories/update>";
	echo "<th><select name='CategoryParent[category_ancestor_id]'>";
	echo "<option value=".$category['CategoryAncestor']['id']." selected>".$category['CategoryAncestor']['name']."</option>"; 
	foreach($ancestors as $ancestor){
		if($ancestor['CategoryAncestor']['id'] == $category['CategoryAncestor']['id'])
			continue;
		echo "<option value=".$ancestor['CategoryAncestor']['id'].">".$ancestor['CategoryAncestor']['name']."</option>";
	}
	echo "</th></select>";
	echo "<th>
		<input type='hidden' name='type' value='2' />
		<input type='hidden' name='CategoryParent[id]' value='".$category['CategoryParent']['id']."' />
		<input type='hidden' name='CategoryParent[name]' value='".$category['CategoryParent']['name']."' />
		<input name='CategoryParent[cid]' value='".$category['CategoryParent']['cid']."' />
		</th>";
	echo "<th><input name='CategoryParent[nick]' value='".$category['CategoryParent']['nick']."'</input></th>";
	echo "<th><input name='CategoryParent[name]' value='".$category['CategoryParent']['name']."'</input></th>";
	echo "<th><input name='CategoryParent[son_count]' value='".$category['CategoryParent']['son_count']."'</input></th>";
	echo "<th><input name='CategoryParent[favor_count]' value='".$category['CategoryParent']['favor_count']."'</input></th>";
	echo "<th><input name='CategoryParent[like_count]' value='".$category['CategoryParent']['like_count']."'</input></th>";
	echo "<th><input type='submit' value='保存' /></th>";
	echo "<th><a href='".$this->webroot."categories/move/2/".$category['CategoryParent']['id']."'>移动</a><th>";
	echo "<th><a href='".$this->webroot."categories/delete/2/".$category['CategoryParent']['id']."'>删除</a></th>";
	echo "</form>";
	echo "<tr>";
}
?>
</table>
