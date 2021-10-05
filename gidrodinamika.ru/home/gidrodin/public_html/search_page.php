<?php
include("block/db.php");
include("block/filter_array_post_get_request.php");

$set_var = array("sum");

foreach( $set_var as $key => $val)
{
	if( empty($$val))
	{
		$$val = '';
	}
}

function html_filter($str)
{
	$result = mysql_real_escape_string(
			  htmlspecialchars(
			  stripslashes(
			  str_replace(
				"\n",
				"<br/>\n",
				substr(trim($str), 0, 1000))
	)));
	return $result;
}

if(isset($_REQUEST['query']))
{
	$search     = html_filter($_REQUEST['query']);
	
	$send_query = "
		<p>
			По вашему запросу: 
			<b class = 'chek'>
				".$search."
			</b> 
			найдено:
		</p>
	";
}
elseif(empty($_REQUEST['query']))
{
	$send_query =
		"<p>
			Вы не заполнили поле запроса! 
			Заполните поле запроса.
			<br/>
			<br/>
	";
	
	$send_query .=
		"<div id = 'backlink'>
			<a href = 'javascript:history.back()'>
				Назад
			</a>
		</div>
	";
}
$matches    = preg_split("/[\s,;]+/", $search);
$words      = array_unique($matches);
$true_words = Array();

if (count($words))
{
	foreach($words as $word)
	{
		if (strlen($word) > 3)
		{
			if (strlen($word) > 7)
			{
				$word = substr($word, 0,(strlen($word) - 2));
			}
			elseif (strlen($word) > 5)
			{
				$word = substr($word, 0,(strlen($word) - 1));
			}
			
			$true_words [] = addcslashes(addslashes($word), '%_');
		}
		
		$true_words [] = addcslashes(addslashes($word), '%_');
	}
}

$echo = "Массив True_words содержит ".count($true_words)." элемент(а/ов)";


$search_in_db = array(
	'about',
	'main_ind',
	'news',
	'products',
	'record'
);

