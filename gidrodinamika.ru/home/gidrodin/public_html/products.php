<?php include("block/db.php");include("block/filter_array_post_get_request.php");$myrow=mysql_fetch_array(mysql_query("SELECT meta_d,meta_k,title FROM settings WHERE page='products'",$db));mysql_close($db); 

$set_var = array("hid_line_ins","hid_line_finder","a","a6","a5","p","kav","ins","cat","m","ro","t","w","h","q","hid_line_imager","hid_line");//products.php
foreach($set_var as $key => $val){
	if(empty($$val)){
			$$val='';
		}
}


if(isset($_REQUEST['id'])&&!empty($_REQUEST['id'])&&is_numeric(trim($_REQUEST['id']))){
		$id=intval(trim($_REQUEST['id']));
		$ret_single=1;
	}else{
		unset($_REQUEST['id']);
		$ret_single=0;
		if(isset($_REQUEST['a'])&&!empty($_REQUEST['a'])){$a=intval(trim($_REQUEST['a']));}else{unset($_REQUEST['a']);}
		switch($a){case 1:$order="name DESC";$a1=10;$a2=2;$a3=3;$a4=4;$a5=5;$a6=6;$a7=7;$a8=8;$a9=9;$hid_line="<input type='hidden' value='".$a."' name='a'>";break;case 2:$order="pump_q,pump_h,pump_w,pump_kav,pump_p,pump_t,pump_ro,pump_m";$a1=1;$a2= 11;$a3=3;$a4=4;$a5=5;$a6=6;$a7=7;$a8=8;$a9=9;$hid_line="<input type='hidden' value='".$a."' name='a'>";break;case 3:$order="pump_h,pump_q,pump_w,pump_kav,pump_p,pump_t,pump_ro,pump_m";$a1=1;$a2=2;$a3=12;$a4=4;$a5=5;$a6=6;$a7=7;$a8=8;$a9=9;$hid_line="<input type='hidden' value='".$a."' name='a'>";break;case 4:$order="pump_w,pump_q,pump_h,pump_kav,pump_p,pump_t,pump_ro,pump_m";$a1=1;$a2=2;$a3=3;$a4=13;$a5=5;$a6=6;$a7=7;$a8=8;$a9=9;$hid_line="<input type='hidden' value='".$a."' name='a'>";break;case 5:$order="pump_kav,pump_q,pump_h,pump_w,pump_p,pump_t,pump_ro,pump_m";$a1=1;$a2=11;$a3=3;$a4=4;$a5=14;$a6=6;$a7=7;$a8=8;$a9=9;$hid_line="<input type='hidden' value='".$a."' name='a'>";break;case 6:$order="pump_p,pump_q,pump_h,pump_w,pump_kav,pump_t,pump_ro,pump_m";$a1=1;$a2=11;$a3=3;$a4=4;$a5=5;$a6=15;$a7=7;$a8=8;$a9=9;$hid_line="<input type='hidden' value='".$a."' name='a'>";break;case 7:$order="pump_t,pump_q,pump_h,pump_w,pump_kav,pump_p,pump_ro,pump_m";$a1=1;$a2=11;$a3=3;$a4=4;$a5=5;$a6=6;$a7=16;$a8=8;$a9=9;$hid_line="<input type='hidden' value='".$a."' name='a'>";break;case 8:$order="pump_ro,pump_q,pump_h,pump_w,pump_kav,pump_p,pump_t,pump_m";$a1=1;$a2=11;$a3=3;$a4=4;$a5=5;$a6=6;$a7=7;$a8=17;$a9=9;$hid_line="<input type='hidden' value='".$a."' name='a'>";break;case 9:$order="pump_m,pump_q,pump_h,pump_w,pump_kav,pump_p,pump_t,pump_ro";$a1=1;$a2=11;$a3=3;$a4=4;$a5=5;$a6=6;$a7=7;$a8=8;$a9=18;$hid_line="<input type='hidden' value='".$a."' name='a'>";break;case 10:$order="name";$a1=1;$a2=2;$a3=3;$a4=4;$a5=5;$a6=6;$a7=7;$a8=8;$a9=9;$hid_line="<input type='hidden' value='".$a."' name='a'>";break;case 11:$order="pump_q DESC,pump_h ASC,pump_w ASC,pump_kav ASC,pump_p ASC,pump_t ASC,pump_ro ASC,pump_m ASC";$a1=1;$a2=2;$a3=3;$a4=4;$a5=5;$a6=6;$a7=7;$a8=8;$a9=9;$hid_line="<input type='hidden' value='".$a."' name='a'>";break;case 12:$order="pump_h DESC,pump_q ASC,pump_w ASC,pump_kav ASC,pump_p ASC,pump_t ASC,pump_ro ASC,pump_m ASC";$a1=1;$a2=2;$a3=3;$a4=4;$a5=5;$a6=6;$a7=7;$a8=8;$a9=9;$hid_line="<input type='hidden' value='".$a."' name='a'>";break;case 13:$order="pump_w DESC,pump_q ASC,pump_h ASC,pump_kav ASC,pump_p ASC,pump_t ASC,pump_ro ASC,pump_m ASC";$a1=1;$a2=2;$a3=3;$a4=4;$a5=5;$a6=6;$a7=7;$a8=8;$a9=9;$hid_line="<input type='hidden' value='".$a."' name='a'>";break;case 14:$order="pump_kav DESC,pump_q ASC,pump_h ASC,pump_w ASC,pump_p ASC,pump_t ASC,pump_ro ASC,pump_m ASC";$a1=1;$a2=2;$a3=3;$a4=4;$a5=5;$a6=6;$a7=7;$a8=8;$a9=9;$hid_line="<input type='hidden' value='".$a."' name='a'>";break;	case 15:$order="pump_p DESC,pump_q ASC,pump_h ASC,pump_w ASC,pump_kav ASC,pump_t ASC,pump_ro ASC,pump_m ASC";$a1=1;$a2=2;$a3=3;$a4=4;$a5=5;$a6=6;$a7=7;$a8=8;$a9=9;$hid_line="<input type='hidden' value='".$a."' name='a'>";break;case 16:$order="pump_t DESC,pump_q ASC,pump_h ASC,pump_w ASC,pump_kav ASC,pump_p ASC,pump_ro ASC,pump_m ASC";$a1=1;$a2=2;$a3=3;$a4=4;$a5=5;$a6=6;$a7=7;$a8=8;$a9=9;$hid_line="<input type='hidden' value='".$a."' name='a'>";break;case 17:$order="pump_ro DESC,pump_q ASC,pump_h ASC,pump_w ASC,pump_kav ASC,pump_p ASC,pump_t ASC,pump_m ASC";$a1=1;$a2=2;$a3=3;$a4=4;$a5=5;$a6=6;$a7=7;$a8=8;$a9=9;$hid_line="<input type='hidden' value='".$a."' name='a'>";break;case 18:$order="pump_m DESC,pump_q ASC,pump_h ASC,pump_w ASC,pump_kav ASC,pump_p ASC,pump_t ASC,pump_ro ASC";$a1=1;$a2=2;$a3=3;$a4=4;$a5=5;$a6=6;$a7=7;$a8=8;$a9=9;$hid_line="<input type='hidden' value='".$a."' name='a'>";break;default:$order="name";$a1=1;$a2=2;$a3=3;$a4=4;$a5=5;$a6=6;$a7=7;$a8=8;$a9=9;$hid_line="";break;}
		if(isset($_REQUEST['ins'])&&!empty($_REQUEST['ins'])&&is_numeric(trim($_REQUEST['ins']))){
				$ins=intval(trim($_REQUEST['ins']));
				switch($ins){
					case 1:$ins_b="inst='gor'";$hid_line_ins="<input type='hidden' value='1' name='ins'>";$ret_ins=1;break;
					case 2:$ins_b="inst='vert'";$hid_line_ins="<input type='hidden' value='2' name='ins'>";$ret_ins=1;break;
					default:$ins_b="";$hid_line_ins="";$ret_ins=0;break;
				}
			}else{
				unset($_REQUEST['ins']);$ins_b="";$hid_line_ins="";$ret_ins=0;
			}
		$search_prod=array('q','h','w','kav','p','t','ro','m');
		if(isset($_REQUEST['send_finder'])){
				$send=1;$hid_line_finder="";
				foreach($search_prod as $key=>$val){
					if(empty($_REQUEST[$val])||!is_numeric(trim($_REQUEST[$val]))){
							unset($_REQUEST[$$val]);
						}else{
							$$val=substr($_REQUEST[$val],0,4);
							switch($val){case "q":if($q<=7){$q_min=5;$q_max=8;}elseif($q<=15){$q_min=$q-2;$q_max=$q+2;}elseif($q<=70){$q_min=$q-5;$q_max=$q+5;}elseif($q<=250){$q_min=$q-20;$q_max=$q+20;}elseif($q<=450){$q_min=$q-65;$q_max=$q+65;}elseif($q<=750){$q_min=$q-100;$q_max=$q+100;}elseif($q<=1250){$q_min=750;$q_max=1250;}else{$err_q=1;unset($q);}if(!isset($err_q)){$rq=1;$search_prod_tmp[]='q';$hid_line_finder.="<input type='hidden' value='".$q."' name='q' id='q'>";}break;case "h":if($h<=30){$h_min=18;$h_max=32;}elseif($h<=85){$h_min=$h-5;$h_max=$h+5;}elseif($h<=170){$h_min=$h-10;$h_max=$h+10;}elseif($h<=310){$h_min=$h-20;$h_max=$h+20;}elseif($h<=900){$h_min=$h-50;$h_max=$h+50;}elseif($h<=1000){$h_min=$h-100;$h_max=$h+100;}elseif($h<=1100){$h_min=1000;$h_max=1100;}else{$err_h=1;unset($h);}if(!isset($err_h)){$rh=1;$search_prod_tmp[]='h';$hid_line_finder.="<input type='hidden' value='".$h."' name='h' id='h'>";}break;case "w":if($w<=4){$w_min=2;$w_max=6;}elseif($w<=18.5){$w_min=$w-4;$w_max=$w+4;}elseif($w<=45){$w_min=$w-10;$w_max=$w+10;}elseif($w<=135){$w_min=$w-25;$w_max=$w+25;}elseif($w<=315){$w_min=$w-85;$w_max=$w+85;}elseif($w<=500){$w_min=$w-100;$w_max=$w+100;}elseif($w<=630){$w_min=500;$w_max=630;}else{$err_w=1;unset($w);}if(!isset($err_w)){$rw=1;$search_prod_tmp[]='w';$hid_line_finder.="<input type='hidden' value='".$w."' name='w' id='w'>";}break;case "kav":if($kav<=2){$kav_min=0;$kav_max=2.5;}elseif($kav<=4.5){$kav_min=$kaw-0.5;$kav_max=$kav+0.5;}elseif($kav<=6){$kav_min=$kaw-1;$kav_max=$kav+1;}elseif($kav<=8){$kav_min=6.5;$kav_max=8;}else{$err_kav=1;unset($kav);}if(!isset($err_kav)){$rkav=1;$search_prod_tmp[]='kav';$hid_line_finder.="<input type='hidden' value='".$kav."' name='kav' id='kav'>";}break;case "p":if($p<=0.2){$p_min=0;$p_max=0.3;}elseif($p<0.8){$p_min=$p-0.1;$p_max=$p+0.1;}elseif($p<=1.2){$p_min=$p-0.2;$p_max=$p+0.2;}elseif($p<=1.7){$p_min=$p-0.1;$p_max=$p+0.1;}elseif($p<=2.4){$p_min=$p-0.7;$p_max=$p+0.7;}elseif($p<=3){$p_min=$p-0.5;$p_max=$p+0.5;}elseif($p<=4){$p_min=3.2;$p_max=4;}else{$err_p=1;unset($p);}if(!isset($err_p)){$rp=1;$search_prod_tmp[]='p';$hid_line_finder.="<input type='hidden' value='".$p."' name='p' id='p'>";}break;case "t":if($t<=80){$t_min=0;$t_max=150;}elseif($t<=200){$t_min=$t-20;$t_max=$t+20;}elseif($t<=280){$t_min=$t-30;$t_max=$t+30;}elseif($t<=300){$t_min=280;$t_max=300;}else{$err_t=1;unset($t);}if(!isset($err_t)){$rt=1;$search_prod_tmp[]='t';$hid_line_finder.="<input type='hidden' value='".$t."' name='t' id='t'>";}break;case "ro":if($ro<=500){$ro_min=0;$ro_max=570;}elseif($ro<=950){$ro_min=$ro-30;$ro_max=$ro+30;}elseif($ro<=1200){$ro_min=$ro-50;$ro_max=$ro+50;}elseif($ro<=1700){$ro_min=$ro-100;$ro_max=$ro+100;}elseif($ro<=1800){$ro_min=1700;$ro_max=1800;}else{$err_ro=1;unset($ro);}if(!isset($err_ro)){$rro=1;$search_prod_tmp[]='ro';$hid_line_finder.="<input type='hidden' value='".$ro."' name='ro' id='ro'>";}break;case "m":if($m<=115){$m_min=0;$m_max=160;}elseif($m<=1300){$m_min=$m-150;$m_max=$m+150;}elseif($m<=3600){$m_min=$m-170;$m_max=$m+170;}elseif($m<=4700){$m_min=$m-300;$m_max=$m+300;}elseif($m<=5820){$m_min=$m-800;$m_max=$m+800;}elseif($m<=6620){$m_min=6520;$m_max=6620;}else{$err_m=1;unset($m);}if(!isset($err_m)){$rm=1;$search_prod_tmp[]='m';$hid_line_finder.="<input type='hidden' value='".$m."' name='m' id='m'>";}break;}
						}
				}
			}else{
				$send=0;
			}
		$select="SELECT id,name,inst,pump_q,pump_h,pump_w,pump_kav,pump_p,pump_t,pump_ro,pump_m FROM products ";
		$query=$select;
		if(!isset($search_prod_tmp)){
				switch($ret_ins){case 0:$query.="";break;case 1:$query.="WHERE ".$ins_b;break;default:$query.="";break;}
			}else{
				$where=0;
				foreach($search_prod_tmp as $key=>$val){
					$tpmp="pump_".$val;
					$tmin=$val."_min";
					$tmax=$val."_max";
					if($where==0 && $ret_ins==0){
							$query.="WHERE (".$tpmp." BETWEEN ".$$tmin." AND ".$$tmax.") ";$where=1;
						}elseif($where==0 && $ret_ins==1){
							$query.="WHERE (".$ins_b." AND (".$tpmp." BETWEEN ".$$tmin." AND ".$$tmax.")) ";$where=1;
						}elseif($where==1 && $ret_ins==0){
							$query.="UNION (".$select. "WHERE (".$tpmp." BETWEEN ".$$tmin." AND ".$$tmax.")) ";
						}elseif($where==1 && $ret_ins==1){
							$query.="UNION (".$select. "WHERE (".$ins_b." AND (".$tpmp." BETWEEN ".$$tmin." AND ".$$tmax."))) ";
						}
				}
			}
		$query.=" ORDER BY ".$order;
	}
