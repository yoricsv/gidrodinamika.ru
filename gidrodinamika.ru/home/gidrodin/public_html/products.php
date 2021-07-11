<?php
include("block/db.php");
include("block/filter_array_post_get_request.php");

$query   = mysqli_query ($db,
   "SELECT
		meta_d,
		meta_k,
		title
	FROM
		settings
	WHERE
		page ='products'",
);

$myrow   = mysqli_fetch_array ($query);
           mysqli_close       ($db);

$set_var = array(
	"hid_line_ins", "hid_line_finder",
    "a",   "a6", "a5", "p", "kav", "ins",
	"cat", "m",  "ro", "t", "w",   "h", "q",
    "hid_line_imager", "hid_line"
);

foreach($set_var as $key => $val)
{
	if(empty($$val))
	{
		$$val = '';
	}
}



$trim_id = $_REQUEST['id'];

if(     isset($trim_id)
	&&  is_numeric($trim_id))
{
	$id         = intval($trim_id);
	$ret_single = 1;
}
else
{
	unset($trim_id);
	$ret_single = 0;

    $trim_a = $_REQUEST['a'];

	if( isset($trim_a))
	{
		$a = intval ($trim_a);
	}
	else
	    unset($trim_a);


	$hid_line = 
	    "<input name  = 'a'
		        type  = 'hidden'
				value = '".$a."'
		/>";


	include("block/product_sort_method.php");


	// Pump type Selector 
    $trim_ins = trim($_REQUEST['ins']);

	if(     isset     ($trim_ins)
        &&  is_numeric($trim_ins))
	{
		$ins     = intval($trim_ins);
        $ret_ins = 1;

		switch($ins)
		{
			//in case of horizontal pump type
			case 1:
			    $ins_b        	  = "inst = 'gor'";
			    $hid_line_ins     = 
				    "<input name  = 'ins'
					        type  = 'hidden'
							value = '1'
					/>";
			    break;

			//in case of vertical pump type
			case 2:
			    $ins_b            = "inst = 'vert'";
			    $hid_line_ins     =
				    "<input name  = 'ins'
					        type  = 'hidden'
							value = '2'
					/>";
			    break;

			// in case of error, display both pump types
			default:
				unset($trim_ins);
			    $ins_b            = "";
			    $hid_line_ins     = "";
			    $ret_ins          = 0;
			    break;
		}
	}
	else
	{
		// display both pump types
		$ins_b       	= "";
		$hid_line_ins   = "";
		$ret_ins        = 0;
	}
	
	include ("block/product_sort_ranges.php");
	include ("block/product_db_query_handler.php");
}
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
     id    = 'right_holder_admin'>

	<div class = 'navbar'>
		<a class = 'scroll_to_top'
		   href  = '#top'
		   title = 'Вернуться к началу страницы'>
		   
			<img src = "img/arrow_top_oval.png" />
		</a>

		<a class = 'scroll_return'
		   href  = 'javascript:history.back()'
		   title = 'Вернуться обратно'>
		   
			<img src = "img/arrow_return_oval.png"/>
		</a>
	</div>
	
</div>


<div id = "wrapper">

	<?php include("block/header.php");?>
	
	<div id = "header">
	
		<?php include("block/logo_search.php");?>
		
		<img alt   = "Active" 
		     class = "arrow-products"
			 id    = "arrow-top"
			 src   = "img/nav-arrow-top.png"
		/>
	</div>
	
	
	<div id = "main">
	
		<p class = "section-title">
			<span class = "title custom">
				Продукция
			</span>
			
			<span class = "desc">
				Отбор и поиск продукции
			</span>
		</p>
		
		<div class = 'download'>
			<a href   = 'files/gidrodinamika_cat_2014.pdf'
			   target = '_blank'>
			   
				<img src = 'img/icons/ico-pdf.png' />
				<span>
					Скачать » Каталог продукции 2015 г.
				</span>

			</a>
		</div>

