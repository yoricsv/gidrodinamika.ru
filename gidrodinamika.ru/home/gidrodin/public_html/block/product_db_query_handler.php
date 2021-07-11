<?php

// get all product data
$select = 
   "SELECT
		id,
		name,
		inst,
		pump_q,
		pump_h,
		pump_w,
		pump_kav,
		pump_p,
		pump_t,
		pump_ro,
		pump_m
	FROM
		products ";
	
$query = $select;

if( !isset($search_prod_tmp))
{
	// case for selecting the pump type
	switch($ret_ins)
	{
		case 0:
			$query .= "";
			break;
			
		case 1:
			$query .= "WHERE ".$ins_b;
			break;
			
		default:
			$query .= "";
	}
}
else
{
	// case for get a range of pumps on request
	$where = 0;
	
	foreach($search_prod_tmp as $key => $val)
	{
		$tpmp = "pump_"  .$val;
		$tmin = $val.   "_min";
		$tmax = $val.   "_max";
		
		if( isset( $where, 
				   $ret_ins)
		{
			$query .= 
				" WHERE ("
					.$tpmp.
				" BETWEEN "
					.$$tmin.
				" AND "
					.$$tmax.
				" ) ";

			$where = 1;
		}
		elseif(    $where   == 0
				&& $ret_ins == 1)
		{
			$query .= 
				" WHERE ("
					.$ins_b.
				" AND ("
					.$tpmp.
				" BETWEEN "
					.$$tmin.
				" AND "
					.$$tmax.
				")) ";
				
			$where = 1;
		}
		elseif(    $where   == 1
				&& $ret_ins == 0)
		{
			$query .= 
				" UNION ("
					.$select.
				" WHERE ("
					.$tpmp.
				" BETWEEN "
					.$$tmin.
				" AND "
					.$$tmax.
				")) ";
		}
		elseif(    $where   == 1
				&& $ret_ins == 1)
		{
			$query .= 
				"UNION ("
					.$select.
				" WHERE ("
					.$ins_b.
				" AND ("
					.$tpmp.
				" BETWEEN "
					.$$tmin.
				" AND "
					.$$tmax.
				"))) ";
		}
	}
}

$query .= " ORDER BY " .$order;

?>