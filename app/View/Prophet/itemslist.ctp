<style>
        #search-list {overflow:hidden;*zoom:1;}
        #search-list p {margin:2px 0;}
        #search-list li {float:left;padding:5px;background: #F7F7F7;margin:0 10px 10px 0;list-style-type:none;color:#B3B3B3;}
        #search-list li a {display:block;cursor:pointer;}
        #search-list li img {height:200px;}
</style>

<?php

echo "<ul id='search-list'>";
if(sizeof($data) <= 0){
        echo '没有找到条目，请修改关键词或者类别。';
} else {
        foreach($data as $taobaoke_item){
?>
        <li>
	<a href="<?php echo $taobaoke_item['Item']['click_url'];?>">
        <img src="<?php echo $taobaoke_item['Item']['pic_url'];?>" alt="<?php echo $taobaoke_item['Item']['title'];?>"/>
	</a>
        <p>
            <span class="right">
		<a href="<?php echo $taobaoke_item['Item']['shop_click_url']; ?>">
		<?php echo $taobaoke_item['Item']['nick']; ?>
		</a>
	    </span>
            <span><?php echo $taobaoke_item['Item']['item_location']; ?></span> /
            <span><?php echo $taobaoke_item['Item']['price'];?>RMB</span>
        </p>
        </li>
<?php
    }
}
echo "</ul>";
?>

