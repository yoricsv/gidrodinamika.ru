<?php
define ('GET_ACCESS_TO_DB', true);
include("block/db.php");
include("block/filter_array_post_get_request.php");


if(	!isset($_REQUEST['new']))
	$ret_ind = 0;
else
{
	if(   !is_numeric($_REQUEST['new'])      
	   ||  empty     ($_REQUEST['new']))
	{
		unset($_REQUEST['new']);
	}
	else
	{
		$id		 = intval($_REQUEST['new']);
		$ret_ind = 1;
	}
}


$query = mysqli_query($db,
	"SELECT
		meta_d,
		meta_k,
		title,
		text
	FROM
		settings
	WHERE
		page = 'index'"
);

$myrow = mysqli_fetch_array($query);
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
	
	<!-- JS Slideshow -->
	<script	type	= "text/javascript"
			src		= "js/slide-show.js"
	>
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
	<div class = 'navbar' >
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
			 class = "arrow-index"
			 id    = "arrow-top"
			 src   = "img/nav-arrow-top.png"
		/>
	</div>

	<div id = "main">
	
    <?php
	if( $ret_ind == 0)
	{
		$onMouseOut_prev	= "this.src = 'img/prev-slide.png'";
		$onMouseOver_prev	= "this.src = 'img/prev-slide_hover.png'";
		
		$onMouseOut_next	= "this.src = 'img/next-slide.png'";
		$onMouseOver_next	= "this.src = 'img/next-slide_hover.png'";
		
		echo <<<here

			<!-- Slideshow -->
			<div id = 'slideshow'>
				<ul id = 'slides'>
					<li>
						<img alt  = 'Imagen'
							 name = 'slide_show'
							 src  = 'slides/05.jpg' 
						/>
					</li>
				</ul>

				<span></span>

				<a href = 'javascript:chgImg(-1)'>
					<img alt 		 = 'Prev'
						 id 		 = 'prev'
						 onMouseOut	 = '$onMouseOut_prev'
						 onMouseOver = '$onMouseOver_prev'
						 src		 = 'img/prev-slide.png'
					/>
				</a>
				
				<a href = 'javascript:chgImg(1)'>
					<img alt		 = 'Next'
						 id			 = 'next'
						 onMouseOut	 = '$onMouseOut_next'
						 onMouseOver = '$onMouseOver_next'
						 src		 = 'img/next-slide.png'
					/>
				</a>
				
				<script type = 'text/javascript'>
					auto();
				</script>
			</div>
			<!-- Slideshow END -->
here;
			

// Change theme like WordPress (If I ever do this !!!!)
//		echo
//			"<p class = 'custom excerpt'>
//				Ваше персональное оформление : 
//				<a href = '../spring/'>
//					Светлое
//				</a>,
//				
//				<a href = '../summer/'>
//					Желтое
//				</a>,
//				
//				<a href = '../autumn/'>
//					Оранжевое
//				</a>
//					, и 
//				<a href = '../winter/'>
//					Синее. 
//				</a>
//			</p>";
// Change theme END




// --- WELCOME BANNER ---

		$d	=	"com.txt";

/*/ 	Code below need for edit com.txt online

		if(	$_POST['sett']	== "Добавить строку")
		{
			if(	empty($_POST['tt']))
			{
				echo
					"<a href = ".$_SERVER['PHP_SELF'].">
						Назад
					</a> 
					« ";

				exit("You haven't entered data.");
			}
			
			$tt = htmlspecialchars($_POST['tt']);
			$fd = fopen($d, "w");
			
			if(	!$fd)
				exit("Не могу открыть файл. Ошибка");
			
			fwrite($fd, $tt);
			fclose($fd);
			
			$yes = "Data added successfully.";
		}
// Code above need for edit com.txt online --	*/

		if(	file_exists($d))
		{
			$arr = file($d);
			
			echo <<<here

			<marquee behavior	  = "alternate"
					 class		  = "marq"
					 height		  = "35"
					 scrollamount = "2"
					 width		  = "90%"
			>
				$arr[0]
			</marquee>
				
here;
		}
// --- WELCOME BANNER END ---
	

		include("block/db.php");
		
		$result_d = mysqli_query($db,
			"SELECT
				id,
				img_d,
				title_d,
				m_kd,
				m_dd
			FROM
				main_ind"
		);
		$myrow_d = mysqli_fetch_array($result_d);
		
		echo "<div class = 'holder'>";
			
		do
		{
			echo
				"<div class = 'block'>
					<div class = 'small-block'>
						<a href = 'index.php?new=".$myrow_d['id']."'>
							<img class = 'small'
								 src   = '".$myrow_d['img_d']."'
							/>
						</a>
					</div>
					
					<span></span>
					
					<h2 class = 'custom'>
						<a href = 'index.php?new=".$myrow_d['id']."'>
							".$myrow_d['title_d']."
						</a>
					</h2>
					
					<h5 class = 'custom'>
						<a href = 'index.php?new=".$myrow_d['id']."'>
							".$myrow_d['m_kd']."
						</a>
					</h5>
					
					<p class = 'index-text'>
						".$myrow_d['m_dd']."
					</p>
					
					<p>
						<a class = 'more'
						   href  = 'index.php?new=".$myrow_d['id']."'
						>
							Далее
						</a>
					</p>
				</div>";
		}
		while( $myrow_d = mysqli_fetch_array($result_d));
						  mysqli_close($db);

		echo "</div>";

	}
	else
	{
		include("block/db.php");

		$result_d = mysqli_query($db,
			"SELECT
				id,
				img_d,
				title_d,
				text
			FROM
				main_ind
			WHERE
				id = '$id'"
		);
		$myrow_d = mysqli_fetch_array($result_d);

		$onclick = "this.href = 'javascript:history.back()'";
		
		do
		{
			echo
				"<div id = 'rec_block_single'>
					<div class = 'thumb-rec'>
						<a	href	= 'Вернуться обратно'
							onclick	= '$onclick'
							title	= 'Вернуться обратно'
						>
							<img class = 'rec-img'
								 src   = '".$myrow_d['img_d']."'
							/>
						</a>
						<span></span>
					</div>
					
					<p5 class = 'bgcol'>
						<h2>
							".$myrow_d['title_d']."
						</h2>
					</p5>
					<span1></span1>
					
					<div class = 'brief'>
						".$myrow_d['text']."
					</div>
					<span2></span2>
					
					<div id = 'backlink_rec'>
						<a	class	= 'more'
							href	= 'Вернуться обратно'
							onclick	= '$onclick'
							title	= 'Вернуться обратно'
						>
							<strong>
								Назад
							</strong>
						</a>
					</div>
				</div>";
		}
		while($myrow_d = mysqli_fetch_array($result_d));
						 mysqli_close($db);
	}
	?>
	</div>
</div>

<?php include("block/footer.php");?>

</body>

</html>