<?php
include("block/db.php");
include("block/filter_array_post_get_request.php");
if(	isset($_REQUEST['new'])){
	if(		empty($_REQUEST['new'])
		||	!is_numeric(
				trim($_REQUEST['new'])
			)
		){
		unset($_REQUEST['new']);
	}else{
		$id			= intval(
						trim($_REQUEST['new'])
					);
		$ret_ind	= 1;
	}
}else{
	$ret_ind	= 0;
}
$myrow =	mysqli_fetch_array(
				mysqli_query($db,
					"SELECT
						meta_d,
						meta_k,
						title,
						text
					FROM
						settings
					WHERE
						page='index'"
				)
			);
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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

	<head>
		<meta	name		= "description"
				content		= "<?php echo $myrow['meta_d'];?>"/>
		<meta	name		= "keywords"
				content		= "<?php echo $myrow['meta_k'];?>"/>
		<meta	http-equiv	= "Content-Type"
				content		= "text/html; charset=windows-1251"/>
		<?php include("block/fixIE.php");?>
		<title><?php echo $myrow['title'];?></title>
		<script	type	= "text/javascript"
				src		= "js/slide-show.js">
		</script>
		<link	rel		= "stylesheet"
				href	= "css/style.css"
				type	= "text/css"
				media	= "screen"
		/>
		<link	rel		= "stylesheet"
				href	= "css/spring.css"
				type	= "text/css"
				media	= "screen"
		/>
	</head>



	<body>

		<div class='hold_admin' >
			<div class='navbar'>
				<a	class	= 'scroll_to_top'
					href	= '#top'
					title	= '��������� � ������ ��������'>
					<img src= "img/arrow_top_oval.png">
				</a>
				<a	class	= 'scroll_return'
					href	= 'javascript:history.back()'
					title	= '��������� �������'>
					<img src="img/arrow_return_oval.png">
				</a>
			</div>
		</div>

		<div id="wrapper">
			<?php include("block/header.php");?>
			<div id="header">
				<?php include("block/logo_search.php");?>
				<img	id="arrow-top"
						class="arrow-index"
						src="img/nav-arrow-top.png"
						alt="Active"
				/>
			</div>


			<div id="main">
<?php
	if($ret_ind == 0){
		$onMouseOut_prev	= "this.src='img/prev-slide.png'";
		$onMouseOver_prev	= "this.src='img/prev-slide_hover.png'";
		$onMouseOut_next	= "this.src='img/next-slide.png'";
		$onMouseOver_next	= "this.src='img/next-slide_hover.png'";
		echo	"
<!-- *************** Slideshow **************** -->
				<div id='slideshow'>
					<ul id='slides'>
						<li>
							<img name='slide_show' src='slides/05.jpg' alt='Imagen'>
						</li>
					</ul>
					<span></span>

					<a href='javascript:chgImg(-1)'>
						<img	id	= 'prev'
								src	= 'img/prev-slide.png'
								onMouseOut	= '$onMouseOut_prev'
								onMouseOver	= '$onMouseOver_prev'
								alt	= 'Prev'
						/>
					</a>
					<a href='javascript:chgImg(1)'>
						<img	id	= 'next'
								src	= 'img/next-slide.png'
								onMouseOut	= '$onMouseOut_next'
								onMouseOver	= '$onMouseOver_next'
								alt	= 'Next'
						/>
					</a>
					<script type='text/javascript'> auto(); </script>

				</div>
<!-- *************** END Slideshow **************** -->
			";
			
//���� ����������� ������ ����� �������
//		echo $myrow['text']; 
//������� ���� � ��� ��������, ���� �� �������� �� ����

//Choose theme (If I do it)
//		echo"
//				<p class='custom excerpt'>
//					���� ������������ ���������� : 
//					<a href='../spring/'>
//						�������
//					</a>,
//					<a href='../summer/'>
//						������
//					</a>,
//					<a href='../autumn/'>
//						���������
//					</a>
//					, � 
//					<a href='../winter/'>
//						�����. 
//					</a>
//				</p>
//		";
//END Choose theme (If I do it)

		$d	=	"com.txt";

/*		if(	$_POST['sett']	== "�������� ������"){
			if(	empty($_POST['tt'])){
				echo "
				<a href=".$_SERVER['PHP_SELF'].">
					�����
				</a> � 
				";
				exit("�� �� ����� ������.");
			}
			$tt		= htmlspecialchars($_POST['tt']);
			$fd		= fopen($d,"w"); 
			if(	!$fd)exit("�� ���� ������� ����. ������");
			fwrite($fd, $tt);
			fclose($fd);
			$yes	= "������ ������� ���������.";
		}
*/

		if(	file_exists($d)){
			$arr	= file($d);
		}else{
			$yes	= "������� ���������� ������.";
		}
		echo <<<here
	<marquee	
					class			= "marq"
					scrollamount	= "2"
					behavior		= "alternate"
					height			= "35"
					width			= "90%">
			$arr[0]
				</marquee>
				
here;
		include("block/db.php");
		$result_d	= mysqli_query($db,
						"SELECT
							id,
							img_d,
							title_d,
							m_kd,
							m_dd
						FROM
							main_ind"
					);
		$myrow_d	= mysql_fetch_array($result_d);
		echo"
				<div class='holder'>
		";
		do{
			echo"
					<div class='block'>
						<div class='small-block'>
							<a href='index.php?new=".$myrow_d['id']."'>
								<img	class='small'
										src='".$myrow_d['img_d']."'/>
							</a>
						</div>
						<span></span>
						<h2 class='custom'>
							<a href='index.php?new=".$myrow_d['id']."'>
								".$myrow_d['title_d']."
							</a>
						</h2>
						<h5 class='custom'>
							<a href='index.php?new=".$myrow_d['id']."'>
								".$myrow_d['m_kd']."
							</a>
						</h5>
						<p class='index-text'>
							".$myrow_d['m_dd']."
						</p>
						<p>
							<a class='more' href='index.php?new=".$myrow_d['id']."'>
								�����
							</a>
						</p>
					</div>

			";
		}while($myrow_d	= mysql_fetch_array($result_d));
		echo"
				</div>
		";
		mysql_close($db);
	}else{
		include("block/db.php");
		$result_d	= mysql_query(
						"SELECT
							id,
							img_d,
							title_d,
							text
						FROM
							main_ind
						WHERE
							id='$id'"
					,$db);
		$myrow_d	= mysql_fetch_array($result_d);
		$onclick	= "this.href='javascript:history.back()'";
		do{
			echo"
					<div id='rec_block_single'>
						<div class='thumb-rec'>
							<a	href	= '��������� �������'
								onclick	= '$onclick'
								title	= '��������� �������'>
								<img	class='rec-img'
										src='".$myrow_d['img_d']."'/>
							</a>
							<span></span>
						</div>
						<p5 class='bgcol'>
							<h2>".$myrow_d['title_d']."</h2>
						</p5>
						<span1></span1>
						<div class='brief'>
							".$myrow_d['text']."
						</div>
						<span2></span2>
						<div id='backlink_rec'>
							<a	class	= 'more'
								href	= '��������� �������'
								onclick	= '$onclick'
								title	= '��������� �������'>
								<strong>�����</strong>
							</a>
					</div>
				</div>
			";
		}while($myrow_d	= mysql_fetch_array($result_d));
		mysql_close($db);
	}
?>
	</div>
		</div>
<?php
	include("block/footer.php");
?>

	</body>
</html>