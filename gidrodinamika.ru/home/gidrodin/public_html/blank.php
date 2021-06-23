<?php include("block/db.php");include("block/filter_array_post_get_request.php");$result=mysql_query("SELECT meta_d,meta_k,title,text FROM settings WHERE page='blank'",$db);$myrow=mysql_fetch_array($result);mysql_close($db);?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta name="description" content="<?php echo $myrow['meta_d'];?>">
		<meta name="keywords" content="<?php echo $myrow['meta_k'];?>">
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
			<?php include("block/fixIE.php");?>
<title><?php echo $myrow['title'];?></title>
			<link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
			<link rel="stylesheet" href="css/spring.css" type="text/css" media="screen"/>
	</head>
<body>
<div class='hold_admin' id='right_holder_admin'>
	<div class='navbar'>
		<a href='#top' class='scroll_to_top' title='Вернуться к началу страницы'><img src="img/arrow_top_oval.png"></a>
		<a href='javascript:history.back()' class='scroll_return' title='Вернуться обратно'><img src="img/arrow_return_oval.png"></a>
	</div>
</div>
<div id="wrapper">
	<?php include("block/header.php");?>
	<div id="header">
		<?php include("block/logo_search.php");?>
		<img src="img/nav-arrow.png" alt="Active" id="arrow-bottom" class="arrow-blank"/>
	</div>
	<?php echo $myrow['text'];?>
</div>
	<?php include("block/footer.php");?>
	</body>
</html>