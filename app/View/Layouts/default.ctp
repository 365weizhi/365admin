<?php
	$cakeDescription = __d('cake_dev', '365未知树 - 国内领先教育导购平台');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		//echo $this->Html->css('cake.generic');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('zero');
		echo $this->Html->css('loiter');
		echo $this->Html->css('rebot');
		echo $this->Html->css('animate.min');
		//echo $this->Html->css('taobao');
		
       	echo $this->Html->script('jquery-1.8.3.min');
        echo $this->Html->script('jquery.masonry.min');
        echo $this->Html->script('bootstrap.min');
		//echo $this->Html->script('zero');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div class="navbar">
      	<div id="header"><?php echo $this->Html->link($cakeDescription, 'http://localhost/365wzs'); ?></div>
    </div>
	
	<?php echo $this->Session->flash(); ?>
	<div id="left">
	  <ul class="nav nav-list">
	  	<li class="nav-header">商品管理</li>
	  	<li><a href="<?php echo $this->webroot."depots/index";?>">商品池</a></li>
	  	<li><a href="<?php echo $this->webroot."items/multiple"?>">批量添加</a></li>
	  	<li><a href="<?php echo $this->webroot."items";?>">首页商品</a></li>
	  	<li><a href="<?php echo $this->webroot."items/add"?>">添加商品</a></li>
	  	<li><a href="<?php echo $this->webroot."items/search"?>">搜索商品</a></li>
	  	<li><a href="#">用户晒单</a></li>
	  	<li class="nav-header">马甲管理</li>
	  	<li><a href="<?php echo $this->webroot."rebots/index";?>">管理马甲</a></li>
	  	<li><a href="<?php echo $this->webroot."rebots/add";?>">添加马甲</a></li>
	  	<li class="nav-header">移动平台</li>
	  	<li><a href="<?php echo $this->webroot."mitems/index";?>">管理商品</a></li>
	  	<li><a href="<?php echo $this->webroot."mitems/add";?>">添加商品</a></li>
		<li class="nav-header">专刊管理</li>
		<li><a href="<?php echo $this->webroot."";?>">管理专刊</a></li>
		<li><a href="<?php echo $this->webroot."categories/add";?>">添加专刊</a></li>
		<li><a href="<?php echo $this->webroot."categories";?>">未知专刊</a></li>
		<li><a href="#">分享专刊</a></li>
	  </ul>
    </div>
    <div id="right">
		<?php echo $this->fetch('content'); ?>
    </div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
