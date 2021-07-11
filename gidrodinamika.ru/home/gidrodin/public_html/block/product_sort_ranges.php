<?php

$search_prod = array(
	'q', 'h', 'w', 'kav', 'p', 't', 'ro','m'
);

if(isset($_REQUEST['send_finder']))
{
	$send            = 1;
	$hid_line_finder = "";
	$trim_val        = trim($_REQUEST[$val]);
	
	foreach($search_prod as $key => $val)
	{
		if(     empty     ($trim_val)
			|| !is_numeric($trim_val))
		{
			unset($_REQUEST[$$val]);
		}
		else
		{
			$$val = substr($trim_val, 0, 4);
			
			switch($val)
			{
				case "q":
					if($q  <=  7)
					{
						$q_min = 5;
						$q_max = 8;
					}
					elseif($q  <=  15)
					{
						$q_min = $q - 2;
						$q_max = $q + 2;
					}
					elseif($q  <=  70)
					{
						$q_min = $q - 5;
						$q_max = $q + 5;
					}
					elseif($q  <=  250)
					{
						$q_min = $q - 20;
						$q_max = $q + 20;
					}
					elseif($q  <=  450)
					{
						$q_min = $q - 65;
						$q_max = $q + 65;
					}
					elseif($q  <=  750)
					{
						$q_min = $q - 100;
						$q_max = $q + 100;
					}
					elseif($q  <=  1250)
					{
						$q_min = 750;
						$q_max = 1250;
					}
					else
					{
						$err_q = 1;
						unset($q);
					}
							
					if( !isset($err_q))
					{
						$rq                = 1;
						$search_prod_tmp[] = 'q';
						$hid_line_finder  .=
							"<input id     = 'q'
									name   = 'q'
									type   = 'hidden'
									value  = '".$q."'
							/>";
					}
					
					break;
					
				case "h":
					if($h  <=  30)
					{
						$h_min = 18;
						$h_max = 32;
					}
					elseif($h  <=  85)
					{
						$h_min = $h - 5;
						$h_max = $h + 5;
					}
					elseif($h  <=  170)
					{
						$h_min = $h - 10;
						$h_max = $h + 10;
					}
					elseif($h  <=  310)
					{
						$h_min = $h - 20;
						$h_max = $h  +20;
					}
					elseif($h  <=  900)
					{
						$h_min = $h - 50;
						$h_max = $h + 50;
					}
					elseif($h  <=  1000)
					{
						$h_min = $h - 100;
						$h_max = $h + 100;
					}
					elseif($h  <=  1100)
					{
						$h_min = 1000;
						$h_max = 1100;
					}
					else
					{
						$err_h = 1;
						unset($h);
					}
								
					
					if( !isset($err_h))
					{
						$rh                = 1;
						$search_prod_tmp[] = 'h';
						$hid_line_finder  .= 
							"<input id     = 'h'
									name   = 'h'
									type   = 'hidden'
									value  = '".$h."'
							/>";
					}
					break;

				case "w":
					if($w  <=  4)
					{
						$w_min = 2;
						$w_max = 6;
					}
					elseif($w  <=  18.5)
					{
						$w_min = $w - 4;
						$w_max = $w + 4;
						}
					elseif($w  <=  45)
					{
						$w_min = $w - 10;
						$w_max = $w + 10;
					}
					elseif($w  <=  135)
					{
						$w_min = $w - 25;
						$w_max = $w + 25;
					}
					elseif($w  <=  315)
					{
						$w_min = $w - 85;
						$w_max = $w + 85;
					}
					elseif($w  <=  500)
					{
						$w_min = $w - 100;
						$w_max = $w + 100;
					}
					elseif($w  <=  630)
					{
						$w_min = 500;
						$w_max = 630;
					}
					else
					{
						$err_w = 1;
						unset($w);
					}
								
					if( !isset($err_w))
					{
						$rw                = 1;
						$search_prod_tmp[] = 'w';
						$hid_line_finder  .=
							"<input id     = 'w'
									name   = 'w'
									type   = 'hidden'
									value  = '".$w."'
							/>";
					}
					break;

				case "kav":
					if($kav  <=  2)
					{
						$kav_min = 0;
						$kav_max = 2.5;
					}
					elseif($kav  <=  4.5)
					{
						$kav_min = $kaw - 0.5;
						$kav_max = $kav + 0.5;
					}
					elseif($kav  <=  6)
					{
						$kav_min = $kaw - 1;
						$kav_max = $kav + 1;
					}
					elseif($kav  <=  8)
					{
						$kav_min = 6.5;
						$kav_max = 8;
					}
					else
					{
						$err_kav = 1;
						unset($kav);
					}
					
					if( !isset($err_kav))
					{
						$rkav              = 1;
						$search_prod_tmp[] = 'kav';
						$hid_line_finder  .=
							"<input id     = 'kav'
									name   = 'kav'
									type   = 'hidden'
									value  = '".$kav."'
							/>";
					}
					break;

				case "p":
					if($p <= 0.2)
					{
						$p_min = 0;
						$p_max = 0.3;
					}
					elseif($p<0.8)
					{
						$p_min = $p - 0.1;
						$p_max = $p + 0.1;
					}
					elseif($p <= 1.2)
					{
						$p_min = $p - 0.2;
						$p_max = $p + 0.2;
					}
					elseif($p <= 1.7)
					{
						$p_min = $p - 0.1;
						$p_max = $p + 0.1;
					}
					elseif($p <= 2.4)
					{
						$p_min = $p - 0.7;
						$p_max = $p + 0.7;
					}
					elseif($p <= 3)
					{
						$p_min = $p - 0.5;
						$p_max = $p + 0.5;
					}
					elseif($p <= 4)
					{
						$p_min = 3.2;
						$p_max = 4;
					}
					else
					{
						$err_p = 1;
						unset($p);
					}
					
					if( !isset($err_p))
					{
						$rp                = 1;
						$search_prod_tmp[] = 'p';
						$hid_line_finder  .=
							"<input id     = 'p'
									name   = 'p'
									type   = 'hidden'
									value  = '".$p."'
							/>";
					}
					break;
					
				case "t":
					if($t <= 80)
					{
						$t_min = 0;
						$t_max = 150;
					}
					elseif($t <= 200)
					{
						$t_min = $t - 20;
						$t_max = $t + 20;
					}
					elseif($t <= 280)
					{
						$t_min = $t - 30;
						$t_max = $t + 30;
					}
					elseif($t <= 300)
					{
						$t_min = 280;
						$t_max = 300;
					}
					else
					{
						$err_t = 1;
						unset($t);
					}
					
					if( !isset($err_t))
					{
						$rt                = 1;
						$search_prod_tmp[] = 't';
						$hid_line_finder  .=
							"<input id     = 't'
									name   = 't'
									type   = 'hidden'
									value  = '".$t."'
							/>";
					}
					break;
					
				case "ro":
					if($ro <= 500)
					{
						$ro_min = 0;
						$ro_max = 570;
					}
					elseif($ro <= 950)
					{
						$ro_min = $ro - 30;
						$ro_max = $ro + 30;
					}
					elseif($ro <= 1200)
					{
						$ro_min = $ro - 50;
						$ro_max = $ro + 50;
					}
					elseif($ro <= 1700)
					{
						$ro_min = $ro - 100;
						$ro_max = $ro + 100;
					}elseif($ro <= 1800)
					{
						$ro_min = 1700;
						$ro_max = 1800;
					}else
					{
						$err_ro = 1;
						unset($ro);
					}
					
					if( !isset($err_ro))
					{
						$rro               = 1;
						$search_prod_tmp[] = 'ro';
						$hid_line_finder  .=
							"<input id     = 'ro'
									name   = 'ro'
									type   = 'hidden'
									value  = '".$ro."'
							/>";
					}
					break;
					
				case "m":
					if($m <= 115)
					{
						$m_min = 0;
						$m_max = 160;
					}
					elseif($m <= 1300)
					{
						$m_min = $m - 150;
						$m_max = $m + 150;
					}
					elseif($m <= 3600)
					{
						$m_min = $m - 170;
						$m_max = $m + 170;
					}
					elseif($m <= 4700)
					{
						$m_min = $m - 300;
						$m_max = $m + 300;
					}
					elseif($m <= 5820)
					{
						$m_min = $m - 800;
						$m_max = $m + 800;
					}
					elseif($m <= 6620)
					{
						$m_min = 6520;
						$m_max = 6620;
					}
					else
					{
						$err_m = 1;
						unset($m);
					}
					
					if( !isset($err_m))
					{
						$rm                = 1;
						$search_prod_tmp[] = 'm';
						$hid_line_finder  .=
							"<input id     = 'm'
									name   = 'm'
									type   = 'hidden'
									value  = '".$m."'
							/>";
					}
					break;
			}
		}
	}
}
else
	$send = 0;
?>