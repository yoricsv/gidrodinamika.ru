<?php
include("block/db.php");
include("block/filter_array_post_get_request.php");

$set_var = array("cat");//for news.php

foreach($set_var as $key => $val)
{
	if( empty($$val))
	{
		$$val = '';
	}
}

if( !isset($_REQUEST['cat']))
	$ret_cat = 0;
else
{
	if( empty($_REQUEST['cat']))
		unset($_REQUEST['cat']);
	else
	{
		$cat     = $_REQUEST['cat'];
		$cat     = trim($cat);
		$ret_cat = 1;
	}
}

switch($cat)
{
	case 1:
		$where = "";
		break;
		
	case 2:
		$where = 
			"WHERE
				category
			LIKE
				'%роиз%'";
		break;
		
	case 3:
		$where = 
			"WHERE
				category
			LIKE
				'%ставки%'";
		break;
		
	case 4:
		$where = 
			"WHERE
				category
			LIKE
				'%азработк%'";
		break;
		
	case 5:
		$where = 
			"WHERE
				category
			LIKE
				'%мире%'";
		break;
		
	case 6:
		$where =
			"WHERE
				category
			LIKE
				'%азное%'";
		break;
		
	case 7:
		$where = 
			"WHERE
				category
			LIKE
				'%рхивы%'";
		break;
	
	case 8:
		$where =
			"WHERE
				date
			LIKE
				'%2014%'";
		break;
		
	default:
		$where = "";
		break;
}

if( !isset($_REQUEST['new']))
	$ret_new = 0;
else
{
	if( empty($_REQUEST['new']))
		unset($_REQUEST['new']);
	else
	{
		$id      = $_REQUEST['new'];
		$ret_new = 1;
	}
}

$result = mysqli_query($db,
	"SELECT
		meta_d,
		meta_k,
		title,
		text
	FROM
		settings
	WHERE
		page = 'news'");

$myrow = mysqli_fetch_array($result);
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
			 class = "arrow-news"
			 id    = "arrow-top"
			 src   = "img/nav-arrow-top.png"
		/>
	</div>
	
	<div id = "main">
		<div id = "posts">
		
		<?php
		if( $ret_new == 0)
		{
			$res_news = mysqlI_query($db,
				"SELECT
					id,
					title,
					source,
					author,
					category,
					img,
					text
				FROM
					news
				$where
				ORDER BY
					date DESC");
					
			$myrow_news = mysqlI_fetch_array($res_news);
			
			do
			{
				echo
					"<div class = 'post'>
						<p class = 'post-title custom'>
							".$myrow_news['title']."
						</p>
						
						<p class = 'post-meta'>
							".$myrow_news['source']."
							<span>
								 добавил(автор): 
								 ".$myrow_news['author']."
							</span>
							 категория: 
							 ".$myrow_news['category']."
						</p>
						
						<div class = 'post-img'>
							<a href = 'news.php?new=".$myrow_news['id']."'>
								<img src   = '".$myrow_news['img']."'
									 width = '621px'
								/>
							</a>
							<span></span>
						</div>
						
						<div class = 'brief'>
							".substr($myrow_news['text'], 0, 220)."
							... »»»
						</div>
						
						<a class = 'more'
						   href  = 'news.php?new=".$myrow_news['id']."'
						>
							Больше
						</a>
					</div>";
			}
			while( $myrow_news = mysqli_fetch_array($res_news));
			
			mysqli_close($db);
		
		}
		else
		{
			$res_news = mysqli_query($db,
				"SELECT
					id,
					title,
					source,
					author,
					category,
					img,
					text,
					faces
				FROM
					news
				WHERE
					id = '$id'",);
					
			$myrow_news = mysql_fetch_array($res_news);
			
			do
			{
				$faces = $myrow_news['faces'];
				
				echo
					"<div class = 'post'>
						<p class = 'post-title custom'>
							".$myrow_news['title']."
						</p>
						
						<p class = 'post-meta'>
							".$myrow_news['source']."
							<span> 
								 добавил(автор): 
								 ".$myrow_news['author']."
							</span>
							 категория: 
							 ".$myrow_news['category']."
						</p>
						
						<div class = 'post-img'>
							<a href = 'javascript:history.back()'>
								<img src   = '".$myrow_news['img']."'
									 width = '621px'
								/>
							</a>
							<span></span>
						</div>
						
						<div class = 'brief'>
							".$myrow_news['text']."
						</div>
						<div id = 'backlink'>
							<a href = 'javascript:history.back()'>
								Назад
							</a>
						</div>
					</div>";
			}
			while( $myrow_news = mysqli_fetch_array($res_news));
			
			mysqli_close($db);
		}
		
		/*<ul class = "blog-pager">
				<li>
					<a href = "#">
						Следующее
					</a>
				</li>
				
				<li>
					<a href = "#">
						Предыдущее
					</a>
				</li>
			</ul>*/
		?>
		
		</div>
		
		<div id = "sidebar">

			<?php include("block/menu_old_news.php");?>
			
			<?php 
			if( isset($id))
				include('block/for_article.php');
			?>
		</div>

	</div>

</div>

<?php include("block/footer.php");?>

</body>

</html>