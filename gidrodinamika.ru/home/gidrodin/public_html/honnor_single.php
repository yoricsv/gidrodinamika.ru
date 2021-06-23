<?php include("block/db.php");
include("block/filter_array_post_get_request.php");
	$dir="img/gallery_hor/";
	if(isset($_REQUEST['img'])){
			if(empty($_REQUEST['img'])){
					unset($_REQUEST['img']);
					$th="sert_iso.png";
				}else{
					$th=mysql_real_escape_string(trim($_REQUEST['img']));
					$img=mysql_fetch_array(mysql_query("SELECT * FROM honnor WHERE file = '".$th."'",$db));
					mysql_close($db);
					$th = $img['file'];
				}
		}else{
			if(isset($_REQUEST['prev'])){
					$prev=intval(trim($_REQUEST['prev']));
					$ret_count=mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM honnor",$db));
					if($prev==1){
							$prev=$ret_count[0];
						}else{
							$prev=$prev-1;
						}
					unset($ret_count);
					$ret_img=mysql_query("SELECT * FROM honnor WHERE id = '".$prev."'",$db);
					$img=mysql_fetch_array($ret_img);
					$th=$img['file'];
					mysql_close($db);
				}else{
					if(isset($_REQUEST['next'])){
							$next=intval(trim($_REQUEST['next']));
							$ret_count=mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM honnor",$db));
							if($next==$ret_count[0]){
									$next=1;
								}else{
									$next=$next+1;
								}
							unset($ret_count);
							$img=mysql_fetch_array(mysql_query("SELECT * FROM honnor WHERE id = '".$next."'",$db));
							mysql_close($db);
							$th=$img['file'];
						}else{
							$th="sert_iso.png";
							$img=mysql_fetch_array(mysql_query("SELECT * FROM honnor WHERE file = '".$th."'",$db));
							mysql_close($db);
						}
				}
		}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>Сертификаты</title>
			<link rel="stylesheet" href="css/style_single.css" type="text/css" media="screen" />
	</head>
<body>
<div id="single_image">



<div id="main">
	<p class="section-title"><span class="title custom">Сертификаты</span><span class="desc">Cтраница просмотра сертификатов</span></p>


<?php 

	$src = "$dir"."$th";
echo <<<here

<div id="slide">

	<ul id="hon_sin_img">
		<li><img src="$src"></li>
	</ul>

	<span></span>

	<form id='prev' action='honnor_single.php' method='post'>
		<input type='hidden' value='$img[id]' name='prev'>
		<input type='image' src="img/prev-slide.png" onMouseOver="this.src='img/prev-slide_hover.png'" onMouseOut="this.src='img/prev-slide.png'" id='ones_img'>
	</form>

	<form id='next' action='honnor_single.php' method='post'>
		<input type='hidden' value='$img[id]' name='next'>
		<input type='image' src="img/next-slide.png" onMouseOver="this.src='img/next-slide_hover.png'" onMouseOut="this.src='img/next-slide.png'" id='next'>
	</form>

</div>

here;

?>
	</div>
</div>
	</body>
</html>