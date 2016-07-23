<?php
    

    function get_weekindex($date){
        $standard = strtotime("2015-12-06 00:00:00"); //基准日期
        $standard_week_index = 0; //基准星期天
        $wkindex =   (strtotime($date) - $standard) /86400;
        $wkindex= $wkindex>0? abs($wkindex) % 7:  (7 - abs($wkindex) % 7) % 7 ;
        return $wkindex;
    }

    function get_week_name($wkindex){
        $str="天一二三四五六";  
        return mb_substr($str,$wkindex,1);
    }

    function pad_week($windex){
        $r= new stdClass;
        $color = array('success','info');
       for ($i=0; $i < $windex ; $i++) {
        $index = $i;
            $td_color = $color[ $index % 2 ];
           $r->t[] = sprintf("<td class='%s'></td>",$td_color );
            $r->b[] = sprintf("<td class='%s'></td>",$td_color );
       }
       return $r;
    }

    function get_week_tr($wlist,$filter=""){
        $r = pad_week($wlist[0]['windex']);
        $color = array('success','info');
        foreach ($wlist as  $day) {
            $index = $day['windex'];
            $td_color = $color[ $index % 2 ];
            if($filter!=""){
                $day['member'] = strstr($day['member'],$filter) ?$day['member'] :"" ;
            }

            $r->t[] = sprintf("<td class='%s'>%s</td>",$td_color ,$day['date']);
            $r->b[] = sprintf("<td class='%s'>%s</td>",$td_color ,$day['member'] );
        }
        return sprintf("<tr class='day'>%s</tr><tr class='member'>%s</tr>",implode("", $r->t),implode("", $r->b) );
    }

    function renderer_duty($duty_list,$filter=""){
            $weeks= array();
            $point = 0;
            foreach ($duty_list as $item) {
                $windex = get_weekindex($item['date']);
                $item['windex']  = $windex;
                $weeks[$point][] = $item;
                if($windex == 6){
                    $point += 1;
                }
            }
            $strlist = array();
            foreach ($weeks as  $week) {
                $strlist[] = get_week_tr($week,$filter);
            }

            return implode("", $strlist);
    }
?>

<table class="table table-striped">
    <thead>
        <tr class='month'>
        <td><button class="btn btn-xs  btn-success prev" time="<?php echo $pmonth?>" > < <?php echo date("Y年m月",$pmonth);?> </button> </td>
            <td colspan="5"> 
                
                 <span> <?php echo date("Y年m月",$tmonth);?> </span> 
            </td>
        <td><button class="btn btn-xs  btn-success next" time="<?php echo $nmonth?>" > <?php echo date("Y年m月",$nmonth);?> ></button> </td>
        </tr>
        <tr >
            <?php 
                $str="天一二三四五六";                    
                for($i = 0;$i <7 ;$i++){
                    echo sprintf("<td>星期%s</td>",mb_substr($str,$i,1));
                };
             ?>
        </tr>

    </thead>
    <tbody>
        <?php 

        echo renderer_duty($daydata,$keyword);

        ?>
    </tbody>
</table>

