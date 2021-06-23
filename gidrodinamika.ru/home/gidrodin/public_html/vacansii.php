<?php include("block/filter_array_post_get_request.php");
include("block/db.php");
if(isset($_REQUEST['a'])&&!empty($_REQUEST['a'])&&is_numeric($_REQUEST['a'])){
		$id=intval(trim($_REQUEST['a']));
		$where="WHERE id='$id'";
	}else{
		unset($_REQUEST['a']);
		$where="";
	}
$myrow=mysql_fetch_array(mysql_query("SELECT meta_d,meta_k,title FROM settings WHERE page='vacansii'",$db));$result_vac=mysql_query("SELECT id,profession FROM vacancy",$db);$res_vac=mysql_query("SELECT status FROM vacancy $where",$db);$r_vac=mysql_query("SELECT * FROM vacancy $where",$db);$m_vac=mysql_fetch_array($r_vac);?>
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
		<img src="img/nav-arrow-top.png" alt="Active" id="arrow-top" class="arrow-vacansy"/>
	</div>
<div id="main">
<div class="b-page-title">
	<h1 class="b-page">Вакансии на предприятии</h1>
</div>
<?php echo"<ul id='portfolio-filter'>";
	echo"<li>Количество вакансий: ";$mass=0;while($myrow_vac=mysql_fetch_array($res_vac)){$mass=$mass+$myrow_vac['status'];}echo $mass;echo"</li><li><a href='vacansii.php'>Все</a></li>";
do{echo"<li><a href='vacansii.php?a=$my_vac[id]'>$my_vac[profession]</a></li>";}while($my_vac=mysql_fetch_array($result_vac));
	echo"</ul><br>";
	do{printf("
<div class='vac_top'>
	<div class='head'>
		<div class='h2left'>
		<a href='#'><strong>%s: </strong>(%s вакансий)</a>
			<h3 class='h3right'><span>добавлено:</span> %s</h3>
		</div>
	</div>
		<table align='center' width='787' class='vac_tab'>
			<tbody>
				<tr>
					<td valign='top'>
						<table class='information_tbl'>
							<tbody>
								<tr>
									<td align='right'><b>Город:</b></td>
									<td align='left'>Минск</td>
								</tr>
								<tr>
									<td align='right'><b>Заработная плата:</b></td>
									<td align='left'>от %s рублей </td>
								</tr>
								<tr>
									<td align='right'><b>Характер работы:</b></td>
									<td align='left'> на территории работодателя</td>
								</tr>
								<tr>
									<td align='right'><b>График работы:</b></td>
									<td align='left'> фиксированный</td>
								</tr>
								<tr>
									<td align='right'><b>Занятость:</b></td>
									<td align='left'> полная</td>
								</tr>
							</tbody>
						</table>
					</td>
					<td valign='top'>
						<table class='information_tbl'>
							<tbody>
								<tr>
									<td align='right'><b>Организация:</b></td>
									<td align='left'> ЗАО \"Гидродинамика\"</td>
								</tr>
								<tr>
									<td align='right'><b>Телефон гор.:</b></td>
									<td align='left'> 8-017-391-17-75</td>
								</tr>
								<tr>
									<td align='right'><b>E-mail:</b></td>
									<td align='left'><a href='mailto:mail@gidrodinamika.ru'>mail@gidrodinamika.ru</a></td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	<div class='whiteblock'>
		<p><strong>Требования к кандидату:</strong><br>
		Опыт работы: %s<br>
		Образование: %s<br>
		<strong>Возраст: </strong>%s<br>
		<strong>Описание вакансии:</strong> %s<br>
		<strong>Компания предлагает:</strong> полный соц. пакет, официальное трудоустройство</p>
	</div>
	<em><a href='#'>Откликнуться на вакансию</a><br></em>
</div>",$m_vac['profession'],$m_vac['status'],$m_vac['date'],$m_vac['oplata'],$m_vac['expirience'],$m_vac['graduate'],$m_vac['old'],$m_vac['discr_prof']);
		}
		while($m_vac=mysql_fetch_array($r_vac));mysql_close($db);?>
</div>
</div>
	<?php include("block/footer.php");?>
	</body>
</html>