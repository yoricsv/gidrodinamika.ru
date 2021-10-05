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
				��� �����������:
			</strong> 
			".$name." 
			\r\n";
			
		$text .= 
			"<br/>
			<strong>
				E-mail �����������:
			</strong> 
			".$from." 
			\r\n";
			
		$text .=
			"<br/>
			<strong>
				������� �����������:
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
		   title = '��������� � ������ ��������'
		>
			<img src = "img/arrow_top_oval.png" />
		</a>
		
		<a class = 'scroll_return'
		   href  = 'javascript:history.back()'
		   title = '��������� �������'
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
				��������� � ����
			</span>
			<span class = "desc">
				��������� ��� ���������.
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
							�����
						</strong>
					</a>
				</div>";
		}




	if(	    isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
		&& !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
		&&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' 
		&& !empty($_POST['name']))
	{
		$message  = '���: '.$_POST['name'] . ' ';
		$message .= '�������: '.$_POST['phone'] . ' ';
		if(!empty($_POST['text']))
		{
			$message = '�����: ' . $_POST['text'] . ' ';
		}
		
		$mailTo   = "mail@mail.ru"; 	// ��� e-mail
		$subject  = "������ � �����"; 	// ���� ���������
		$from     = "info@site.ru"; 	// ����� �����������
		
		$boundary = "---"; 				//�����������
		/* ��������� */
		$headers  = "From: $from\nReply-To: $from\n";
		$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"";
		$body     = "--$boundary\n";
		/* ������������ ��������� ��������� */
		$body    .= "Content-type: text/html; charset='utf-8'\n";
		$body    .= "Content-Transfer-Encoding: quoted-printablenn";
		$body    .= "Content-Disposition: attachment; filename==?utf-8?B?".base64_encode($filename)."?=\n\n";
		$body    .= $message."\n";
		$body    .= "--$boundary\n";
		
		if ($_FILES['file']['error'] == UPLOAD_ERR_OK)
		{
			// �������� ���������� ��������� �����
			$ext = strtolower(
					pathinfo(
						$_FILES['file']['name'],
						PATHINFO_EXTENSION)
			);
			// �������� ���������� ��� ��� ������� ����� ������� ���� 
			$filename = md5(uniqid('', true)).'.'.$ext;
			
			// ���������� ���� �� ���������� ��������� � ��������� ����������
			if ( move_uploaded_file($_FILES['file']['tmp_name'],
				 'uploads/'.$filename))
			{
				$file = fopen ($filename, "r"); 			//��������� ����
				$text = fread ($file, filesize($filename)); //��������� ���� ����
						fclose($file); 						//��������� ����
			}
		}
		
		/* ��������� ��� �����������, �������� ����� ����� � ��������� � ���� ������ */
		$body 	.= "Content-Type: application/octet-stream; name==?utf-8?B?".base64_encode($filename)."?=\n";
		$body  	.= "Content-Transfer-Encoding: base64\n";
		$body 	.= "Content-Disposition: attachment; filename==?utf-8?B?".base64_encode($filename)."?=\n\n";
		$body 	.= chunk_split(base64_encode($text))."\n";
		$body 	.= "--".$boundary ."--\n";
		
		if(mail($mailTo, $subject, $body, $headers))
			echo "�������! �� �������� � ���� � ����� ��������� �����!"; 
		else
			echo "��������� �� ����������!"; 
	}

		
//////////////////////|�������� ������ � ������������� ������|////////////////////////
		function XMail($from, $to, $subj, $text, $filename, $file)
		{							//
			$f		=	fopen($file, "rb");												//
			$un		=	strtoupper(uniqid(time()));										//
			$head	=	"From: ".$from."\n";											//
			$head	.=	"To: ".$to."\n";												//
			$head	.=	"Subject: ".$subj."\n";											//
			$head	.=	"X-Mailer: PHPMail Tool\n";										//
	//		$head	.=	"Reply-To: ".$from."\n";										//�������� ���� ���� ���������� ����� ������ �� ����� ���� ����
			$head	.=	"Mime-Version: 1.0\n";											//
			$head	.=	"Content-Type:multipart/mixed;";								//
	//		$head	.=	"Content-type:text/plain; charset = windows-1251";				//�������� ���� ����������� ����� ���������� ������� �������
			$head	.=	"boundary=\"----------".$un."\"\n\n";							//
			$zag	=	"------------".$un."\nContent-Type:text/html;\n";				//
			$zag	.=	"Content-Transfer-Encoding: 8bit\n\n$text\n\n";					//
			$zag	.=	"------------".$un."\n";										//
			$zag	.=	"Content-Type: application/octet-stream;";						//
			$zag	.=	"name=\"".basename($filename)."\"\n";							//
			$zag	.=	"Content-Transfer-Encoding:base64\n";							//
			$zag	.=	"Content-Disposition:attachment;";								//
			$zag	.=	"filename=\"".basename($filename)."\"\n\n";						//
			$zag	.=	chunk_split(base64_encode(fread($f, filesize($file))))."\n";	//�������������� ������ � ������������ � RFC 2045
			if(mail("$to", "$subj", $zag, $head)){										//
					return TRUE;														//
				}else{																	//
					return FALSE;														//
				}																		//
		}																				//
