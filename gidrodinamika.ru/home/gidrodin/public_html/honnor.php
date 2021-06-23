<?php 
$set_var = array("a","hid_line_imager","hid_line","hid_line_finder");//for honnor.php
foreach($set_var as $key => $val){
	if(empty($$val)){
			$$val='';
		}
}
include("block/db.php");
include("block/filter_array_post_get_request.php");
	$dir="img/gallery_hor/";
	if(isset($_REQUEST['img'])){
			if(empty($_REQUEST['img'])){
					unset($_REQUEST['img']);
					$th="lic_MCHS.png";
					$ret_hon=0;
				}else{
					$th=mysql_real_escape_string(trim($_REQUEST['img']));
					$hid_line_imager="<input type='hidden' value='$th' name='img'>";
					$ret_hon=1;
				}
		}else{
			$th="lic_MCHS.png";
			$ret_hon=0;
		}
	include("block/db.php");
	$img=mysql_fetch_array(mysql_query("SELECT link_dir,file FROM honnor WHERE file='".mysql_real_escape_string($th)."'",$db));
	mysql_close($db);
	if(isset($_REQUEST['aa']) && is_numeric(trim($_REQUEST['aa']))){
			$a=intval(trim($_REQUEST['aa']));
			$hid_line_finder="<input type='hidden' value='$a' name='aa' id='aa'>";
			$ret_sort=1;
		}else{
			$ret_sort=0;
		} 
		switch($a){
			case 1:$find="WHERE file LIKE '%sert%'";break;
			case 2:$find="WHERE file LIKE '%lic%'";break;
			case 3:$find="WHERE file LIKE 'sv%'";break;
			case 4:$find="WHERE file LIKE '%razr%'";break;
			case 5:$find="WHERE file LIKE '%dip%'";break;
			case 6:$find="WHERE file LIKE '%patent%'";break;
			case 7:$find="";break;
			default:$find="";break;
			}?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
			<?php include("block/fixIE.php");?>
<title>Сертификаты</title>
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
		<img src="img/nav-arrow.png" alt="Active" id="arrow-bottom" class="arrow-honnor"/>
	</div>
<div id="main">
	<p class="section-title"><span class="title custom">Сертификаты</span><span class="desc">Ознакомительная страница</span></p>
<?php
echo <<<here
<ul id="filter_honnor">
	<li>ФИЛЬТР: </li>
	<li>
		<form class="fir_button" action="honnor.php" method="post">
			<input type="hidden" value="7" name="aa">
			$hid_line_imager
			<input type="submit" value="ВСЕ" name="send_finder">
		</form>
	</li>
	<li><form class="second_button" action="honnor.php" method="post">
			<input type="hidden" value="1" name="aa">
			$hid_line_imager
			<input type="submit" value="Сертификаты" name="send_finder">
		</form>
	</li>
	<li>
		<form class="other_button" action="honnor.php" method="post">
			<input type="hidden" value="2" name="aa">
			$hid_line_imager
			<input type="submit" value="Лицензии" name="send_finder">
		</form>
	</li>
	<li>
		<form class="other_button" action="honnor.php" method="post">
			<input type="hidden" value="3" name="aa">
			$hid_line_imager
			<input type="submit" value="Свидетельства" name="send_finder">
		</form>
	</li>
	<li>
		<form class="other_button" action="honnor.php" method="post">
			<input type="hidden" value="4" name="aa">
			$hid_line_imager
			<input type="submit" value="Разрешения" name="send_finder">
		</form>
	</li>
	<li>
		<form class="other_button" action="honnor.php" method="post">
			<input type="hidden" value="5" name="aa">
			$hid_line_imager
			<input type="submit" value="Димпломы" name="send_finder">
		</form>
	</li>
	<li>
		<form class="other_button" action="honnor.php" method="post">
			<input type="hidden" value="6" name="aa">
			$hid_line_imager
			<input type="submit" value="Патенты" name="send_finder">
		</form>
	</li>
</ul>
here;
		$src = "$dir"."$th";
echo <<<here
<div id='license'>
	<form id='border_non' action='honnor_single.php' method='post' target="_blank">
		<input type='hidden' value='$th' name='img'>
		<input type='image' src='$src' id='ones_img'>
	</form>
here;
//////////////////////////////////////////////////////////////////////////////////////
include("block/db.php");
$res_clean=mysql_query("TRUNCATE TABLE honnor",$db);mysql_close($db);
function excess($files){$result=array();for($i=0;$i<count($files);$i++){if($files[$i]!="."&&$files[$i]!=".."&&is_dir($files[$i])!=true)$result[]=$files[$i];}return $result;}
$files=scandir($dir);$files=excess($files);include("block/db.php");
$i=0;do{$res_add=mysql_query("INSERT INTO honnor (link_dir, file) VALUES ('$dir','".mysql_real_escape_string($files[$i])."')",$db);$i++;}while($i<count($files));
$result=mysql_query("SELECT link_dir,file FROM honnor $find",$db);
if($result==true){
//////////////////////////////////////////////////////////////////////////////////////
	if($ret_hon==0){
			for($i=0;$i<$myrow=mysql_fetch_array($result);$i++){
				$screen="$myrow[link_dir]"."$myrow[file]";
				echo "
	<form class='img_button' action='honnor.php' method='post'>
		".$hid_line_finder."
		<input type='hidden' value='".$myrow['file']."' name='img'>
		<input type='image' src='".$screen."' id='img'>
	</form>";
				if(($i+1) % 3==0){echo"<br>";}
			}
			mysql_close($db);
		}else{
			for($i=0;$i<$myrow=mysql_fetch_array($result);$i++){
				$screen="$myrow[link_dir]"."$myrow[file]";
				echo "
	<form class='img_button' action='honnor.php' method='post'>
		".$hid_line_finder."
		<input type='hidden' value='".$myrow['file']."' name='img'>
		<input type='image' src='".$screen."' id='img'>
	</form>";
				if(($i+1) % 3==0){echo"<br>";}
			}
			mysql_close($db);
		}
//////////////////////////////////////////////////////////////////////////////////
	}else{
//////////////////////////////////////////////////////////////////////////////////
		if($ret_hon==0){
				for($i=0;$i<count($files);$i++){
					$screen="$dir"."$files[$i]";
					echo "
	<form class='img_button' action='honnor.php' method='post'>
		".$hid_line_finder."
		<input type='hidden' value='".$files[$i]."' name='img'>
		<input type='image' src='".$screen."' id='img'>
	</form>";
					if(($i+1) % 3==0){echo"<br>";}
				}
				mysql_close($db);
			}else{
				for($i=0;$i<count($files);$i++){
					$screen="$dir"."$files[$i]";
					echo "
	<form class='img_button' action='honnor.php' method='post'>
		".$hid_line_finder."
		<input type='hidden' value='".$files[$i]."' name='img'>
		<input type='image' src='".$screen."' id='img'>
	</form>";
						if(($i+1) % 3==0){echo"<br>";}
				}
				mysql_close($db);
			}
///////////////////////////////////////////////////////////////////////////////////
	}
///////////////////////////////////////////////////////////////////////////////////
	?>
	</div>
</div>
</div>
<?php include("block/footer.php");?>
	</body>
</html>