foreach($search_in_db as $table => $val)
{
	if($table == 'about')
	{
		$coeff_title	= round((20/count($true_words)), 2);
		$coeff_text		= round((10/count($true_words)), 2);


		$query_about  = "SELECT id, title, text,";
		$query_about .= " ( IF (title LIKE '%".$search."%', 60, 0)";
		$query_about .= " + IF (text  LIKE '%".$search."%', 10, 0)";

		foreach($true_words as $word)
		{
			$query_about .= " + IF (title LIKE '%".$word."%', ".$coeff_title.", 0)";
			$query_about .= " + IF (text  LIKE '%".$word."%', ".$coeff_text.",  0)";
		}

		$query_about .= " ) AS rel_ab FROM about";
		$query_about .= " WHERE ";
		$query_about .= " ( title LIKE '%".$search."%' OR text LIKE '%".$search."%'";

		foreach($true_words as $word)
		{
			$query_about .= " OR title LIKE '%".$word."%'";
			$query_about .= " OR text  LIKE '%".$word."%'";
		}

		$query_about .= ") ORDER BY rel_ab DESC";

		$q_ab = $query_about;
	}

	if($table == "main_ind")
	{
		$coeff_text = round((30/count($true_words)), 2);

		$for_count_main_ind  = "SELECT COUNT (text)";


		$query_main_ind  = "SELECT id, text, m_kd, ";
		$query_main_ind .= " ( IF (text LIKE '%".$search."%', 70, 0)";
		foreach($true_words as $word)
		{
			$query_main_ind .= " + IF (text LIKE '%".$word."%', ".$coeff_text.", 0)";
		}
		$like_main_ind = " WHERE ";
		$like_main_ind = " ( text LIKE '%".$search."%'";
		foreach($true_words as $word)
		{
			$like_main_ind  .= " OR text LIKE '%".$word."%'";
		}
		$query_main_ind .= ") AS rel_m_i FROM main_ind ".$like_main_ind;
		$query_main_ind .= ")ORDER BY rel_m_i DESC";


		$for_count_main_ind .= "FROM main_ind ".$like_main_ind.")";

		$q_m_i     = $query_main_ind;
		$count_m_i = $for_count_main_ind;
	}

	if($table == "news")
	{
		$coeff_title	= round((10/count($true_words)),2);
		$coeff_source	= round((4/count($true_words)),2);
		$coeff_autor	= round((4/count($true_words)),2);
		$coeff_text		= round((2/count($true_words)),2);

		$query_news  = "SELECT SQL_CALC_FOUND_ROWS ";
		$query_news .= "id, title, source, author, text, ";

		$like_news_title  = "WHERE (title  LIKE '%".$search."%'";
		$like_news_source = "WHERE (source LIKE '%".$search."%'";
		$like_news_author = "WHERE (author LIKE '%".$search."%'";
		$like_news_text   = "WHERE (text   LIKE '%".$search."%'";
		foreach($true_words as $word)
		{
			$like_news_title  .= " OR title  LIKE '%".$word."%'";
			$like_news_source .= " OR source LIKE '%".$word."%'";
			$like_news_author .= " OR author LIKE '%".$word."%'";
			$like_news_text   .= " OR text   LIKE '%".$word."%'";
		}
		$for_count_news = "SELECT     COUNT(title)  FROM news ".$like_news_title." )";
		$for_count_news .= "+ (SELECT COUNT(source) FROM news ".$like_news_source."))";
		$for_count_news .= "+ (SELECT COUNT(author) FROM news ".$like_news_author."))";
		$for_count_news .= "+ (SELECT COUNT(text)   FROM news ".$like_news_text."  ))";

		$query_news .= "(IF   (title  LIKE '%".$search."%', 40, 0)";
		$query_news .= " + IF (source LIKE '%".$search."%', 15, 0)";
		$query_news .= " + IF (author LIKE '%".$search."%', 15, 0)";
		$query_news .= " + IF (text   LIKE '%".$search."%', 10, 0)";
		foreach($true_words as $word)
		{
			$query_news .= " + IF (title  LIKE '%".$word."%', ".$coeff_title.",  0)";
			$query_news .= " + IF (source LIKE '%".$word."%', ".$coeff_source.", 0)";
			$query_news .= " + IF (author LIKE '%".$word."%', ".$coeff_autor.",  0)";
			$query_news .= " + IF (text   LIKE '%".$word."%', ".$coeff_text.",   0)";
		}
		$like_news = " WHERE (title LIKE '%".$search."%' OR source LIKE '%".$search."%' OR author LIKE '%".$search."%' OR text LIKE '%".$search."%'";
		foreach($true_words as $word) {
			$like_news .= " OR title LIKE '%".$word."%'";
			$like_news .= " OR source LIKE '%".$word."%'";
			$like_news .= " OR author LIKE '%".$word."%'";
			$like_news .= " OR text LIKE '%".$word."%'";
		}
		$query_news .=") AS rel_news FROM news".$like_news;
		$query_news .= ") ORDER BY rel_news DESC LIMIT 0, 3";
		$q_news = $query_news;
		$count_news = $for_count_news;
	}

	if($table == "products")
	{
		$coeff_name		= round((15/count($true_words)),2);
		$coeff_pump_q	= round((5/count($true_words)),2);
		$coeff_pump_h	= round((5/count($true_words)),2);
		$coeff_pump_w	= round((5/count($true_words)),2);
		
		$query_products = "SELECT id,name,pump_q,pump_h,pump_w, ";
		$like_products_name = "WHERE (name LIKE '%".$search."%'";
		$like_products_pump_q = "WHERE (pump_q LIKE '%".$search."%'";
		$like_products_pump_h = "WHERE (pump_h LIKE '%".$search."%'";
		$like_products_pump_w = "WHERE (pump_w LIKE '%".$search."%'";
			foreach($true_words as $word) {
				$like_products_name .= " OR name LIKE '%".$word."%'";
				$like_products_pump_q .= " OR pump_q LIKE '%".$word."%'";
				$like_products_pump_h .= " OR pump_h LIKE '%".$word."%'";
				$like_products_pump_w .= " OR pump_w LIKE '%".$word."%'";
			}
		$for_count_products  = "SELECT (COUNT (name) FROM products ".$like_products_name.")";
		$for_count_products .= "+ (SELECT COUNT (pump_q) FROM products ".$like_products_pump_q."))";
		$for_count_products .= "+ (SELECT COUNT (pump_h) FROM products ".$like_products_pump_h."))";
		$for_count_products .= "+ (SELECT COUNT (pump_w) FROM products ".$like_products_pump_w.")))";
		$query_products .= "(IF (name LIKE '%".$search."%', 40, 0)";
		$query_products .= " + IF (pump_q LIKE '%".$search."%', 10, 0)";
		$query_products .= " + IF (pump_h LIKE '%".$search."%', 10, 0)";
		$query_products .= " + IF (pump_w LIKE '%".$search."%', 10, 0)";
			foreach($true_words as $word) {
				$query_products .= " + IF (name LIKE '%".$word."%', ".$coeff_name.", 0)";
				$query_products .= " + IF (pump_q LIKE '%".$word."%', ".$coeff_pump_q.", 0)";
				$query_products .= " + IF (pump_h LIKE '%".$word."%', ".$coeff_pump_h.", 0)";
				$query_products .= " + IF (pump_w LIKE '%".$word."%', ".$coeff_pump_w.", 0)";
			}
		$like_products = " WHERE(name LIKE '%".$search."%' OR pump_q LIKE '%".$search."%' OR pump_h LIKE '%".$search."%' OR pump_w LIKE '%".$search."%'";
			foreach($true_words as $word) {
				$like_products .= " OR name LIKE '%".$word."%'";
				$like_products .= " OR pump_q LIKE '%".$word."%'";
				$like_products .= " OR pump_h LIKE '%".$word."%'";
				$like_products .= " OR pump_w LIKE '%".$word."%'";
			}
		$query_products.=") AS rel_prod FROM products".$like_products;
		$query_products .= ") ORDER BY rel_prod DESC";
		$for_count_products .= " AS count_products ";
		$q_prod = $query_products;
		$count_prod = $for_count_products;
	}

	if($table == "record")
	{
		$coeff_title		= round((10/count($true_words)),2);
		$coeff_title_img	= round((4/count($true_words)),2);
		$coeff_category		= round((4/count($true_words)),2);
		$coeff_text			= round((2/count($true_words)),2);
		$query_record = "SELECT id,title,title_img,category,text, ";
		$like_record_title = "WHERE (title LIKE '%".$search."%'";
		$like_record_title_img = "WHERE (title_img LIKE '%".$search."%'";
		$like_record_category = "WHERE (category LIKE '%".$search."%'";
		$like_record_text = "WHERE (text LIKE '%".$search."%'";
			foreach($true_words as $word) {
				$like_record_title .= " OR title LIKE '%".$word."%'";
				$like_record_title_img .= " OR title_img LIKE '%".$word."%'";
				$like_record_category .= " OR category LIKE '%".$word."%'";
				$like_record_text .= " OR text LIKE '%".$word."%'";
			}
		$for_count_record = "SELECT (COUNT (title) FROM record ".$like_record_title.")";
		$for_count_record .= "+ (SELECT COUNT (title_img) FROM record ".$like_record_title_img."))";
		$for_count_record .= "+ (SELECT COUNT (category) FROM record ".$like_record_category."))";
		$for_count_record .= "+ (SELECT COUNT (text) FROM record ".$like_record_text.")))";
		$query_record .= "(IF (title LIKE '%".$search."%', 40, 0)";
		$query_record .= " + IF (title_img LIKE '%".$search."%', 15, 0)";
		$query_record .= " + IF (category LIKE '%".$search."%', 15, 0)";
		$query_record .= " + IF (text LIKE '%".$search."%', 10, 0)";
			foreach($true_words as $word) {
				$query_record .= " + IF (title LIKE '%".$word."%', ".$coeff_title.", 0)";
				$query_record .= " + IF (title_img LIKE '%".$word."%', ".$coeff_title_img.", 0)";
				$query_record .= " + IF (category LIKE '%".$word."%', ".$coeff_category.", 0)";
				$query_record .= " + IF (text LIKE '%".$word."%', ".$coeff_text.", 0)";
			}
		$like_record = " WHERE (title LIKE '%".$search."%' OR title_img LIKE '%".$search."%' OR category LIKE '%".$search."%' OR text LIKE '%".$search."%'";
			foreach($true_words as $word) {
				$like_record .= " OR title LIKE '%".$word."%'";
				$like_record .= " OR title_img LIKE '%".$word."%'";
				$like_record .= " OR category LIKE '%".$word."%'";
				$like_record .= " OR text LIKE '%".$word."%'";
			}
		$query_record.=") AS rel_rec FROM record".$like_record;
		$query_record .= ") ORDER BY rel_rec DESC";
		$for_count_record .= " AS count_record ";
		$q_rec = $query_record;
		$count_rec = $for_count_record;
	}
}

