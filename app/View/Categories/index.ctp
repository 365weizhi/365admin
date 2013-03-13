<ul class="nav nav-pills">
	<li class="active"><a href="index/1">一级目录</a><li>
	<li><a href="index/2">二级目录</a></li>
	<li><a href="index/3">三级目录</a></li>
</ul>

<table>
	<thead>
	<tr>
		<th>
			淘宝目录名
		</th>
		<th>
			编号
		</th>
		<th>
			显示名
		</th>
		<th>
			分享次数
		</th>
		<th>
			 喜欢次数
		</th>
		<th>
		  	 添加
		</th>
		<th>
			删除
		</th>
	<tr>
	</thead>

<?php
foreach($categories as $category){
	$category = $category['Category'];
	echo "<tr>";
	echo "<form method='post' action=update>";
	echo "<th>
		<input type='hidden' name='Category[id]' value='$category[id]' />
		<input type='hidden' name='Category[name]' value='$category[name]' />
		$category[id]
		</th>";
	echo "<th>".$category['nick']."</th>";
	echo "<th><input name='Category[name]' value='$category[name]'</input></th>";
	echo "<th><input name='Category[favor_count]' value='$category[favor_count]'</input></th>";
	echo "<th><input name='Category[like_count]' value='$category[like_count]'</input></th>";
	echo "<th><input type='submit' value='更新' /></th>";
	echo "<th><a href='".$this->webroot."/categories/delete/$category[id]'>删除</a></th>";
	echo "</form>";
	echo "<tr>";
}
?>
</table>