//////////////////////////////////////////////////////////////////////////////////////




	$subject = "���� ������"; 
	$message = "����� ���������"; 	// ����� ���������, ����� �� ������ ��������� �������,
									// �������, ���������, ���������� ������ � �.�.
	$filename = "file.doc";			// �������� �����
	$filepath = "files/file.doc";	// ����������������� �����

// ������ � ��������� ������� �� ���������� ������, ������� ����������� ������������
	$boundary = "--".md5(uniqid(time())); // ���������� �����������

	$mailheaders  = "MIME-Version: 1.0;\r\n"; 
	$mailheaders .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n"; 
	// ����������� ����������� � ��������� � ��������� boundary 

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
							   $message))); // ������ ����� ���� ���������

	$fp   = fopen($filepath,"r"); // ���������� ����
	
	if (!$fp) 
	{ 
		print "�� ������� ������� ����22"; 
		exit(); 
	} 

	$file = fread( $fp, filesize($filepath)); // ������ �����
		    fclose($fp); 

	$message_part = "\r\n--$boundary\r\n"; 
	$message_part .= "Content-Type: application/octet-stream; name=\"$filename\"\r\n";  
	$message_part .= "Content-Transfer-Encoding: base64\r\n"; 
	$message_part .= "Content-Disposition: attachment; filename=\"$filename\"\r\n"; 
	$message_part .= \r\n;
	$message_part .= chunk_split(base64_encode($file));
	$message_part .= "\r\n--$boundary--\r\n"; // ������ ������ ����������� ����, ����� ���������� ��� � ����� �����

	$multipart .= $message_part;

	mail($to,$subject,$multipart,$mailheaders); // ���������� ������

	//������� ����� ����� 60 ���.
	if (time_nanosleep(5, 0))
		unlink($filepath);
	// �������� �����






// ������ �������������
$file 	 = "./files/test.txt"; // ����
$mailTo  = "admin@vk-book.ru"; // ����
$from 	 = "test@files.com"; // �� ����
$subject = "Test file"; // ���� ������
$message = "�������� ������ � ���������"; // ����� ������
$r       = sendMailAttachment($mailTo, $from, $subject, $message, $file); // �������� ������ c ���������

echo 
	($r)
	?
		'������ ����������'
	:
		'������. ������ �� ����������!';
//$r = sendMailAttachment($mailTo, $from, $subject, $message); // �������� ������ ��� ��������
//echo ($r)?'������ ����������':'������. ������ �� ����������!';
 
/**
* �������� ������ � ���������
* @param string $mailTo
* @param string $from
* @param string $subject
* @param string $message
* @param string|bool $file - �� ������������ ��������, ���� �� �����
* 
* @return bool - ��������� ��������
*/
 
