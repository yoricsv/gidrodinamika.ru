<?php include("block/db.php");include("block/filter_array_post_get_request.php");
$set_var = array("cat");//for news.php
foreach($set_var as $key => $val){
	if(empty($$val)){
			$$val='';
		}
}
if(isset($_REQUEST['cat'])){if(empty($_REQUEST['cat'])){unset($_REQUEST['cat']);}else{$cat=$_REQUEST['cat'];$cat=trim($cat);$ret_cat=1;}}else{$ret_cat=0;}switch($cat){case 1:$where="";break;case 2:$where="WHERE category LIKE '%роиз%'";break;case 3:$where="WHERE category LIKE '%ставки%'";break;case 4:$where="WHERE category LIKE '%азработк%'";break;case 5:$where="WHERE category LIKE '%мире%'";break;case 6:$where="WHERE category LIKE '%азное%'";break;case 7:$where="WHERE category LIKE '%рхивы%'";break;case 8:$where="WHERE date LIKE '%2014%'";break;default:$where="";break;}if(isset($_REQUEST['new'])){if(empty($_REQUEST['new'])){unset($_REQUEST['new']);}else{$id=$_REQUEST['new'];$ret_new=1;}}else{$ret_new=0;} $result=mysql_query("SELECT meta_d,meta_k,title,text FROM settings WHERE page='news'",$db); $myrow=mysql_fetch_array($result);?>
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
		<img src="img/nav-arrow-top.png" alt="Active" id="arrow-top" class="arrow-news"/>
	</div>
	<div id="main">
		<div id="posts">
		<?php
			if($ret_new==0){
				$res_news=mysql_query("SELECT id,title,source,author,category,img,text FROM news $where ORDER BY date DESC",$db);
				$myrow_news=mysql_fetch_array($res_news);
				do{
					echo"
						<div class='post'>
							<p class='post-title custom'>".$myrow_news['title']."</p>
							<p class='post-meta'>".$myrow_news['source']." <span> добавил(автор): ".$myrow_news['author']."</span> категория: ".$myrow_news['category']."</p>
							<div class='post-img'>
								<a href='news.php?new=".$myrow_news['id']."'><img src='".$myrow_news['img']."' width='621px'/></a>
								<span></span>
							</div>
							<div class='brief'>
								".substr($myrow_news['text'],0,220)."... »»»
							</div>
								<a href='news.php?new=".$myrow_news['id']."' class='more'>Больше</a>
						</div>";
				}
				while($myrow_news = mysql_fetch_array($res_news));
				mysql_close($db);
			}
				else
				{
				$res_news=mysql_query("SELECT id,title,source,author,category,img,text,faces FROM news WHERE id='$id'",$db);
				$myrow_news=mysql_fetch_array($res_news);
				do{
					$faces=$myrow_news['faces'];
					echo"
						<div class='post'>
							<p class='post-title custom'>".$myrow_news['title']."</p>
							<p class='post-meta'>".$myrow_news['source']." <span> добавил(автор): ".$myrow_news['author']."</span> категория: ".$myrow_news['category']."</p>
							<div class='post-img'>
								<a href='javascript:history.back()'><img src='".$myrow_news['img']."' width='621px'/></a>
								<span></span>
							</div>
							<div class='brief'>
								".$myrow_news['text']."
							</div>
							<div id='backlink'>
								<a href='javascript:history.back()'>Назад</a>
							</div>
						</div>";
				}
				while($myrow_news=mysql_fetch_array($res_news));
				mysql_close($db);
			}
		/*<ul class="blog-pager">
				<li><a href="#">Следующее</a></li>
				<li><a href="#">Предыдущее</a></li>
			</ul>*/
		?>
		</div>
		<div id="sidebar">
			<?php include("block/menu_old_news.php");?>
			<?php if(isset($id)){include('block/for_article.php');}?>
		</div>
	</div>
</div>
	<?php include("block/footer.php");?>
	</body>
</html>