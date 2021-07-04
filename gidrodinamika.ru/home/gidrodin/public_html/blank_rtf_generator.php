<?php 
include("block/filter_array_post_get_request.php");

if(isset($_REQUEST['send']))
{
    $zakazchik        = $_REQUEST['zakazchik'];
    $tel_fax          = $_REQUEST['tel_fax'];
    $pump_name        = $_REQUEST['pump_name'];
    $podacha_q        = $_REQUEST['podacha_q'];
    $napor_h          = $_REQUEST['napor_h'];
    $davlenie_in      = $_REQUEST['davlenie_in'];
    $temperature_out  = $_REQUEST['temperature_out'];
    $kavitac_zapas    = $_REQUEST['kavitac_zapas'];
    $utechki          = $_REQUEST['utechki'];
    $napr_pitania     = $_REQUEST['napr_pitania'];
    $os_dop_treb      = $_REQUEST['os_dop_treb'];
    $zidkost          = $_REQUEST['zidkost'];
    $plotnost         = $_REQUEST['plotnost'];
    $him_sostav       = $_REQUEST['him_sostav'];
    $ph_water         = $_REQUEST['ph_water'];
    $group_explode    = $_REQUEST['group_explode'];
    $boling_point     = $_REQUEST['boling_point'];
    $viazkost         = $_REQUEST['viazkost'];
    $teploemkost      = $_REQUEST['teploemkost'];
    $davlenie_parov   = $_REQUEST['davlenie_parov'];
    $bit              = $_REQUEST['bit'];
    $size_bit         = $_REQUEST['size_bit'];
    $stepen_abrazive  = $_REQUEST['stepen_abrazive'];
    $plotnost_bit     = $_REQUEST['plotnost_bit'];
    $magnet_bit       = $_REQUEST['magnet_bit'];
    $stoikie_mater    = $_REQUEST['stoikie_mater'];
    $stoikoe_uplot    = $_REQUEST['stoikoe_uplot'];
    $climate          = $_REQUEST['climate'];
    $temper_vozd_min  = $_REQUEST['temper_vozd_min'];
    $temper_vozd_max  = $_REQUEST['temper_vozd_max'];
    $vlagnost         = $_REQUEST['vlagnost'];
    $cat_explode_room = $_REQUEST['cat_explode_room'];
    $h_on_sea         = $_REQUEST['h_on_sea'];
    $need_kvartal     = $_REQUEST['need_kvartal'];
    $kvartal          = $_REQUEST['kvartal'];
    $need_year        = $_REQUEST['need_year'];
    $dop_treb         = $_REQUEST['dop_treb'];

    $quests = array
        (
            0  => $zakazchik,
	    1  => $tel_fax,
	    2  => $pump_name,
	    3  => $podacha_q,
	    4  => $napor_h,
	    5  => $davlenie_in,
	    6  => $temperature_out,
	    7  => $kavitac_zapas,
	    8  => $utechki,
	    9  => $napr_pitania,
	    10 => $os_dop_treb,
	    11 => $zidkost,
	    12 => $plotnost,
	    13 => $him_sostav,
	    14 => $ph_water,
	    15 => $group_explode,
	    16 => $boling_point,
	    17 => $viazkost,
	    18 => $teploemkost,
	    19 => $davlenie_parov,
	    20 => $bit,
	    21 => $size_bit,
	    22 => $stepen_abrazive,
	    23 => $plotnost_bit,
	    24 => $magnet_bit,
	    25 => $stoikie_mater,
	    26 => $stoikoe_uplot,
	    27 => $climate,
	    28 => $temper_vozd_min,
	    29 => $temper_vozd_max,
	    30 => $vlagnost,
	    31 => $cat_explode_room,
	    32 => $h_on_sea,
	    33 => $need_kvartal,
	    34 => $kvartal,
	    35 => $need_year,
	    36 => $dop_treb
        );

    if($quests[10] == '')
    {
        $quests[10] = "___________________________________________________________________________ ___________________________________________________________________________";
    }

    if($quests[36] == '')
    {
        $quests[36] = "___________________________________________________________________________ ___________________________________________________________________________";
    }
 
    for( $i = 0; $i < count($quests); $i++)
    {
        $quests[$i] = trim (htmlspecialchars($quests[$i]));
        $quests[$i] = str_replace("\n","<br>\n", $quests[$i]);

        if($quests[$i] == '')
        {
            $quests[$i] = "______________________";
        }
    }


    header ('Content-type:        application/msword');
    header ("Content-Disposition: attachment;
             filename = blank.rtf"                   );


    $m     = date("m");
    $rus_m = array
        (
            '01' => 'ÿíâàðÿ',
            '02' => 'ôåâðàëÿ',
            '03' => 'ìàðòà',
            '04' => 'àïðåëÿ',
            '05' => 'ìàÿ',
            '06' => 'èþíÿ',
            '07' => 'èþëÿ',
            '08' => 'àâãóñòà',
            '09' => 'ñåíòÿáðÿ',
            '10' => 'îêòÿáðÿ',
            '11' => 'íîÿáðÿ',
            '12' => 'äåêàáðÿ'
        );
    $mon   = $rus_m[$m];
    $date  = date("d $mon Y")." ã.";


    $filename = 'files/blank.rtf';
    $fp       = fopen($filename, 'r');
    $output   = fread($fp, filesize($filename));
    fclose($fp);


    $output =  str_replace('<<date>>',             strtoupper($date),       $output);

    $output =  str_replace('<<zakazchik>>',        strtoupper($quests[0]),  $output);
    $output =  str_replace('<<tel_fax>>',          strtoupper($quests[1]),  $output);
    $output =  str_replace('<<pump_name>>',        strtoupper($quests[2]),  $output);
    $output =  str_replace('<<podacha_q>>',        strtoupper($quests[3]),  $output);
    $output =  str_replace('<<napor_h>>',          strtoupper($quests[4]),  $output);
    $output =  str_replace('<<davlenie_in>>',      strtoupper($quests[5]),  $output);
    $output =  str_replace('<<temperature_out>>',  strtoupper($quests[6]),  $output);
    $output =  str_replace('<<kavitac_zapas>>',    strtoupper($quests[7]),  $output);
    $output =  str_replace('<<utechki>>',          strtoupper($quests[8]),  $output);
    $output =  str_replace('<<napr_pitania>>',     strtoupper($quests[9]),  $output);
    $output =  str_replace('<<os_dop_treb>>',      strtoupper($quests[10]), $output);
    $output =  str_replace('<<zidkost>>',          strtoupper($quests[11]), $output);
    $output =  str_replace('<<plotnost>>',         strtoupper($quests[12]), $output);
    $output =  str_replace('<<him_sostav>>',       strtoupper($quests[13]), $output);
    $output =  str_replace('<<ph_water>>',         strtoupper($quests[14]), $output);
    $output =  str_replace('<<group_explode>>',    strtoupper($quests[15]), $output);
    $output =  str_replace('<<boling_point>>',     strtoupper($quests[16]), $output);
    $output =  str_replace('<<viazkost>>',         strtoupper($quests[17]), $output);
    $output =  str_replace('<<teploemkost>>',      strtoupper($quests[18]), $output);
    $output =  str_replace('<<davlenie_parov>>',   strtoupper($quests[19]), $output);
    $output =  str_replace('<<bit>>',              strtoupper($quests[20]), $output);
    $output =  str_replace('<<size_bit>>',         strtoupper($quests[21]), $output);
    $output =  str_replace('<<stepen_abrazive>>',  strtoupper($quests[22]), $output);
    $output =  str_replace('<<plotnost_bit>>',     strtoupper($quests[23]), $output);
    $output =  str_replace('<<magnet_bit>>',       strtoupper($quests[24]), $output);
    $output =  str_replace('<<stoikie_mater>>',    strtoupper($quests[25]), $output);
    $output =  str_replace('<<stoikoe_uplot>>',    strtoupper($quests[26]), $output);
    $output =  str_replace('<<climate>>',          strtoupper($quests[27]), $output);
    $output =  str_replace('<<temper_vozd_min>>',  strtoupper($quests[28]), $output);
    $output =  str_replace('<<emper_vozd_max>>',   strtoupper($quests[29]), $output);
    $output =  str_replace('<<vlagnost>>',         strtoupper($quests[30]), $output);
    $output =  str_replace('<<cat_explode_room>>', strtoupper($quests[31]), $output);
    $output =  str_replace('<<h_on_sea>>',         strtoupper($quests[32]), $output);
    $output =  str_replace('<<need_kvartal>>',     strtoupper($quests[33]), $output);
    $output =  str_replace('<<kvartal>>',          strtoupper($quests[34]), $output);
    $output =  str_replace('<<need_year>>',        strtoupper($quests[35]), $output);
    $output =  str_replace('<<dop_treb>>',         strtoupper($quests[36]), $output);

    $output .= $data;
    $output .= '\par}';

    echo $output;

}
else
{
    function back_page()
    {
	printf( "<div id = 'backlink_rec'>
                     <a href = '%s' class = 'more'>
                         <strong>Íàçàä</strong>
                     </a>
	         </div>",
	         $_SERVER['PHP_SELF']
        );
    }
	
    echo " <p id = 'error'>
               Íå ïðîèçîøëî àâòîìàòè÷åñêîé ãåíåðàöèè áëàíêà.
               Âîçìîæíî, ïðîáëåìû ñ ñåðâåðîì âåðíèòåñü îáðàòíî 
	       è ïîïðîáóéòå åùå ðàç, ëèáî ñêà÷àéòå áëàíê çàêàçà 
	       íà ïðåäûäóùåé ñòðàíèöå.
	   </p>
	   <br>".back_page();
}
?>
