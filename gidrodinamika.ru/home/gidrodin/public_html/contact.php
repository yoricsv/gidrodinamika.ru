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
		page = 'contact'");
	
$myrow  = mysqli_fetch_array($result);
		  mysqli_close($db);



if( isset($_REQUEST['send']))
{
	if( empty($_REQUEST['name']))
	{
		unset($_REQUEST['name']);
		$rn   = 0;
	}
	else
	{
		$name = $_REQUEST['name'];
		$name = substr($name, 0, 80);
		$rn   = 1;
	}//$NAME

	
	if( empty($_REQUEST['from']))
	{
		unset($_REQUEST['from']);
		$re   = 0;
	}
	else
	{
		$from = $_REQUEST['from'];
		$from = trim(html_filter($from));
		$from = substr($from, 0, 50);
		$re   = 1;
	}//$FROM


	if( empty($_REQUEST['phone']))
	{
		unset($_REQUEST['phone']);
		$rp    = 0;
	}
	else
	{
		$phone = $_REQUEST['phone'];
		$phone = substr($phone, 0, 40);
		$rp    = 1;
	}//$PHONE


	if( empty($_REQUEST['text']))
	{
		unset($_REQUEST['text']);
		$rs = 0;
	}
	else
	{
		$text  = $_REQUEST['text'];
		$text  = trim(html_filter($text));
		$text  = str_replace("\n", "<br/>\n", $text);
		$text  = substr($text, 0, 2000);
		
		$text .= 
			"<br/>
			<br/>
			<strong>
				Имя отправителя:
			</strong> 
			".$name." 
			\r\n";
			
		$text .= 
			"<br/>
			<strong>
				E-mail отправителя:
			</strong> 
			".$from." 
			\r\n";
			
		$text .=
			"<br/>
			<strong>
				Телефон отправителя:
			</strong> 
			".$phone." 
			\r\n";
		
		$rs = 1;
	}

/////////////////| Check the received file |/////////////////
	if( empty($_FILES['file']))							//C//
		unset($_FILES['file']);							//H//
	else												//E//
	{													//C//
		$file_name = $_FILES['file']['name'];			//K//
		$tmp_name  = $_FILES['file']['tmp_name'];		/////
		$file_size = intval($_FILES['file']['size']);	//F//
		$filename  = trim(html_filter($file_name));		//I//
		$tmpname   = trim(html_filter($tmp_name));		//L//
	}													//E//
/////////////////////////////////////////////////////////////

	if( empty($_REQUEST['subj']))
		$subj = "";
	else
	{
		$subj = $_REQUEST['subj'];
		$subj = trim(html_filter($subj));
		$subj = substr($subj, 0, 200);
	}




		$headers  = "X-Mailer	  : PHPMail Tool\n";
		$headers .= "MIME-Version : 1.0\r\n";
		
		$headers .= "Content-type : text/html;
					 charset	  = windows-1251\r\n";

		$headers .= "From		  : GIDRODINAMIKA 
									<mail@gidrodinamika.ru>\r\n";

//		$headers .= 
//			"Sender e-mail: 
//			<strong>
//				".$_SERVER['HTTP_REFERER']."
//			</strong>
//			<br/>";
			
//		$headers .= 
//			"Sender IP address: 
//			<strong>
//				".$_SERVER['REMOTE_ADDR']."
//			</strong>
//			<br/>
//			<br/>\r\n";


		include("block/db.php");

		$res_to = mysqli_query($db,
			"SELECT
				*
			FROM
				contact");

		$my_to  = mysqli_fetch_array($res_to);

		$to     = "<".$my_to['to'].">";

		while( $my_to = mysqli_fetch_array($res_to))
			$to.=", <".$my_to['to'].">";

		mysqli_close($db);

		
		$to       = trim($to);
		$ret_send = 1;
	}else{
		$ret_send=0;
	}?>
	
	
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

		<img  alt   = "Active"
			  class = "arrow-contact"
			  id    = "arrow-bottom"
			  src   = "img/nav-arrow.png"
		/>
	</div>
	
	<div id = "main">
		<p class = "section-title">
			<span class = "title custom">
				Связаться с нами
			</span>
			<span class = "desc">
				Отправьте нам сообщение.
			</span>
		</p>
		<div class = "contact-left">

		<?php
		function html_filter($str)
		{
			$result = htmlspecialchars($str);
			return $result;
		}
		
		function isEmail($email)
		{
			if( eregi(
					"^[a-z0-9]+([-_\.]?[a-z0-9])
				    +@[a-z0-9]+([-_\.]?[a-z0-9])
					+\.[a-z]+$",
					$email))
				return TRUE;
			else
				return FALSE;
		}
		
		function back_page()
		{
			echo
				"<div id = 'backlink_rec'>
					<a class = 'more'
					   href  = 'javascript:history.back()'
					>
						<strong>
							Назад
						</strong>
					</a>
				</div>";
		}




	if(	    isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
		&& !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
		&&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' 
		&& !empty($_POST['name']))
	{
		$message  = 'Имя: '.$_POST['name'] . ' ';
		$message .= 'Телефон: '.$_POST['phone'] . ' ';
		if(!empty($_POST['text']))
		{
			$message = 'Текст: ' . $_POST['text'] . ' ';
		}
		
		$mailTo   = "mail@mail.ru"; 	// Ваш e-mail
		$subject  = "Письмо с сайта"; 	// Тема сообщения
		$from     = "info@site.ru"; 	// Почта отправителя
		
		$boundary = "---"; 				//Разделитель
		/* Заголовки */
		$headers  = "From: $from\nReply-To: $from\n";
		$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"";
		$body     = "--$boundary\n";
		/* Присоединяем текстовое сообщение */
		$body    .= "Content-type: text/html; charset='utf-8'\n";
		$body    .= "Content-Transfer-Encoding: quoted-printablenn";
		$body    .= "Content-Disposition: attachment; filename==?utf-8?B?".base64_encode($filename)."?=\n\n";
		$body    .= $message."\n";
		$body    .= "--$boundary\n";
		
		if ($_FILES['file']['error'] == UPLOAD_ERR_OK)
		{
			// получаем расширение исходного файла
			$ext = strtolower(
					pathinfo(
						$_FILES['file']['name'],
						PATHINFO_EXTENSION)
			);
			// получаем уникальное имя под которым будет сохранён файл 
			$filename = md5(uniqid('', true)).'.'.$ext;
			
			// перемещаем файл из временного хранилища в указанную директорию
			if ( move_uploaded_file($_FILES['file']['tmp_name'],
				 'uploads/'.$filename))
			{
				$file = fopen ($filename, "r"); 			//Открываем файл
				$text = fread ($file, filesize($filename)); //Считываем весь файл
						fclose($file); 						//Закрываем файл
			}
		}
		
		/* Добавляем тип содержимого, кодируем текст файла и добавляем в тело письма */
		$body 	.= "Content-Type: application/octet-stream; name==?utf-8?B?".base64_encode($filename)."?=\n";
		$body  	.= "Content-Transfer-Encoding: base64\n";
		$body 	.= "Content-Disposition: attachment; filename==?utf-8?B?".base64_encode($filename)."?=\n\n";
		$body 	.= chunk_split(base64_encode($text))."\n";
		$body 	.= "--".$boundary ."--\n";
		
		if(mail($mailTo, $subject, $body, $headers))
			echo "Спасибо! Мы свяжемся с вами в самое ближайшее время!"; 
		else
			echo "Сообщение не отправлено!"; 
	}

		
//////////////////////|Отправка письма с прикрепленным файлом|////////////////////////
		function XMail($from, $to, $subj, $text, $filename, $file)
		{							//
			$f		=	fopen($file, "rb");												//
			$un		=	strtoupper(uniqid(time()));										//
			$head	=	"From: ".$from."\n";											//
			$head	.=	"To: ".$to."\n";												//
			$head	.=	"Subject: ".$subj."\n";											//
			$head	.=	"X-Mailer: PHPMail Tool\n";										//
	//		$head	.=	"Reply-To: ".$from."\n";										//Включить если надо отправлять копию письма на какай либо ящик
			$head	.=	"Mime-Version: 1.0\n";											//
			$head	.=	"Content-Type:multipart/mixed;";								//
	//		$head	.=	"Content-type:text/plain; charset = windows-1251";				//Включить если некорректно будут отображены русские символы
			$head	.=	"boundary=\"----------".$un."\"\n\n";							//
			$zag	=	"------------".$un."\nContent-Type:text/html;\n";				//
			$zag	.=	"Content-Transfer-Encoding: 8bit\n\n$text\n\n";					//
			$zag	.=	"------------".$un."\n";										//
			$zag	.=	"Content-Type: application/octet-stream;";						//
			$zag	.=	"name=\"".basename($filename)."\"\n";							//
			$zag	.=	"Content-Transfer-Encoding:base64\n";							//
			$zag	.=	"Content-Disposition:attachment;";								//
			$zag	.=	"filename=\"".basename($filename)."\"\n\n";						//
			$zag	.=	chunk_split(base64_encode(fread($f, filesize($file))))."\n";	//Форматирование данных в соответствии с RFC 2045
			if(mail("$to", "$subj", $zag, $head)){										//
					return TRUE;														//
				}else{																	//
					return FALSE;														//
				}																		//
		}																				//
//////////////////////////////////////////////////////////////////////////////////////




	$subject = "тема письма"; 
	$message = "Текст сообщения"; 	// текст сообщения, здесь вы можете вставлять таблицы,
									// рисунки, заголовки, оформление цветом и т.п.
	$filename = "file.doc";			// название файла
	$filepath = "files/file.doc";	// месторасположение файла

// письмо с вложением состоит из нескольких частей, которые разделяются разделителем
	$boundary = "--".md5(uniqid(time())); // генерируем разделитель

	$mailheaders  = "MIME-Version: 1.0;\r\n"; 
	$mailheaders .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n"; 
	// разделитель указывается в заголовке в параметре boundary 

	$mailheaders .= "From: $user_email <$user_email>\r\n"; 
	$mailheaders .= "Reply-To: $user_email\r\n"; 

	$multipart = "--$boundary\r\n"; 
	$multipart .= "Content-Type: text/html; charset=windows-1251\r\n";
	$multipart .= "Content-Transfer-Encoding: base64\r\n";    
	$multipart .= \r\n;
	$multipart .= chunk_split(
					base64_encode(
						iconv( "utf8",
							   "windows-1251",
							   $message))); // первая часть само сообщение

	$fp   = fopen($filepath,"r"); // Закачиваем файл
	
	if (!$fp) 
	{ 
		print "Не удается открыть файл22"; 
		exit(); 
	} 

	$file = fread( $fp, filesize($filepath)); // чтение файла
		    fclose($fp); 

	$message_part = "\r\n--$boundary\r\n"; 
	$message_part .= "Content-Type: application/octet-stream; name=\"$filename\"\r\n";  
	$message_part .= "Content-Transfer-Encoding: base64\r\n"; 
	$message_part .= "Content-Disposition: attachment; filename=\"$filename\"\r\n"; 
	$message_part .= \r\n;
	$message_part .= chunk_split(base64_encode($file));
	$message_part .= "\r\n--$boundary--\r\n"; // второй частью прикрепляем файл, можно прикрепить два и более файла

	$multipart .= $message_part;

	mail($to,$subject,$multipart,$mailheaders); // отправляем письмо

	//удаляем файлы через 60 сек.
	if (time_nanosleep(5, 0))
		unlink($filepath);
	// удаление файла






// пример использования
$file 	 = "./files/test.txt"; // файл
$mailTo  = "admin@vk-book.ru"; // кому
$from 	 = "test@files.com"; // от кого
$subject = "Test file"; // тема письма
$message = "Тестовое письмо с вложением"; // текст письма
$r       = sendMailAttachment($mailTo, $from, $subject, $message, $file); // отправка письма c вложением

echo 
	($r)
	?
		'Письмо отправлено'
	:
		'Ошибка. Письмо не отправлено!';
//$r = sendMailAttachment($mailTo, $from, $subject, $message); // отправка письма без вложения
//echo ($r)?'Письмо отправлено':'Ошибка. Письмо не отправлено!';
 
/**
* Отправка письма с вложением
* @param string $mailTo
* @param string $from
* @param string $subject
* @param string $message
* @param string|bool $file - не обязательный параметр, путь до файла
* 
* @return bool - результат отправки
*/
 
function sendMailAttachment($mailTo, $from, $subject, $message, $file = false)
{
    $separator = "---"; // разделитель в письме
    // Заголовки для письма
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "From: $from\nReply-To: $from\n"; // задаем от кого письмо
    $headers .= "Content-Type: multipart/mixed; boundary=\"$separator\""; // в заголовке указываем разделитель
    
    if($file) // если письмо с вложением
	{
        $bodyMail  = "--$separator\n"; 								// начало тела письма, выводим разделитель
        $bodyMail .= "Content-type: text/html; charset='utf-8'\n"; 	// кодировка письма
        $bodyMail .= "Content-Transfer-Encoding: quoted-printable"; // задаем конвертацию письма
        $bodyMail .= "Content-Disposition: attachment; filename==?utf-8?B?"
					 .base64_encode(basename($file)).
					 "?=\n\n"; // задаем название файла
					 
        $bodyMail .= $message."\n"; // добавляем текст письма
        $bodyMail .= "--$separator\n";
		
        $fileRead    = fopen ($file, "r"); 					// открываем файл
        $contentFile = fread ($fileRead, filesize($file));	// считываем его до конца
					   fclose($fileRead);					// закрываем файл
		
        $bodyMail .= "Content-Type: application/octet-stream; name==?utf-8?B?".base64_encode(basename($file))."?=\n"; 
        $bodyMail .= "Content-Transfer-Encoding: base64\n"; // кодировка файла
        $bodyMail .= "Content-Disposition: attachment; filename==?utf-8?B?".base64_encode(basename($file))."?=\n\n";
        $bodyMail .= chunk_split(base64_encode($contentFile))."\n"; // кодируем и прикрепляем файл
        $bodyMail .= "--".$separator ."--\n";
    // письмо без вложения
    }
	else
        $bodyMail = $message;
	
    $result = mail(			 // отправка письма
		$mailTo,
		$subject,
		$bodyMail,
		$headers
	);
	
    return $result;
}








if($ret_send==1){
	echo $rn==0?"<p>Вы не указали своего ИМЕНИ.<p><br/>":"";
	echo $re==0?"<p>Вы не указали ваш E-MAIL адрес.<p><br/>":"";
	echo $rp==0?"<p>Вы не указали НОМЕР ТЕЛЕФОНА для связи с вами.<p><br/>":"";
	echo $rs==0?"<p>Вы не написали ничего в СООБЩЕНИИ.<p><br/>":"";
	if($from=="post@example.com"||$from=="mail@gidrodinamika.ru"){
			unset($from);
			echo"<p>Вы не указали ваш E-MAIL адрес.<p><br/>";
		}
	if($phone=="+7(495)-123-45-67"){
			unset($phone);
			echo"<p>Вы не указали НОМЕР ТЕЛЕФОНА для связи с вами.<p><br/>";
		}
	if($rn==0||$re==0||$rp==0||$rs==0){
			echo"<p id = 'error'>Вернитесь обратно и заполните все поля со звездочкой (*)</p><br/>".back_page();
		}else{
/////////////////|Новая редакция выбор между отправкой письма с прикрепленным файлом или без|/////////////////
			if($filename != "" and $file_size > 0){															//
						if(XMail($from, $to, $subj, $text, $filename, $tmpname)){							//
								echo"<p id = 'success'>Спасибо за ваше сообщение. </p><br/>".back_page();		//
							}else{																			//
								echo"<p id = 'error'>Не могу отправить письмо !</p><br/>".back_page();			//
							}																				//
					}else{ //Если Не прикреплен файл														//
						if(mail($to, $subj, $text, $headers)){												//
								echo"<p id = 'success'>Спасибо за ваше сообщение.</p><br/>".back_page();		//
							}else{																			//
								echo"<p id = 'error'>Не могу отправить письмо !</p><br/>".back_page();			//
							}																				//
					}																						//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////|старая редакция отправки|////////////////////////////////////////////////////////////
//			echo mail($to,$subj,$text,$headers)?"<p id = 'success'>Спасибо за ваше сообщение.</p><br/>".back_page():"<p id = 'error'>Не могу отправить письмо !</p><br/>".back_page();//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
	}else{
		echo <<<here
<h5 class = 'custom'>Используйте форму ниже, чтобы отправить нам Ваше письмо</h5>
<form id = 'formMail' action='contact.php' method='post' enctype = 'multipart/form-data'>
	<fieldset>
		<p><label>ИМЯ * :<span> (Пример: Иванов Иван Иванович)</span></label><input name = 'name' id = 'name' type = 'text' value = ''/></p>
		<p><label>Ваш E-MAIL * :<span> (Пример: post@example.com )</span></label><input name = 'from' id = 'from' type = 'text' value = ''/></p>
		<p><label>Контактный телефон * :<span> (Пример: +7(495)-123-45-67 )</span></label><input name = 'phone' id = 'phone' type = 'text' value = ''/></p>
		<p><label>Тема:</label><input name = 'subj' id = 'subj' type = 'text'/></p>
		<p><label>ПИСЬМО * :</label><textarea name = 'text' id = 'text' rows = '5' cols = '20'></textarea></p>
		<p><label>Прикрепить файл:</label><input type = "file" name = "file" id = "file"></p><!--|Кнопка добавления файла к письму|-->
		<p><input type = 'submit' value = 'Отправить' name = 'send' id = 'send'/></p>
	</fieldset>
</form>
here;
	}?>
	</div>
	<?php echo $myrow['text'];?>
</div>
</div>
	<?php include("block/footer.php");?>
	</body>
</html>