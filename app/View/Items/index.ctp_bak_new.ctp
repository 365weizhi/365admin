<style>
	#search-list {overflow:hidden;*zoom:1;}
	#search-list p {margin:2px 0;}
	#search-list li {float:left;padding:5px;background: #F7F7F7;margin:0 10px 10px 0;list-style-type:none;color:#B3B3B3;}
	#search-list li a {display:block;cursor:pointer;}
	#search-list li img {height:120px;}
</style>

<ul id='search-list'>
<?php
	foreach($items as $item){
?>
	<li>
	<a href='<?php echo $item['Item']['click_url']; ?>'>
		<img src="<?php echo $item['Item']['pic_url'];?>" alt="<?php echo $item['Item']['title'];?>"/>
	</a>
	<p>
	    <span><?php echo $item['Item']['price'];?></span>
	</p>
	<form method="post" action="<?php echo $this->webroot."items/edit";?>">
		<p>
			<input type="hidden" name="Item[id]" value=<?php echo $item['Item']['id'];?> />
			<select name="Item[content_id]" style="margin: 0">
				<?php 
				foreach($categories as $category){
					$category = $category['Category'];
					if($category['id'] == $item['Item']['content_id'])
						echo "<option selected value='".$category['id']."'>".$category['name']."</option>";
					else 
						echo "<option value='".$category['id']."'>".$category['name']."</option>";	
				}
				?>
			</select> 
			<br>
			<input name="Item[description]" value="<?php echo $item['Item']['description'];?>" />
		    <input type="submit" value="保存" />
		</p>
	</form>
	</li>
<?php
    }
?>
</ul>