function sendMailAttachment($mailTo, $from, $subject, $message, $file = false)
{
    $separator = "---"; // ����������� � ������
    // ��������� ��� ������
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "From: $from\nReply-To: $from\n"; // ������ �� ���� ������
    $headers .= "Content-Type: multipart/mixed; boundary=\"$separator\""; // � ��������� ��������� �����������
    
    if($file) // ���� ������ � ���������
	{
        $bodyMail  = "--$separator\n"; 								// ������ ���� ������, ������� �����������
        $bodyMail .= "Content-type: text/html; charset='utf-8'\n"; 	// ��������� ������
        $bodyMail .= "Content-Transfer-Encoding: quoted-printable"; // ������ ����������� ������
        $bodyMail .= "Content-Disposition: attachment; filename==?utf-8?B?"
					 .base64_encode(basename($file)).
					 "?=\n\n"; // ������ �������� �����
					 
        $bodyMail .= $message."\n"; // ��������� ����� ������
        $bodyMail .= "--$separator\n";
		
        $fileRead    = fopen ($file, "r"); 					// ��������� ����
        $contentFile = fread ($fileRead, filesize($file));	// ��������� ��� �� �����
					   fclose($fileRead);					// ��������� ����
		
        $bodyMail .= "Content-Type: application/octet-stream; name==?utf-8?B?".base64_encode(basename($file))."?=\n"; 
        $bodyMail .= "Content-Transfer-Encoding: base64\n"; // ��������� �����
        $bodyMail .= "Content-Disposition: attachment; filename==?utf-8?B?".base64_encode(basename($file))."?=\n\n";
        $bodyMail .= chunk_split(base64_encode($contentFile))."\n"; // �������� � ����������� ����
        $bodyMail .= "--".$separator ."--\n";
    // ������ ��� ��������
    }
	else
        $bodyMail = $message;
	
    $result = mail(			 // �������� ������
		$mailTo,
		$subject,
		$bodyMail,
		$headers
	);
	
    return $result;
}








if($ret_send==1){
	echo $rn==0?"<p>�� �� ������� ������ �����.<p><br/>":"";
	echo $re==0?"<p>�� �� ������� ��� E-MAIL �����.<p><br/>":"";
	echo $rp==0?"<p>�� �� ������� ����� �������� ��� ����� � ����.<p><br/>":"";
	echo $rs==0?"<p>�� �� �������� ������ � ���������.<p><br/>":"";
	if($from=="post@example.com"||$from=="mail@gidrodinamika.ru"){
			unset($from);
			echo"<p>�� �� ������� ��� E-MAIL �����.<p><br/>";
		}
	if($phone=="+7(495)-123-45-67"){
			unset($phone);
			echo"<p>�� �� ������� ����� �������� ��� ����� � ����.<p><br/>";
		}
	if($rn==0||$re==0||$rp==0||$rs==0){
			echo"<p id = 'error'>��������� ������� � ��������� ��� ���� �� ���������� (*)</p><br/>".back_page();
		}else{
/////////////////|����� �������� ����� ����� ��������� ������ � ������������� ������ ��� ���|/////////////////
			if($filename != "" and $file_size > 0){															//
						if(XMail($from, $to, $subj, $text, $filename, $tmpname)){							//
								echo"<p id = 'success'>������� �� ���� ���������. </p><br/>".back_page();		//
							}else{																			//
								echo"<p id = 'error'>�� ���� ��������� ������ !</p><br/>".back_page();			//
							}																				//
					}else{ //���� �� ���������� ����														//
						if(mail($to, $subj, $text, $headers)){												//
								echo"<p id = 'success'>������� �� ���� ���������.</p><br/>".back_page();		//
							}else{																			//
								echo"<p id = 'error'>�� ���� ��������� ������ !</p><br/>".back_page();			//
							}																				//
					}																						//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////|������ �������� ��������|////////////////////////////////////////////////////////////
//			echo mail($to,$subj,$text,$headers)?"<p id = 'success'>������� �� ���� ���������.</p><br/>".back_page():"<p id = 'error'>�� ���� ��������� ������ !</p><br/>".back_page();//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
	}else{
		echo <<<here
<h5 class = 'custom'>����������� ����� ����, ����� ��������� ��� ���� ������</h5>
<form id = 'formMail' action='contact.php' method='post' enctype = 'multipart/form-data'>
	<fieldset>
		<p><label>��� * :<span> (������: ������ ���� ��������)</span></label><input name = 'name' id = 'name' type = 'text' value = ''/></p>
		<p><label>��� E-MAIL * :<span> (������: post@example.com )</span></label><input name = 'from' id = 'from' type = 'text' value = ''/></p>
		<p><label>���������� ������� * :<span> (������: +7(495)-123-45-67 )</span></label><input name = 'phone' id = 'phone' type = 'text' value = ''/></p>
		<p><label>����:</label><input name = 'subj' id = 'subj' type = 'text'/></p>
		<p><label>������ * :</label><textarea name = 'text' id = 'text' rows = '5' cols = '20'></textarea></p>
		<p><label>���������� ����:</label><input type = "file" name = "file" id = "file"></p><!--|������ ���������� ����� � ������|-->
		<p><input type = 'submit' value = '���������' name = 'send' id = 'send'/></p>
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