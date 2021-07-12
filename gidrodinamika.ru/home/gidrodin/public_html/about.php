<?php
include("block/db.php");
include("block/filter_array_post_get_request.php");

$result	= mysqli_query($db,
	"SELECT
		meta_d,
		meta_k,
		title,
		text
	FROM
		settings
	WHERE
		page='about'");
		
$r		= mysqli_query($db,
	"SELECT
		title,
		text,
		cols,
		str
	FROM
		about");
		
$myrow	= mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang = "ru">

<head>
	<meta charset    = "UTF-8" />
	
	<meta content    = "IE = edge, chrome = 1"
	      http-equiv = "X-UA-Compatible"
	/>

	<meta content    = "<?php echo $myrow['meta_d'];?>"
		  lang       = "ru"
		  name       = "description" 
	/>
	<meta content    = "<?php echo $myrow['meta_k'];?>"
		  lang       = "ru"
		  name       = "keywords"
	/>
	
	<meta content    = "index, follow"
	      name       = "robots"
	/>
	
	<?php include("block/fixIE.php");?>
	
	<!-- Title -->
	<title><?php echo $myrow['title'];?></title>

	<script	type	= "text/javascript"
			src		= "js/slide-show_about.js">
	</script>
	
	<!-- Core Stylesheet -->
	<link href       = "css/style.css" 
		  media      = "screen"
		  rel        = "stylesheet"
		  type       = "text/css"
	/>
	<link href       = "css/spring.css"
		  media      = "screen"
		  rel        = "stylesheet"
		  type       = "text/css"
	/>
</head>


<body>

<div class = 'hold_admin' >
	<div class = 'navbar'>
		<a	class	= 'scroll_to_top'
			href	= '#top'
			title	= 'Вернуться к началу страницы'
		>
			<img src= "img/arrow_top_oval.png" />
		</a>
		
		<a	class	= 'scroll_return'
			href	= 'javascript:history.back()'
			title	= 'Вернуться обратно'
		>
			<img src = "img/arrow_return_oval.png" />
		</a>
	</div>
</div>

	<div id = "wrapper">

		<?php include("block/header.php");?>

		<div id = "header">
		
			<?php include("block/logo_search.php");?>
			
			<img	src		= "img/nav-arrow-top.png"
					alt		= "Active"
					id		= "arrow-top"
					class	= "arrow-about"
			/>
		</div>

		<div id = "main">
		
			<?php echo $myrow['text'];?>
		</div>

		<?php
		while(	$mr_text	= mysql_fetch_array($r))
		{
			if(	$mr_text['cols'] == 1)
			{
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
							<div id = 'img_box_left_sub'>
								<img alt   = 'Image'
									 class = 'subbotin boxed'
									 src   = 'img/subbotin_s_p.jpg'
								
								/>
								<p	class = 'post'>
									Генеральный директор,
									Главный конструкрор, к.т.н.
								</p>
								
								<p	class = 'subb'>
									Сергей Павлович Субботин
								</p>
							</div>
						-->

							$mr_text[text]
						</div>
					</div>
here;
			}
			
			if(	$mr_text['cols'] == 2)
			{
				if(	$mr_text['str'] == 1)
				{
					echo <<<here
						<div class = 'two-col separator'>
							<div class = 'col'>
								<h5 class = 'custom'>
									$mr_text[title]
								</h5>
								$mr_text[text]
							</div>
here;
				}
				else
				{
					echo <<<here
							<div class = "col last">
								<h5 class = "custom">
									$mr_text[title]
								</h5>
								$mr_text[text]
							</div>
						</div>
here;
				}
			}

			if(	$mr_text['cols'] == 3)
			{
				if(	$mr_text['str'] == 1)
				{
					echo <<<here
						<div class = 'three-col separator'>
							<div class = "col">
								<h5 class = "custom">
									$mr_text[title]
								</h5>
								$mr_text[text]
						</div>
here;
				}

				if(	$mr_text['str'] == 2)
				{
					echo <<<here
						<div class = "col">
							<h5 class = "custom">
								$mr_text[title]
							</h5>
							$mr_text[text]
						</div>
here;
				}

				if(	$mr_text['str'] == 3)
				{
					echo <<<here
							<div class = "col last">
								<h5 class = "custom">
									$mr_text[title]
								</h5>
								$mr_text[text]
							</div>
						</div>
here;
				}
			}

		}
		
		mysqli_close($db);
		?>

	</div>

</div>

<?php include("block/footer.php");?>

</body>

</html>