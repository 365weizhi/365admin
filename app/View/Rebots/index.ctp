<table class="table table-condensed table-hover">
	<thead>
		<tr>
			<th>马甲名</th>
			<th>喜欢</th>
			<th>分享</th>
			<th>专刊</th>
			
			<th>关注数量</th>
			<th>粉丝数量</th>
			<th>评论数量</th>
			
			<th>被分享数量</th>
			<th>专刊内容</th>
		</tr>
	</thead>
	<tbody>
<?php 
	pr($rebots);
	foreach($rebots as $rebot){
?>
		<tr>
			<td><?php echo $rebot['User']['username']?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
<?php 
	}
?>
	</tbody>
</table>