$i = 0;

?>
<!DOCTYPE html>
<html lang = "ru">

<head>
    <meta charset    = "UTF-8" />

    <meta content    = "IE = edge, chrome = 1"
          http-equiv = "X-UA-Compatible"
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
<div class='hold_admin' id='right_holder_admin'>
	<div class='navbar'>
		<a href='#top' class='scroll_to_top' title='Вернуться к началу страницы'><img src="img/arrow_top_oval.png"></a>
		<a href='javascript:history.back()' class='scroll_return' title='Вернуться обратно'><img src="img/arrow_return_oval.png"></a>
	</div>
</div>
<div id="wrapper">
	<?php include("block/header.php"); ?>
	<div id="header">
		<?php include("block/logo_search.php"); ?>
	</div>
	<div id="main">

		<?php
echo $send_query."<br/>";
$r_ab	= mysql_query($q_ab, $db);
$r_ab	= mysql_query($q_ab, $db);
$r_m_i	= mysql_query($q_m_i,$db);
$r_news	= mysql_query($q_news,$db);
$r_prod	= mysql_query($q_prod,$db);
$r_rec	= mysql_query($q_rec,$db);
echo $sum."<br/>";
$a = 0;
	$m_ab = mysql_fetch_array($r_ab);
	if($m_ab == TRUE){
			$a++;
				echo "
		<div id='num'>
			<p>".$a."</p>
		</div>
	<form action='about.php' method='post' id='result'>
		<div>
			<input type = 'hidden' value = ".$m_ab['id']." name = 'id'>";
//используем оператор IF в конструкции ECHO для проверки полученного значения. Если переменная $m_m_i['m_kd'] пустая - оператор ECHO ничего не выведит в ином случае - отдаст строку с кодом (Конструкция следующая ECHO (условие) ? "TRUE" : "FALSE";)
			echo empty($m_ab['title']) ? "<input type = 'submit' value = '... »»»' id='search'>" : "<input type = 'submit' value = '".$m_ab['title']."... »»»' id='search'>";
			echo empty($m_ab['text']) ? "...</p>" : substr($m_ab['text'],0,200)."...</p>";
		echo "</div>
	</form>";
	}