<?php
switch($ins)
{
	case 1:
		$kav_input_find    =
		    "<p>
			    Кав. зап., hдоп.:
				<input id    = 'kav' 
				       name  = 'kav'
					   size  = '2'
					   type  = 'text'
					   value = '$kav'
				/>
				 м
			</p>";
			
		$p_input_find      =
		    "<p>
			    Давл. на вх., P:
				<input id    = 'p'
				       name  = 'p'
                       size  = '2'
					   type  = 'text'
					   value = '$p'
				/>
				 МПа
			</p>";
			
		$kav_p_general_car =
		    "<span class = 'str'>
			    hдоп
			</span>
				 - допускаемый кавитационный запас, м;
			<br/>
			
			<span class = 'str'>
			    P
			</span>
	 		     - давление перекачиваемой жидкости на входе, МПа;
			<br/>";
			
		$kav_p_sort        =
		    "<li>
				<form action = 'products.php'
				      method = 'post'>
					<input name  = 'a'
					       type  = 'hidden'
						   value = '$a5'
					/>
					
					$hid_line_finder
					$hid_line_ins
					
					<input name  = 'send_finder'
					       type  = 'submit'
						   value = 'hдоп.'
					/>
				</form>
			</li>
			
			<li>
				<form action = 'products.php'
				      method = 'post'>
					<input name  = 'a'
					       type  = 'hidden'
						   value = '$a6'
				    />
					
					$hid_line_finder
					$hid_line_ins
					
					<input name  = 'send_finder'
					       type  = 'submit'
						   value = 'P'
					/>
				</form>
			</li>";
		$input_width       = "";
	    break;
	
	case 2:
		$kav_input_find    = "";
		$p_input_find      = "";
		$kav_p_general_car = "";
		$kav_p_sort        = "";
		$input_width       = "style = 'width: 33px;'";
		break;
	
	default:
		$kav_input_find    =
		    "<p>
			    Кав. зап., hдоп.:
			    <input  id    = 'kav'
				        name  = 'kav'
						size  = '2'
						type  = 'text'
						value = '$kav'
				/>
				 м
			</p>";
			
		$p_input_find      =
		    "<p>
			    Давл. на вх., P:
				<input id    = 'p'
					   name  = 'p'
					   size  = '2'
					   type  = 'text'
					   value = '$p'
				/>
				 МПа
			</p>";
			
		$kav_p_general_car =
			"<span class = 'str'>
				hдоп
			</span>
			 - допускаемый кавитационный запас, м;
			<br/>
			
			<span class = 'str'>
				P
			</span>
			 - давление перекачиваемой жидкости на входе, МПа;
			<br/>";
			
		$kav_p_sort        =
		    "<li>
				<form action = 'products.php'
				      method = 'post'>
					<input name  = 'a'
					       type  = 'hidden'
					       value = '$a5'
					/>
					
					$hid_line_finder
					$hid_line_ins
					
					<input name  = 'send_finder'
					       type  = 'submit'
					       value = 'hдоп.'
					/>
				</form>
			</li>
			<li>
				<form action = 'products.php'
				      method = 'post'>
					<input name  = 'a'
					       type  = 'hidden'
						   value = '$a6'
					/>
					
					$hid_line_finder
					$hid_line_ins
					
					<input name  = 'send_finder'
					       type  = 'submit'
						   value = 'P' 
					/>
				</form>
			</li>";
			
		$input_width       = "";
		
		break;
}

