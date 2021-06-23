<?php 
include("block/db.php");
include("block/filter_array_post_get_request.php");
if(isset($_REQUEST['rec'])&&!empty($_REQUEST['rec'])&&is_numeric($_REQUEST['rec'])){
		$id=intval(trim($_REQUEST['rec']));
		$set="WHERE id='".$id."'";
		$ret_rec=1;
	}else{
		unset($_REQUEST['rec']);
		$set="";
		$ret_rec=0;
	}
$res_rec=mysql_query("SELECT id,img,title,title_img,category,text FROM record ".$set,$db);?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
			<?php include("block/fixIE.php");?>
<title>Достижения</title>
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
		<img src="img/nav-arrow.png" alt="Active" id="arrow-bottom" class="arrow-record"/>
	</div>
<div id="main">
	<p class="section-title"><span class="title custom">Достижения</span><span class="desc">Наши достижения и разработки</span></p>
<?php
	if($ret_rec==0){
		for($i=0;$i<$myrow=mysql_fetch_array($res_rec);$i++){
			echo"
				<div id='rec_block'>
					<div class='thumb-rec'>
						<a href='record.php?rec=".$myrow['id']."'>
							<h2 class='value'>".$myrow['title_img']."</h2><img class='rec-img' src='".$myrow['img']."'>
						</a><span></span>
					</div>
					<p5 class='bgcol'>
					<div>".$myrow['category']."</div>
					".$myrow['title']."</p5>
					<span1></span1>
					<div class='brief'>
						".substr($myrow['text'],0,220)."
					</div>
					<span2></span2>
					<div id='nextlink'>
						<a href='record.php?rec=".$myrow['id']."' class='more'><strong>Далее</strong></a>
					</div>
				</div>";
			if(($i+1)%3==0){echo"<br>";}
			}
			mysql_close($db);
		}
		else{
			$myrow=mysql_fetch_array($res_rec);
			echo"
				<div id='rec_block_single'>
					<div class='thumb-rec'>
						<a href='javascript:history.back()'>
							<h2 class='value'>".$myrow['title_img']."</h2><img class='rec-img' src='".$myrow['img']."'>
						</a><span></span>
					</div>
					<p5 class='bgcol'>
						<div>".$myrow['category']."</div>
					".$myrow['title']."</p5>
					<span1></span1>
					<div class='brief'>
						".$myrow['text']."
					</div>
					<span2></span2>
					<div id='backlink_rec'>
						<a href='javascript:history.back()' class='more'><strong>Назад</strong></a>
					</div>
				</div>";
			mysql_close($db);
		}?>
	</div>
</div>
	<?php include("block/footer.php");?>
	</body>
</html>