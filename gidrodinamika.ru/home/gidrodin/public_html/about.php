<?php
include("block/db.php");
include("block/filter_array_post_get_request.php");
$result	= mysql_query(
				"SELECT
					meta_d,
					meta_k,
					title,
					text
				FROM
					settings
				WHERE
					page='about'"
		,$db);
$r		= mysql_query(
				"SELECT
					title,
					text,
					cols,
					str
				FROM
					about");
$myrow	= mysql_fetch_array($result);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta	name		= "description"
				content		= "<?php echo $myrow['meta_d'];?>"/>
		<meta	name		= "keywords"
				content		= "<?php echo $myrow['meta_k'];?>"/>
		<meta	http-equiv	= "Content-Type"
				content		= "text/html; charset=windows-1251"/>
<?php
		include("block/fixIE.php");
?>
		<title><?php echo $myrow['title'];?></title>
		<script	type	= "text/javascript"
				src		= "js/slide-show_about.js">
		</script>
		<link	rel		= "stylesheet"
				href	= "css/style.css"
				type	= "text/css"
				media	= "screen" />
		<link	rel		= "stylesheet"
				href	= "css/spring.css"
				type	= "text/css"
				media	= "screen" />
	</head>



	<body>

		<div class='hold_admin' >
			<div class='navbar'>
				<a	class	= 'scroll_to_top'
					href	= '#top'
					title	= 'Вернуться к началу страницы'>
					<img src= "img/arrow_top_oval.png">
				</a>
				<a	class	= 'scroll_return'
					href	= 'javascript:history.back()'
					title	= 'Вернуться обратно'>
					<img src="img/arrow_return_oval.png">
				</a>
			</div>
		</div>

		<div id="wrapper">
			<?php include("block/header.php");?>
			<div id="header">
				<?php include("block/logo_search.php");?>
				<img	src		= "img/nav-arrow-top.png"
						alt		= "Active"
						id		= "arrow-top"
						class	= "arrow-about"
				/>
			</div>

			<div id="main">
<?php
			echo $myrow['text'];
?>
			</div>
<?php
while(	$mr_text	= mysql_fetch_array($r)){
	if(	$mr_text['cols'] == 1){
		echo <<<here
			<div class	= "one-col separator">
				<div class	= "col">
					<h5 class	= "custom">
						<h4>
							<strong>
								$mr_text[title]
							</strong>
						</h4>
					</h5>
				<!--
					<div	id='img_box_left_sub'>
						<img	src='img/subbotin_s_p.jpg'
								alt='Image'
								class='subbotin boxed'
						/>
						<p	class='post'>
							Генеральный директор,
							Главный конструкрор, к.т.н.
						</p>
						<p	class='subb'>
							Сергей Павлович Субботин
						</p>
					</div>
				-->
					$mr_text[text]
				</div>
			</div>
here;
	}
	if(	$mr_text['cols'] == 2){
		if(	$mr_text['str'] == 1){
			echo <<<here
			<div class='two-col separator'>
				<div class='col'>
					<h5 class='custom'>
						$mr_text[title]
					</h5>
					$mr_text[text]
				</div>
here;
		}else{
			echo <<<here
			<div class="col last">
				<h5 class="custom">
					$mr_text[title]
				</h5>
				$mr_text[text]
			</div>
		</div>
here;
		}
	}
	if(	$mr_text['cols'] == 3){
		if(	$mr_text['str'] == 1){
			echo <<<here
			<div class='three-col separator'>
				<div class="col">
					<h5 class="custom">
						$mr_text[title]
					</h5>
					$mr_text[text]
			</div>
here;
		}
		if(	$mr_text['str'] == 2){
			echo <<<here
		<div class="col">
			<h5 class="custom">
				$mr_text[title]
			</h5>
			$mr_text[text]
		</div>
here;
		}
		if(	$mr_text['str'] == 3){
			echo <<<here
		<div class="col last">
			<h5 class="custom">
				$mr_text[title]
			</h5>
			$mr_text[text]
		</div>
	</div>
here;
		}
	}
}
mysql_close($db);
?>

			</div>
		</div>
<?php
	include("block/footer.php");
?>

	</body>
</html>