//}
while($m_m_i = mysql_fetch_array($r_m_i)){
	$a++;	echo "
		<div id='num'>
			<p>".$a."</p>
		</div>
	<form action='index.php' method='post' id='result'>
		<div>
			<input type = 'hidden' value = ".$m_m_i['id']." name = 'new'>";
			echo empty($m_m_i['m_kd']) ? "" : "<input type = 'submit' value = '".$m_m_i['m_kd']."... »»»' id='search'>";
			echo empty($m_m_i['text']) ? "" : substr($m_m_i['text'],0,200)."...</p>";
		echo"</div>
	</form>";
}
while($m_news = mysql_fetch_array($r_news)){
	$a++;	echo "
		<div id='num'>
			<p>".$a."</p>
		</div>
	<form action='news.php' method='post' id='result'>
		<div>
			<input type = 'hidden' value = ".$m_news['id']." name = 'new'>
			<input type = 'submit' value = '".$m_news['title']."... »»»' id='search'>";
			if(empty($m_news['source']) && empty($m_news['author'])){
					$pt_new = "";
				}elseif(empty($m_news['author'])){
						$pt_new = "<p>".$m_news['source']."</p>";
					}elseif(empty($m_news['source'])){
							$pt_new = "<p><span> добавил: ".$m_news['author']."</span></p>";
						}else{
							$pt_new = "<p>".$m_news['source']."<span> добавил: ".$m_news['author']."</span></p>";
						}
			echo $pt_new;
			echo empty($m_news['text']) ? "" : substr($m_news['text'],0,200)."...</p>";
		echo "</div>
	</form>";
}
while($m_prod = mysql_fetch_array($r_prod)){
	$a++;	echo "
		<div id='num'>
			<p>".$a."</p>
		</div>
	<form action='products.php' method='post' id='result'>
		<div>
			<input type = 'hidden' value = ".$m_prod['id']." name = 'id'>
			<input type = 'submit' value = '".$m_prod['name']."... »»»' id='search'>
			<p id='qtxt'>Напор: <strong>".$m_prod['pump_q']."</strong> м, подача: <strong>".$m_prod['pump_h']."</strong> м, мощность эл.двигателя: <strong>".$m_prod['pump_w']."</strong> кВт</p>
		</div>
	</form>";
}
while($m_rec = mysql_fetch_array($r_rec)){
	$a++;	echo "
		<div id='num'>
			<p>".$a."</p>
		</div>
	<form action='record.php' method='post' id='result'>
		<div>
			<input type = 'hidden' value = ".$m_rec['id']." name = 'rec'>
			<input type = 'submit' value = '".substr($m_rec['title'],0,50)."... »»»' id='search'>
			";
			if(empty($m_rec['title_img']) && empty($m_rec['category'])){
					$pt_rec = "";
				}elseif(empty($m_rec['category'])){
						$pt_rec = "<p><strong>".$m_rec['title_img']."</strong></p>";
					}elseif(empty($m_rec['title_img'])){
							$pt_rec = "<p>добавил: <span>".$m_rec['category']."</span></p>";
						}else{
							$pt_rec = "<p><strong>".$m_rec['title_img']."</strong><span> категория: <strong>".$m_rec['category']."</strong></span></p>";
						}
			echo $pt_rec;
			echo substr($m_rec['text'],0,200)."...</p>
		</div>
	</form>";
}
?></div>
	</div>
</div>
	<?php include("block/footer.php"); ?>
	</body>
</html>