<?php include("block/db.php");
include("block/filter_array_post_get_request.php");
$result=mysql_query("SELECT meta_d,meta_k,title,text FROM settings WHERE page='contact'",$db);
$myrow=mysql_fetch_array($result);
mysql_close($db);
if(isset($_REQUEST['send'])){
		if(empty($_REQUEST['name'])){
				unset($_REQUEST['name']);
				$rn=0;
			}else{
				$name=$_REQUEST['name'];
				$name=substr($name,0,80);
				$rn=1;
			}//$NAME
		if(empty($_REQUEST['from'])){
				unset($_REQUEST['from']);
				$re=0;
			}else{
				$from=$_REQUEST['from'];
				$from=trim(html_filter($from));		//	sanitize($from);
				$from=substr($from,0,50);
				$re=1;
			}//$FROM
		if(empty($_REQUEST['phone'])){
				unset($_REQUEST['phone']);
				$rp=0;
			}else{
				$phone=$_REQUEST['phone'];
				$phone=substr($phone,0,40);
				$rp=1;
			}//$PHONE
		if(empty($_REQUEST['text'])){
				unset($_REQUEST['text']);
				$rs=0;
			}else{
				$text=$_REQUEST['text'];
				$text=trim(html_filter($text));		//	sanitize($text);
				$text=str_replace("\n","<br>\n",$text);
				$text=substr($text,0,2000);
				$text.="<br><br><strong>��� �����������:</strong> ".$name." \r\n";
				$text.="<br><strong>E-mail �����������:</strong> ".$from." \r\n";
				$text.="<br><strong>���������� ������� �����������:</strong> ".$phone." \r\n";$rs=1;}
//				$rs=1;
///////////////| �������� �������� �������������� ����� |////////////////
		if(empty($_FILES['file'])){									//C//
				unset($_FILES['file']);								//H//
			}else{													//E//
				$file_name	=	$_FILES['file']['name'];			//C//
				$tmp_name	=	$_FILES['file']['tmp_name'];		//K//
				$file_size	=	intval($_FILES['file']['size']);	//F//
				$filename	=	trim(html_filter($file_name));		//I//	sanitize($file_name);
				$tmpname	=	trim(html_filter($tmp_name));		//L//	sanitize($tmp_name);
			}														//E//
/////////////////////////////////////////////////////////////////////////
		if(!empty($_REQUEST['subj'])){
				$subj=$_REQUEST['subj'];
				$subj=trim(html_filter($subj));		//	trim(html_filter($subj));sanitize($subj);
				$subj=substr($subj,0,200);
			}else{
				$subj="";
			}
		$headers="X-Mailer: PHPMail Tool\n";
		$headers.="MIME-Version: 1.0\r\n";
		$headers.="Content-type: text/html; charset=windows-1251\r\n";
		$headers.="From: GIDRODINAMIKA <mail@gidrodinamika.ru>\r\n";
//		$headers.="���������� � �����: <strong>".$_SERVER['HTTP_REFERER']."</strong><br>";
//		$headers.=" IP-����� �����������: <strong>".$_SERVER['REMOTE_ADDR']."</strong><br><br>\r\n";
		include("block/db.php");
		$res_to=mysql_query("SELECT * FROM contact",$db);
		$my_to=mysql_fetch_array($res_to);
		$to="<".$my_to['to'].">";
		while($my_to = mysql_fetch_array($res_to)){
			$to.=", <".$my_to['to'].">";
		}mysql_close($db);
			$to=trim($to);
			$ret_send=1;
	}else{
		$ret_send=0;
	}?>
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
		<a href='#top' class='scroll_to_top' title='��������� � ������ ��������'><img src="img/arrow_top_oval.png"></a>
		<a href='javascript:history.back()' class='scroll_return' title='��������� �������'><img src="img/arrow_return_oval.png"></a>
	</div>
</div>
<div id="wrapper">
	<?php include("block/header.php");?>
	<div id="header">
		<?php include("block/logo_search.php");?>
		<img src="img/nav-arrow.png" alt="Active" id="arrow-bottom" class="arrow-contact"/>
	</div>
