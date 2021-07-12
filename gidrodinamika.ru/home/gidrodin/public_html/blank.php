<?php
include("block/db.php");
include("block/filter_array_post_get_request.php");

$result = mysqli_query($db,
	"SELECT
		meta_d,
		meta_k,
		title,
		text
	FROM
		settings
	WHERE
		page='blank'"
);

$myrow = mysqli_fetch_array($result);
		 mysqli_close($db);
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

<div class = 'hold_admin' 
	 id    = 'right_holder_admin'
>
	<div class = 'navbar'>
		<a class = 'scroll_to_top'
		   href  = '#top'
		   title = 'Вернуться к началу страницы'
		>
			<img src = "img/arrow_top_oval.png" />
		</a>
		
		<a class = 'scroll_return'
		   href  = 'javascript:history.back()'
		   title = 'Вернуться обратно'
		>
			<img src = "img/arrow_return_oval.png" />
		</a>
	</div>
</div>

<div id = "wrapper">

	<?php include("block/header.php");?>
	
	<div id = "header">
	
		<?php include("block/logo_search.php");?>
		
		<img alt   = "Active"
			 class = "arrow-blank"
			 id    = "arrow-bottom"
			 src   = "img/nav-arrow.png"
		/>
	</div>
	
	<?php echo $myrow['text'];?>
	
</div>

<?php include("block/footer.php");?>
	
</body>

</html>