switch($ret_single)
{
	case 0:
		echo <<<here
		
			<div class = "imgholder">
				<div class = "gor">
					<a href = "?ins=1">
						<figure>
							<img        src   = "img/dummies/nasos2b.png"/>
							<figcaption class = "caption">
								Горизонтальные насосные агрегаты
							</figcaption>
						</figure>
					</a>
				</div>
				
				<div class = "vert">
					<a href = "?ins=2">
						<figure>
							<img        src   = "img/dummies/nasos1b.png"/>
							<figcaption class = "caption">
								Вертикальные полупогружные насосные агрегаты
							</figcaption>
						</figure>
					</a>
				</div>
			</div>
here;

		echo <<<here
		
			<!-- filter_finder -->
			<form action = "products.php"
				  id     = "filter"
				  method = "post">
				<div id = "finder">
					<p>
						<input id    = "send_finder"
							   name  = "send_finder"
							   type  = "submit"
							   value = "НАЙТИ"
							   width = "110px"
						/>
					</p>
					<div class = 'f_line'>
						<p>
							Подача, Q:
							<input id    = "q"
								   name  = "q"
								   size  = "2"
								   type  = "text"
								   value = "$q"
							/>
							 м
							<sup>
								3
							</sup>
							/ч
						</p>
						<p>
							Напор, H:
							<input id    = "h"
								   name  = "h"
								   size  = "2"
								   type  = "text"
								   value = "$h"
							/>
							 м
						</p>
						<p>
							Мощность, W:
							<input id    = "w"
								   name  = "w"
								   size  = "2"
								   type  = "text"
								   value = "$w"
							/>
							 кВт
						</p>
						
						$kav_input_find
					
					</div>
					<div class = 's_line'>
					
						$p_input_find
						
						<p>
							Темп. жид., T:
							<input id    = "t"
								   name  = "t"
								   size  = "2"
								   type  = "text"
								   value = "$t" 
							/>
							 °С
						</p>
						<p>
							Плотность, p:
							<input id    = "ro"
								   name  = "ro"
								   size  = "2"
								   type  = "text"
								   value = "$ro"
							/>
							 кг/м
							<sup>
								3
							</sup>
						</p>
						<p>
							Масса, m:
							<input id    = "m"
								   name  = "m"						
								   size  = "2"
								   type  = "text"
								   value = "$m" 
							/>
							 кг
						</p>
						
						$hid_line_ins
						$hid_line
						
					</div>
				</div>
			</form>
here;

		echo <<<here
		
			<h2 class = "str">
				Основные технические характеристики
			</h2>
			<p>
				<span class = "str">
					Q
				</span>
				 - подача, м
				<sup>
					3
				</sup>
					/ч;
				<br/>
				
				<span class = "str">
					H
				</span>
				 - напор, м;
				<br/>
				
				<span class = "str">
					W
				</span>
				 - мощность электродвигателя, кВт;
				<br/>
				
				$kav_p_general_car
				
				<span class = "str">
					T
				</span>
				 - температура перекачиваемой жидкости, °С;
				<br/>
				
				<span class = "str">
					p
				</span>
				 - плотность перекачиваемой жидкости, кг/м
				<sup>
					3
				</sup>;
				<br/>
				
				<span class = "str">
					m
				</span>
				 - масса агрегата, кг;
			</p>
			<br/>
			
			<!-- filter_sort -->
			<ul id = "filter">
				<li>
					ФИЛЬТР: 
				</li>
				
				<li>
					<form action = 'products.php'
						  class  = "fir_button"
						  method = 'post'
					>
						<input name  = "a"
							   type  = "hidden"
							   value = "$a1"
						/>
						
						$hid_line_finder
						$hid_line_ins
						
						<input name  = "send_finder"
							   type  = "submit"
							   value = "Наименование"
						/>
					</form>
				</li>
				
				<li>
					<form action = 'products.php'
					      method = 'post'
					>
						<input name = "a"
						type = "hidden"
						value = "$a2"
						/>
						
						$hid_line_finder
						$hid_line_ins
						
						<input name  = "send_finder"
							   type  = "submit"
							   value = "Q"
							   $input_width
						/>
					</form>
				</li>
				
				<li>
					<form action = 'products.php'
					      method = 'post'
					>
						<input name  = "a"
						       type  = "hidden"
							   value = "$a3"
						/>
						
						$hid_line_finder
						$hid_line_ins
						
						<input name  = "send_finder"
						       type  = "submit"
							   value = "H"
							   $input_width
						/>
					</form>
				</li>
				
				<li>
					<form action = 'products.php'
					      method = 'post'
					>
						<input name  = "a"
						       type  = "hidden"
							   value = "$a4"
						/>
						
						$hid_line_finder
						$hid_line_ins
						
						<input name  = "send_finder"
						       type  = "submit"
						       value = "W"
						       $input_width
						/>
					</form>
				</li>
				
				$kav_p_sort
				
				<li>
					<form action = 'products.php'
					      method = 'post'
					>
						<input name  = "a"
						       type  = "hidden" 
						       value = "$a7" 
						/>
						
						$hid_line_finder
						$hid_line_ins
						
						<input name  = "send_finder"
						       type  = "submit"
						       value = "T"
						       $input_width
						/>
					</form>
				</li>
				
				<li>
					<form action = 'products.php'
					      method = 'post'
					>
						<input name  = "a"
						       type  = "hidden"
						       value = "$a8"
						/>
						
						$hid_line_finder
						$hid_line_ins
						
						<input name  = "send_finder"
						       type  = "submit"
						       value = "p"
						       $input_width
						/>
					</form>
				</li>
				
				<li>
					<form action = 'products.php'
					      method = 'post'
					>
						<input name  = "a"
						       type  = "hidden"
							   value = "$a9" 
						/>
						
						$hid_line_finder
						$hid_line_ins
						
						<input name  = "send_finder"
						       type  = "submit"
							   value = "m"
							   $input_width
						/>
					</form>
				</li>
			</ul>
here;

		echo "
		    <table cellPadding = '0'
			       cellSpacing = '0'
				   class       = 'tabprod'
			>";
		
			include("block/db.php");
			
			$res = mysqli_query($db, $query);

			while($myrow_prod = mysqli_fetch_array($res))
			{
				if( !empty($myrow_prod['pump_m']))
				{
					echo "
						<tr>
							<td class = 'nowrap'>
								<a href = '?id=".$myrow_prod['id']."'>
								    ".$myrow_prod['name']."
								</a>
							</td> 

							<td class = 'dan'>
							    ".$myrow_prod['pump_q']."
							</td>
							
							<td class = 'dan'>
							    ".$myrow_prod['pump_h']."
							</td>
							
							<td class = 'dan'>
							    ".$myrow_prod['pump_w']."
							</td>";
							
					if( $ins != 2)
					{
						//BELOW - checks are needed in the future  be
						//        if will be add the values of NPSH and pressure

						//kav_echo
						echo
							(isset($myrow_prod['pump_kav']))
							?
								"<td class = 'dan'>
									".$myrow_prod['pump_kav']."
								</td>"
							:
								"<td class = 'dan'>
									-
								</td>";


						//p_echo
						echo
							(isset($myrow_prod['pump_p']))
							?
								"<td class = 'dan'>
									".$myrow_prod['pump_p']."
								</td>"
							:
								"<td class = 'dan'>
									-
								</td>";
					}
					else
						echo "";

					echo
							"<td class = 'dan'>
								".$myrow_prod['pump_t']."
							</td>
						
							<td class = 'dan'>
								".$myrow_prod['pump_ro']."
							</td>
							
							<td class = 'dan'>
								".$myrow_prod['pump_m']."
							</td>
						</tr>";
				}
			}
			
			mysqli_close($db);
			
		echo "</table>";
		
		break;
		
	case 1:
		include("block/db.php");
		
		$res_single = mysqli_query( $db,
		   "SELECT
			    *
			FROM
			    products
			WHERE
			    id = '".mysqli_real_escape_string($id)."'"
		);
		
		$myrow_sin  = mysqli_fetch_array($res_single);
		
		echo "
			<div class = 'one_pro'>
				<h1>
					$myrow_sin[name]
				</h1>
				
				<h5>
					Основные технические характеристики
				</h5>
				
				<p>
					Подача, Q: 
					<span>
						<strong>
							".$myrow_sin['pump_q']."
						</strong>
						 м
						 <sup>
							3
						</sup>
						/ч
					</span>
					<br/>
					
					Напор, H: 
					<span>
						<strong>
							".$myrow_sin['pump_h']."
						</strong>
						 м
					</span>
					<br/>";
					
					echo
						($myrow_sin['pump_kav']==0)
						?
							""
						:
							"Допускаемый кавитационный запас, hдоп.: 
							<span>
								не более 
								<strong>
									".$myrow_sin['pump_kav'] ."
								</strong>
								 м
							</span>
							<br/>";

					echo
						($myrow_sin['pump_ro']==0)
						?
							""
						:
							"Плотность перекачиваемой жидкости, p: 
							<span>
								до 
							<strong>
								".$myrow_sin['pump_ro']."
							</strong>
							 кг/м
							 <sup>
								3
							 </sup>
							</span>
							<br/>";
							
					echo
						($myrow_sin['pump_t']==0)
						?
							""
						:
								"Температура перекачиваемой жидкости, T: 
								<span>
									не более 
									<strong>
										".$myrow_sin['pump_t']."
									</strong>
									 °С
								</span>
							<br/>";
					
					echo
						($myrow_sin['pump_p']==0)
						?
						""
						:
						"Давление на входе, Pвх: 
						<span>
							не более 
							<strong>
								".$myrow_sin['pump_p']."
							</strong>
						 МПа
						</span>
						<br/>";
					
					echo
						"Мощность электродвигателя, W: 
						<span>
							<strong>
								".$myrow_sin['pump_w']."
							</strong>
						 кВт
						</span>
						<br/>";
					
					echo
						($myrow_sin['pump_m']==0)
						?
						""
						:
						"Масса, m: 
						<span>
							<strong>
								".$myrow_sin['pump_m']."
							</strong>
						 кг
						</span>
						<br/>";
					
					echo 
						"</p>
						
						<div id = 'backlink'>
							<a href = 'javascript:history.back()'>
								Назад
							</a>
						</div>";

					echo
						empty($myrow_sin['link_gab'])
						?
							""
						:
							"<div class = 'download'>
								<a href   = '$myrow_sin[link]/$myrow_sin[link_gab]'
								   target = '_blank'
								>
									<img src = img/icons/ico-pdf.png'/>
									<span>
										Скачать » Габаритный чертеж
									</span>
								</a>
							</div>
							
							<div id = 'single_prod_ing'>
								<img class  = 'prod_img' 
									 height = '480'
									 src    = $myrow_sin[link]/$myrow_sin[link_gab_png]'
									 width  = '676'
								/>
								<span></span>
							</div>";

					echo
						empty($myrow_sin['link_character'])
						?
							""
						:
							"<div class = 'download'>
								<a href   = '$myrow_sin[link]/$myrow_sin[link_character]'
								   target = '_blank'
								>
									<img src = img/icons/ico-pdf.png'/>
									<span>
										Скачать » Рекомендуемая схема обвязки
									</span>
								</a>
							</div>
							
							<div id = 'single_prod_ing'>
								<img class  = 'prod_img'
									 height = '480'
									 src    = '$myrow_sin[link]/$myrow_sin[link_character_png]'
									 width  = '676'
								/>
								<span></span>
							</div>";
				
					echo empty($myrow_sin['link_schema'])
					?
						""
					:
						"<div class = 'download'>
							<a href   = $myrow_sin[link]/$myrow_sin[link_schema]'
							   target = '_blank'
							>
								<img src = img/icons/ico-pdf.png'/>
								<span>
									Скачать » Основная характеристика
								</span>
							</a>
						</div>
						
						<div id = 'single_prod_ing'>
							<img class  = 'prod_img'
								 height = '480'
								 src    = $myrow_sin[link]/$myrow_sin[link_schema_png]'
								 width  = '676'
							/>
							<span></span>
						</div>";
				
					echo
						"	<div id = 'backlink'>
								<a href = 'javascript:history.back()'>
									Назад
								</a>
							</div>
						</div>";
			
			mysqli_close($db);
			
		break;

	default:
		echo <<<here
		
			<div class = "imgholder">
				<div class = "gor">
					<a href = "?ins=1">
						<figure>
							<img src = "img/dummies/nasos2b.png"/>
							<figcaption class = "caption">
								Горизонтальные насосные агрегаты
							</figcaption>
						</figure>
					</a>
				</div>

				<div class = "vert">
					<a href = "?ins=2">
						<figure>
							<img src="img/dummies/nasos1b.png"/>
							<figcaption class = "caption">
								Вертикальные полупогружные насосные агрегаты
							</figcaption>
						</figure>
					</a>
				</div>
			</div>
here;

		echo <<<here
		
			<!-- filter_finder -->
			<form action = "products.php"
				  id     = "filter"
				  method = "post"
			>
				<div id = "finder">
					<p>
						<span>
							<input id    = "send_finder"
								   name  = "send_finder"
								   type  = "submit"
								   value = "НАЙТИ"
								   width = "110px"
							/>
						</span>
					</p>
					
					<p>
						<span2>
							Подача, Q:
							<input id    = "q"
								   name  = "q"
								   size  = "2"
								   type  = "text"
								   value = "$q"
							/>
							 м
							 <sup>
								3
							 </sup>
							/ч
						</span2>
					</p>

					<p>
						Напор, H:
						<input id    = "h"
							   name  = "h"
							   size  = "2"
							   type  = "text"
							   value = "$h"
						/>
						 м
					</p>
					
					<p>
						Мощность, W:
						<input id    = "w"
							   name  = "w"
							   size  = "2"
							   type  = "text"
							   value = "$w"
						/>
						 кВт
					</p>
					
					$hid_line
					$hid_line_ins
				
				</div>
			</form>
here;

		echo <<<here

			<h2 class = "str">
				Основные технические характеристики
			</h2>

			<p>
				<span class = "str">
					Q
				</span>
				 - подача, м
				<sup>
					3
				</sup>
				/ч;
				<br/>
				
				<span class = "str">
					H
				</span>
				 - напор, м;
				<br/>
				
				<span class = "str">
					W
				</span>
				 - мощность электродвигателя, кВт;
				<br/>
				
				<span class = "str">
					hдоп
				</span>
				 - допускаемый кавитационный запас, м;
				<br/>
				
				<span class = "str">
					P
				</span>
				 - давление перекачиваемой жидкости на входе, МПа;
				<br/>
				
				<span class = "str">
					T
				</span>
				 - температура перекачиваемой жидкости, °С;
				<br/>
				
				<span class = "str">
					p
				</span>
				 - плотность перекачиваемой жидкости, кг/м
				<sup>
					3
				</sup>;
				<br/>
				
				<span class = "str">
					m
				</span>
				 - масса агрегата, кг;
			</p>
			<br/>
			
			<!-- filter_sort -->
			<ul id = "filter">
				<li>
					ФИЛЬТР: 
				</li>
				
				<li>
					<form action = 'products.php'
					      class  = "fir_button"
						  method = 'post'
					>
						<input name  = "a"
							   type  = "hidden"
							   value = "$a1"
						/>
						
						$hid_line_finder
						$hid_line_ins
						
						<input name  = "send_finder"
							   type  = "submit"
							   value = "Наименование"
						/>
					</form>
				</li>
				
				<li>
					<form action = 'products.php'
						  method = 'post'
					>
						<input name  = "a"
							   type  = "hidden"
							   value = "$a2"
						/>
						
						$hid_line_finder
						$hid_line_ins
						
						<input name  = "send_finder"
							   type  = "submit"
							   value = "Q - подача"
						/>
					</form>
				</li>

				<li>
					<form action = 'products.php'
						  method = 'post'
					>
						<input name  = "a"
							   type  = "hidden"
							   value = "$a3"
						/>
						
						$hid_line_finder
						$hid_line_ins
						
						<input name  = "send_finder"
							   type  = "submit"
							   value = "H - напор"
						/>
					</form>
				</li>

				<li>
					<form action = 'products.php'
						  method = 'post'
					>
						<input name  = "a"
							   type  = "hidden"
							   value = "$a4"
						/>
						
						$hid_line_finder
						$hid_line_ins
						
						<input name  = "send_finder"
							   type  = "submit"
							   value = "W - мощность электродвигателя"
						/>
					</form>
				</li>
			</ul>
here;

		echo 
			"<table  cellPadding = '0'
					 cellSpacing = '0'
					 class       = 'tabprod'
			>";

		include("block/db.php");

		$res = mysqli_query($db, $query);

		while( $myrow_prod = mysqli_fetch_array($res))
		{
				if( $myrow_prod['pump_m']!=0)
				{
					echo"
						<tr>
							<td class = 'nowrap'>
								<a href = '?id = ".$myrow_prod['id']."'>
									".$myrow_prod['name']."
								</a>
							</td>
							
							<td class = 'dan'>
								".$myrow_prod['pump_q']."
							</td>
							
							<td class = 'dan'>
								".$myrow_prod['pump_h']."
							</td>
							
							<td class = 'dan'>
								".$myrow_prod['pump_w']."
							</td>";
							
							echo
								($myrow_prod['pump_kav']!=0)
								?
									"<td class = 'dan'>
										".$myrow_prod['pump_kav']."
									</td>"
								:
									"<td class = 'dan'>
										-
									</td>";

							echo
								($myrow_prod['pump_p']!=0)
								?
									"<td class = 'dan'>
										".$myrow_prod['pump_p']."
									</td>"
								:
									"<td class = 'dan'>
										-
									</td>";
									
							echo
								"<td class = 'dan'>
									".$myrow_prod['pump_t']."
								</td>

							<td class = 'dan'>
								".$myrow_prod['pump_ro']."
							</td>

							<td class = 'dan'>
								".$myrow_prod['pump_m']."
							</td>
						</tr>";
				}
		}

		mysqli_close($db);
			
		echo "</table>";
		
		break;
}
?>
	</div>
</div>

<?php include("block/footer.php");?>

</body>

</html>