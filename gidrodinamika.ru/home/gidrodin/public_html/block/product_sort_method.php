<?php

switch($a)
{
	case 1:
		$order    = "name DESC";
		$a1 = 10; $a2 = 2; $a3 = 3; $a4 = 4; $a5 = 5; $a6 = 6; $a7 = 7; $a8 = 8; $a9 = 9;
		break;

	case 2:
		$order    = "pump_q, pump_h, pump_w, pump_kav, pump_p, pump_t, pump_ro, pump_m";
		$a1 = 1; $a2 = 11; $a3 = 3; $a4 = 4; $a5 = 5; $a6 = 6; $a7 = 7; $a8 = 8; $a9 = 9;
		break;
		

	case 3:
		$order    = "pump_h, pump_q, pump_w, pump_kav, pump_p, pump_t, pump_ro, pump_m";
		$a1 = 1; $a2 = 2; $a3 = 12; $a4 = 4; $a5 = 5; $a6 = 6; $a7 = 7; $a8 = 8; $a9 = 9;
		break;
		
	case 4:
		$order    = "pump_w, pump_q, pump_h, pump_kav, pump_p, pump_t, pump_ro, pump_m";
		$a1 = 1; $a2 = 2; $a3 = 3; $a4 = 13; $a5 = 5; $a6 = 6; $a7 = 7; $a8 = 8; $a9 = 9;
		break;
		
	case 5:
		$order    = "pump_kav, pump_q, pump_h, pump_w, pump_p, pump_t, pump_ro, pump_m";
		$a1 = 1; $a2 = 11; $a3 = 3; $a4 = 4; $a5 = 14; $a6 = 6; $a7 = 7; $a8 = 8; $a9 = 9;
		break;
		
	case 6:
		$order    = "pump_p, pump_q, pump_h, pump_w, pump_kav, pump_t, pump_ro, pump_m";
		$a1 = 1; $a2 = 11; $a3 = 3; $a4 = 4; $a5 = 5; $a6 = 15; $a7 = 7; $a8 = 8; $a9 = 9;
		break;
		
	case 7:
		$order    = "pump_t, pump_q, pump_h, pump_w, pump_kav, pump_p, pump_ro, pump_m";
		$a1 = 1; $a2 = 11; $a3 = 3; $a4 = 4; $a5 = 5; $a6 = 6; $a7 = 16; $a8 = 8; $a9 = 9;
		break;
		
	case 8:
		$order    = "pump_ro, pump_q, pump_h, pump_w, pump_kav, pump_p, pump_t, pump_m";
		$a1 = 1; $a2 = 11; $a3 = 3; $a4 = 4; $a5 = 5; $a6 = 6; $a7 = 7; $a8 = 17; $a9 = 9;
		break;
		
	case 9:
		$order    = "pump_m, pump_q, pump_h, pump_w, pump_kav, pump_p, pump_t, pump_ro";
		$a1 = 1; $a2 = 11; $a3 = 3; $a4 = 4; $a5 = 5; $a6 = 6; $a7 = 7; $a8 = 8; $a9 = 18;
		break;
		
	case 10:
		$order    = "name";
		$a1 = 1; $a2 = 2; $a3 = 3; $a4 = 4; $a5 = 5; $a6 = 6; $a7 = 7; $a8 = 8; $a9 = 9;
		break;
		
	case 11:
		$order    = "pump_q DESC, pump_h ASC, pump_w ASC, pump_kav ASC, pump_p ASC, pump_t ASC, pump_ro ASC, pump_m ASC";
		$a1 = 1; $a2 = 2; $a3 = 3; $a4 = 4; $a5 = 5; $a6 = 6; $a7 = 7; $a8 = 8; $a9 = 9;
		break;
		
	case 12:
		$order    = "pump_h DESC, pump_q ASC, pump_w ASC, pump_kav ASC, pump_p ASC, pump_t ASC, pump_ro ASC, pump_m ASC";
		$a1 = 1; $a2 = 2; $a3 = 3; $a4 = 4; $a5 = 5; $a6 = 6; $a7 = 7; $a8 = 8; $a9 = 9;
		break;
		
	case 13:
		$order    = "pump_w DESC, pump_q ASC, pump_h ASC, pump_kav ASC, pump_p ASC, pump_t ASC, pump_ro ASC, pump_m ASC";
		$a1 = 1; $a2 = 2; $a3 = 3; $a4 = 4; $a5 = 5; $a6 = 6; $a7 = 7; $a8 = 8; $a9 = 9;
		break;
		
	case 14:
		$order    = "pump_kav DESC, pump_q ASC, pump_h ASC, pump_w ASC, pump_p ASC, pump_t ASC, pump_ro ASC, pump_m ASC";
		$a1 = 1; $a2 = 2; $a3 = 3; $a4 = 4; $a5 = 5; $a6 = 6; $a7 = 7; $a8 = 8; $a9 = 9;
		break;
		
	case 15:
		$order    = "pump_p DESC, pump_q ASC, pump_h ASC, pump_w ASC, pump_kav ASC, pump_t ASC, pump_ro ASC, pump_m ASC";
		$a1 = 1; $a2 = 2; $a3 = 3; $a4 = 4; $a5 = 5; $a6 = 6; $a7 = 7; $a8 = 8; $a9 = 9;
		break;
		
	case 16:
		$order    = "pump_t DESC, pump_q ASC, pump_h ASC, pump_w ASC, pump_kav ASC, pump_p ASC, pump_ro ASC, pump_m ASC";
		$a1 = 1; $a2 = 2; $a3 = 3; $a4 = 4; $a5 = 5; $a6 = 6; $a7 = 7; $a8 = 8; $a9 = 9;
		break;
		
	case 17:
		$order    = "pump_ro DESC, pump_q ASC, pump_h ASC, pump_w ASC, pump_kav ASC, pump_p ASC, pump_t ASC, pump_m ASC";
		$a1 = 1; $a2 = 2; $a3 = 3; $a4 = 4; $a5 = 5; $a6 = 6; $a7 = 7; $a8 = 8; $a9 = 9;
		break;
		
	case 18:
		$order    = "pump_m DESC, pump_q ASC, pump_h ASC, pump_w ASC, pump_kav ASC, pump_p ASC, pump_t ASC, pump_ro ASC";
		$a1 = 1; $a2 = 2; $a3 = 3; $a4 = 4; $a5 = 5; $a6 = 6; $a7 = 7; $a8 = 8; $a9 = 9;
		break;
		
	default:
		$order    = "name";
		$a1 = 1; $a2 = 2; $a3 = 3; $a4 = 4; $a5 = 5; $a6 = 6; $a7 = 7; $a8 = 8; $a9 = 9;
		$hid_line = "";
		break;
}

?>