<div id="main">
	<p class="section-title"><span class="title custom">��������� � ����</span><span class="desc">��������� ��� ���������.</span></p>
	<div class="contact-left">
<?php
function html_filter($str){$result=htmlspecialchars($str);return $result;}
function isEmail($email){if(eregi("^[a-z0-9]+([-_\.]?[a-z0-9])+@[a-z0-9]+([-_\.]?[a-z0-9])+\.[a-z]+$",$email)){return TRUE;}else{return FALSE;}}
function back_page(){
	echo"<div id='backlink_rec'>
		<a href='javascript:history.back()' class='more'><strong>�����</strong></a>
	</div>";}
//////////////////////|�������� ������ � ������������� ������|////////////////////////
function XMail($from, $to, $subj, $text, $filename, $file){							//
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
if($ret_send==1){
	echo $rn==0?"<p>�� �� ������� ������ �����.<p><br>":"";
	echo $re==0?"<p>�� �� ������� ��� E-MAIL �����.<p><br>":"";
	echo $rp==0?"<p>�� �� ������� ����� �������� ��� ����� � ����.<p><br>":"";
	echo $rs==0?"<p>�� �� �������� ������ � ���������.<p><br>":"";
	if($from=="post@example.com"||$from=="mail@gidrodinamika.ru"){
			unset($from);
			echo"<p>�� �� ������� ��� E-MAIL �����.<p><br>";
		}
	if($phone=="+7(495)-123-45-67"){
			unset($phone);
			echo"<p>�� �� ������� ����� �������� ��� ����� � ����.<p><br>";
		}
	if($rn==0||$re==0||$rp==0||$rs==0){
			echo"<p id='error'>��������� ������� � ��������� ��� ���� �� ���������� (*)</p><br>".back_page();
		}else{
/////////////////|����� �������� ����� ����� ��������� ������ � ������������� ������ ��� ���|/////////////////
			if($filename != "" and $file_size > 0){															//
						if(XMail($from, $to, $subj, $text, $filename, $tmpname)){							//
								echo"<p id='success'>������� �� ���� ���������. </p><br>".back_page();		//
							}else{																			//
								echo"<p id='error'>�� ���� ��������� ������ !</p><br>".back_page();			//
							}																				//
					}else{ //���� �� ���������� ����														//
						if(mail($to, $subj, $text, $headers)){												//
								echo"<p id='success'>������� �� ���� ���������.</p><br>".back_page();		//
							}else{																			//
								echo"<p id='error'>�� ���� ��������� ������ !</p><br>".back_page();			//
							}																				//
					}																						//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////|������ �������� ��������|////////////////////////////////////////////////////////////
//			echo mail($to,$subj,$text,$headers)?"<p id='success'>������� �� ���� ���������.</p><br>".back_page():"<p id='error'>�� ���� ��������� ������ !</p><br>".back_page();//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
	}else{
		echo <<<here
<h5 class='custom'>����������� ����� ����, ����� ��������� ��� ���� ������</h5>
<form id='formMail' action='contact.php' method='post' enctype='multipart/form-data'>
	<fieldset>
		<p><label>��� * :<span> (������: ������ ���� ��������)</span></label><input name='name' id='name' type='text' value=''/></p>
		<p><label>��� E-MAIL * :<span> (������: post@example.com )</span></label><input name='from' id='from' type='text' value=''/></p>
		<p><label>���������� ������� * :<span> (������: +7(495)-123-45-67 )</span></label><input name='phone' id='phone' type='text' value=''/></p>
		<p><label>����:</label><input name='subj' id='subj' type='text'/></p>
		<p><label>������ * :</label><textarea name='text' id='text' rows='5' cols='20'></textarea></p>
		<p><label>���������� ����:</label><input type="file" name="file" id="file"></p><!--|������ ���������� ����� � ������|-->
		<p><input type='submit' value='���������' name='send' id='send'/></p>
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