?>
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
		<img src="img/nav-arrow-top.png" alt="Active" id="arrow-top" class="arrow-products"/>
	</div>
	<div id="main">
		<p class="section-title">
			<span class="title custom">Продукция</span>
			<span class="desc">Отбор и поиск продукции</span>
		</p>
		<div class='download'>
			<a href='files/gidrodinamika_cat_2014.pdf' target='_blank'>
			<img src='img/icons/ico-pdf.png'><span>Скачать » Каталог продукции 2015 г.</span></a>
		</div>
<?php
switch($ins){
	case 1:
		$kav_input_find="<p>Кав. зап., hдоп.:<input name='kav' id='kav' type='text' value='$kav' size='2'/> м</p>";
		$p_input_find="<p>Давл. на вх., P:<input name='p' id='p' type='text' value='$p' size='2'/> МПа</p>";
		$kav_p_general_car="<span class='str'>hдоп</span> - допускаемый кавитационный запас, м;<br>
				<span class='str'>P</span> - давление перекачиваемой жидкости на входе, МПа;<br>";
		$kav_p_sort="<li>
				<form action='products.php' method='post'>
					<input type='hidden' value='$a5' name='a'>$hid_line_finder $hid_line_ins
					<input type='submit' value='hдоп.' name='send_finder'>
				</form>
			</li>
			<li>
				<form action='products.php' method='post'>
					<input type='hidden' value='$a6' name='a'>$hid_line_finder $hid_line_ins
					<input type='submit' value='P' name='send_finder'>
				</form>
			</li>";
		$input_width="";
	break;
	case 2:
		$kav_input_find="";
		$p_input_find="";
		$kav_p_general_car="";
		$kav_p_sort="";
		$input_width="style='width:33px;'";
	break;
	default:
		$kav_input_find="<p>Кав. зап., hдоп.:<input name='kav' id='kav' type='text' value='$kav' size='2'/> м</p>";
		$p_input_find="<p>Давл. на вх., P:<input name='p' id='p' type='text' value='$p' size='2'/> МПа</p>";
		$kav_p_general_car="<span class='str'>hдоп</span> - допускаемый кавитационный запас, м;<br>
				<span class='str'>P</span> - давление перекачиваемой жидкости на входе, МПа;<br>";
		$kav_p_sort="<li>
				<form action='products.php' method='post'>
					<input type='hidden' value='$a5' name='a'>$hid_line_finder $hid_line_ins
					<input type='submit' value='hдоп.' name='send_finder'>
				</form>
			</li>
			<li>
				<form action='products.php' method='post'>
					<input type='hidden' value='$a6' name='a'>$hid_line_finder $hid_line_ins
					<input type='submit' value='P' name='send_finder'>
				</form>
			</li>";
		$input_width="";
	break;
}
switch($ret_single){
	case 0:
		echo <<<here
		<div class="imgholder">
			<div class="gor">
				<a href="?ins=1">
				<figure>
					<img src="img/dummies/nasos2b.png"/>
					<figcaption class="caption">Горизонтальные насосные агрегаты</figcaption>
				</figure></a>
			</div>
			<div class="vert">
				<a href="?ins=2">
				<figure>
					<img src="img/dummies/nasos1b.png"/>
					<figcaption class="caption">Вертикальные полупогружные насосные агрегаты</figcaption>
				</figure></a>
			</div>
		</div>
here;
		echo <<<here
		<!-- filter_finder -->
		<form id="filter" action="products.php" method="post">
			<div id="finder">
				<p><input type="submit" value="НАЙТИ" name="send_finder" id="send_finder" width="110px"/></p>
				<div class='f_line'>
					<p>Подача, Q:<input name="q" id="q" type="text" value="$q" size="2"/> м<sup>3</sup>/ч</p>
					<p>Напор, H:<input name="h" id="h" type="text" value="$h" size="2"/> м</p>
					<p>Мощность, W:<input name="w" id="w" type="text" value="$w" size="2"/> кВт</p>
					$kav_input_find
				</div>
				<div class='s_line'>
					$p_input_find
					<p>Темп. жид., T:<input name="t" id="t" type="text" value="$t" size="2"/> °С</p>
					<p>Плотность, p:<input name="ro" id="ro" type="text" value="$ro" size="2"/> кг/м<sup>3</sup></p>
					<p>Масса, m:<input name="m" id="m" type="text" value="$m" size="2"/> кг</p>
					$hid_line_ins $hid_line
				</div>
			</div>
		</form>
here;
		echo <<<here
		<h2 class="str">Основные технические характеристики</h2>
			<p>
				<span class="str">Q</span> - подача, м<sup>3</sup>/ч;<br>
				<span class="str">H</span> - напор, м;<br>
				<span class="str">W</span> - мощность электродвигателя, кВт;<br>
				$kav_p_general_car
				<span class="str">T</span> - температура перекачиваемой жидкости, °С;<br>
				<span class="str">p</span> - плотность перекачиваемой жидкости, кг/м<sup>3</sup>;<br>
				<span class="str">m</span> - масса агрегата, кг;
			</p>
		<br>
		<!-- filter_sort -->
		<ul id="filter">
			<li>ФИЛЬТР: </li>
			<li>
				<form class="fir_button" action='products.php' method='post'>
					<input type="hidden" value="$a1" name="a">$hid_line_finder $hid_line_ins
					<input type="submit" value="Наименование" name="send_finder">
				</form>
			</li>
			<li><form action='products.php' method='post'>
					<input type="hidden" value="$a2" name="a">$hid_line_finder $hid_line_ins
					<input type="submit" value="Q" name="send_finder" $input_width>
				</form>
			</li>
			<li>
				<form action='products.php' method='post'>
					<input type="hidden" value="$a3" name="a">$hid_line_finder $hid_line_ins
					<input type="submit" value="H" name="send_finder" $input_width>
				</form>
			</li>
			<li>
				<form action='products.php' method='post'>
					<input type="hidden" value="$a4" name="a">$hid_line_finder $hid_line_ins
					<input type="submit" value="W" name="send_finder" $input_width>
				</form>
			</li>
			$kav_p_sort
			<li>
				<form action='products.php' method='post'>
					<input type="hidden" value="$a7" name="a">$hid_line_finder $hid_line_ins
					<input type="submit" value="T" name="send_finder" $input_width>
				</form>
			</li>
			<li>
				<form action='products.php' method='post'>
					<input type="hidden" value="$a8" name="a">$hid_line_finder $hid_line_ins
					<input type="submit" value="p" name="send_finder" $input_width>
				</form>
			</li>
			<li>
				<form action='products.php' method='post'>
					<input type="hidden" value="$a9" name="a">$hid_line_finder $hid_line_ins
					<input type="submit" value="m" name="send_finder" $input_width>
				</form>
			</li>
		</ul>
here;
		echo "<table cellSpacing='0' cellPadding='0' class='tabprod'>";
			include("block/db.php");
			$res=mysql_query($query,$db);
			while($myrow_prod=mysql_fetch_array($res)){
				if($myrow_prod['pump_m']!=0){echo"
					<tr>
						<td class='nowrap'><a href='?id=".$myrow_prod['id']."'>".$myrow_prod['name']."</a></td> 
						<td class='dan'>".$myrow_prod['pump_q']."</td>
						<td class='dan'>".$myrow_prod['pump_h']."</td>
						<td class='dan'>".$myrow_prod['pump_w']."</td>";
						if(isset($ins) && $ins==2){echo"";}else{echo($myrow_prod['pump_kav']!=0)?"<td class='dan'>".$myrow_prod['pump_kav']."</td>":"<td class='dan'>-</td>";}//kav_echo
						if(isset($ins) && $ins==2){echo"";}else{echo($myrow_prod['pump_p']!=0)?"<td class='dan'>".$myrow_prod['pump_p']."</td>":"<td class='dan'>-</td>";}//p_echo
						echo"<td class='dan'>".$myrow_prod['pump_t']."</td>
						<td class='dan'>".$myrow_prod['pump_ro']."</td>
						<td class='dan'>".$myrow_prod['pump_m']."</td>
					</tr>";
					}
			}
			mysql_close($db);
		echo "</table>";
	break;
	case 1:
		include("block/db.php");
		$res_single=mysql_query("SELECT * FROM products WHERE id='".mysql_real_escape_string($id)."'",$db);
		$myrow_sin=mysql_fetch_array($res_single);
		echo "
<div class='one_pro'>
	<h1>$myrow_sin[name]</h1>
	<h5>Основные технические характеристики</h5>
	<p>
		Подача, Q: <span><strong>".$myrow_sin['pump_q']."</strong> м<sup>3</sup>/ч</span><br>
		Напор, H: <span><strong>".$myrow_sin['pump_h']."</strong> м</span><br>";
		echo ($myrow_sin['pump_kav']==0)?"":"Допускаемый кавитационный запас, hдоп.: <span>не более <strong>".$myrow_sin['pump_kav']." </strong> м</span><br>";
		echo ($myrow_sin['pump_ro']==0)?"":"Плотность перекачиваемой жидкости, p: <span>до <strong>".$myrow_sin['pump_ro']."</strong> кг/м<sup>3</sup></span><br>";
		echo ($myrow_sin['pump_t']==0)?"":"Температура перекачиваемой жидкости, T: <span>не более <strong>".$myrow_sin['pump_t']."</strong> °С</span><br>";
		echo ($myrow_sin['pump_p']==0)?"":"Давление на входе, Pвх: <span>не более <strong>".$myrow_sin['pump_p']."</strong> МПа</span><br>";
		echo "Мощность электродвигателя, W: <span><strong>".$myrow_sin['pump_w']."</strong> кВт</span><br>";
		echo ($myrow_sin['pump_m']==0)?"":"Масса, m: <span><strong>".$myrow_sin['pump_m']."</strong> кг</span><br>";
	echo "</p>
	<div id='backlink'>
		<a href='javascript:history.back()'>Назад</a>
	</div>";
		echo empty($myrow_sin['link_gab'])?"":"
	<div class='download'>
		<a href='$myrow_sin[link]/$myrow_sin[link_gab]' target='_blank'>
		<img src='img/icons/ico-pdf.png'><span>Скачать » Габаритный чертеж</span></a>
	</div>
	<div id='single_prod_ing'>
		<img class='prod_img' src='$myrow_sin[link]/$myrow_sin[link_gab_png]' width='676' height='480'>
		<span></span>
	</div>";
		echo empty($myrow_sin['link_character'])?"":"
	<div class='download'>
		<a href='$myrow_sin[link]/$myrow_sin[link_character]' target='_blank'>
		<img src='img/icons/ico-pdf.png'><span>Скачать » Рекомендуемая схема обвязки</span></a>
	</div>
	<div id='single_prod_ing'>
		<img class='prod_img' src='$myrow_sin[link]/$myrow_sin[link_character_png]' width='676' height='480'>
		<span></span>
	</div>";
		echo empty($myrow_sin['link_schema'])?"":"
	<div class='download'>
		<a href='$myrow_sin[link]/$myrow_sin[link_schema]' target='_blank'>
		<img src='img/icons/ico-pdf.png'><span>Скачать » Основная характеристика</span></a>
	</div>
	<div id='single_prod_ing'>
		<img class='prod_img' src='$myrow_sin[link]/$myrow_sin[link_schema_png]' width='676' height='480'>
		<span></span>
	</div>";
		echo"
	<div id='backlink'>
		<a href='javascript:history.back()'>Назад</a>
	</div>
</div>";mysql_close($db);
	break;
	default:
		echo <<<here
		<div class="imgholder">
			<div class="gor">
				<a href="?ins=1">
				<figure>
					<img src="img/dummies/nasos2b.png"/>
					<figcaption class="caption">Горизонтальные насосные агрегаты</figcaption>
				</figure></a>
			</div>
			<div class="vert">
				<a href="?ins=2">
				<figure>
					<img src="img/dummies/nasos1b.png"/>
					<figcaption class="caption">Вертикальные полупогружные насосные агрегаты</figcaption>
				</figure></a>
			</div>
		</div>
here;
		echo <<<here
		<!-- filter_finder -->
		<form id="filter" action="products.php" method="post">
			<div id="finder">
				<p><span><input type="submit" value="НАЙТИ" name="send_finder" id="send_finder" width="110px"/></span></p>
				<p><span2>Подача, Q:<input name="q" id="q" type="text" value="$q" size="2"/> м<sup>3</sup>/ч</span2></p>
				<p>Напор, H:<input name="h" id="h" type="text" value="$h" size="2"/> м</p>
				<p>Мощность, W:<input name="w" id="w" type="text" value="$w" size="2"/> кВт</p>$hid_line $hid_line_ins
			</div>
		</form>
here;
		echo <<<here
		<h2 class="str">Основные технические характеристики</h2>
			<p>
				<span class="str">Q</span> - подача, м<sup>3</sup>/ч;<br>
				<span class="str">H</span> - напор, м;<br>
				<span class="str">W</span> - мощность электродвигателя, кВт;<br>
				<span class="str">hдоп</span> - допускаемый кавитационный запас, м;<br>
				<span class="str">P</span> - давление перекачиваемой жидкости на входе, МПа;<br>
				<span class="str">T</span> - температура перекачиваемой жидкости, °С;<br>
				<span class="str">p</span> - плотность перекачиваемой жидкости, кг/м<sup>3</sup>;<br>
				<span class="str">m</span> - масса агрегата, кг;
			</p>
		<br>
		<!-- filter_sort -->
		<ul id="filter">
			<li>ФИЛЬТР: </li>
			<li>
				<form class="fir_button" action='products.php' method='post'>
					<input type="hidden" value="$a1" name="a">$hid_line_finder  $hid_line_ins
					<input type="submit" value="Наименование" name="send_finder">
				</form>
			</li>
			<li><form action='products.php' method='post'>
					<input type="hidden" value="$a2" name="a">$hid_line_finder $hid_line_ins
					<input type="submit" value="Q - подача" name="send_finder">
				</form>
			</li>
			<li>
				<form action='products.php' method='post'>
					<input type="hidden" value="$a3" name="a">$hid_line_finder $hid_line_ins
					<input type="submit" value="H - напор" name="send_finder">
				</form>
			</li>
			<li>
				<form action='products.php' method='post'>
					<input type="hidden" value="$a4" name="a">$hid_line_finder $hid_line_ins
					<input type="submit" value="W - мощность электродвигателя" name="send_finder">
				</form>
			</li>
		</ul>
here;
		echo "<table cellSpacing='0' cellPadding='0' class='tabprod'>";
			include("block/db.php");
			$res=mysql_query($query, $db);
			while($myrow_prod = mysql_fetch_array($res)){
					if($myrow_prod['pump_m']!=0){echo"
						<tr>
							<td class='nowrap'><a href='?id=".$myrow_prod['id']."'>".$myrow_prod['name']."</a></td> 
							<td class='dan'>".$myrow_prod['pump_q']."</td>
							<td class='dan'>".$myrow_prod['pump_h']."</td>
							<td class='dan'>".$myrow_prod['pump_w']."</td>";
							echo($myrow_prod['pump_kav']!=0)?"<td class='dan'>".$myrow_prod['pump_kav']."</td>":"<td class='dan'>-</td>";
							echo($myrow_prod['pump_p']!=0)?"<td class='dan'>".$myrow_prod['pump_p']."</td>":"<td class='dan'>-</td>";
							echo"<td class='dan'>".$myrow_prod['pump_t']."</td>
							<td class='dan'>".$myrow_prod['pump_ro']."</td>
							<td class='dan'>".$myrow_prod['pump_m']."</td>
						</tr>";
						}
			}
			mysql_close($db);
		echo "</table>";
	break;
}
?>
	</div>
</div>
<?php include("block/footer.php");?>
	</body>
</html>