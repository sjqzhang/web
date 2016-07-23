<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


    
    function get_month_range($y = "", $m = ""){
    if ($y == "") $y = date("Y");
    if ($m == "") $m = date("m");
    $m = sprintf("%02d", intval($m));
    $y = str_pad(intval($y), 4, "0", STR_PAD_RIGHT);
 
    $m>12 || $m<1 ? $m=1 : $m=$m;
    $firstday = strtotime($y . $m . "01000000");
    $firstdaystr = date("Y-m-01", $firstday);
    $lastday = strtotime(date('Y-m-d', strtotime("$firstdaystr +1 month -1 day")));
 
    return array(
		date("Y-m-d",$firstday),
		date("Y-m-d", $lastday),
        "firstday" => date("Y-m-d",$firstday),
        "lastday" =>date("Y-m-d", $lastday)
    );
}
    
    
    function get_week_range($week, $year){

        $timestamp = mktime(1,0,0,1,1,$year);

        $firstday = date("N",$timestamp);

         if($firstday >4)

                $firstweek = strtotime('+'.(8-$firstday).' days', $timestamp);

         else

                $firstweek = strtotime('-'.($firstday-1).' days', $timestamp);


        $monday = strtotime('+'.($week - 1).' week', $firstweek);

        $sunday = strtotime('+6 days', $monday);


        $start = date("Y-m-d", $monday);

        $end = date("Y-m-d", $sunday);

        return array($start, $end);
    }

	function get_season_range($season,$year){
	    $timestamp = mktime(1,0,0,1,1,$year);		
		if($season==1){  
		 $begin_this_quarter=date('Y-01-01',$timestamp);  
		 $end_this_quarter=date("Y-03-31",$timestamp);  
		}elseif($season==2){  
		 $begin_this_quarter=date('Y-04-01',$timestamp);  
		 $end_this_quarter=date("Y-06-30",$timestamp);      
		}elseif($season==3){  
		 $begin_this_quarter=date('Y-07-01',$timestamp);  
		 $end_this_quarter=date("Y-09-30",$timestamp);      
		}else{  
		 $begin_this_quarter=date('Y-10-01',$timestamp);  
		 $end_this_quarter=date("Y-12-31",$timestamp);          
		} 
		return array($begin_this_quarter, $end_this_quarter);
	}



?>