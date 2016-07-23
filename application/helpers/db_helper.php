<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 实现SQL查询
* 
* @param mixed $that
* @param mixed $sql
* @param mixed $where
* @param mixed $order
* @param mixed $limit
*/


function query(&$that,$sql){
    $data=array();
    $query=$that->db->query($sql);
    $i=0;
    if(preg_match('/\s*insert\s+|\s*update\s+|\s*delete\s+|\s*replace\s+/i',$sql)){
        return $that->db->affected_rows();
    }
    foreach ($query->result_array() as $row)
    {
       $data[$i]=$row;
       $i++;
    }
    return $data;
}

//function write($content,$fn='./result.txt')
//{
//    $fp= fopen($fn,'w+');
//    fwrite($fp,$content);
//    fclose($fp);
//}

function scalar(&$that,$sql){
    $rows=query($that,$sql);
    if(count($rows)>0){
        return $rows[0];
    } else {
        return null;
    }
}



    function getPage(&$that,$sql,$where='',$group='',$order='',$limit='')
    {
        $pager=array();
        $tmp=$sql.$where.$group;       
        $tmp=preg_replace('/select[\s\S]*?from/i','select count(1) cnt from', $tmp);
        $count=query($that,$tmp); 
        $pager['totalCount'] =$count[0]['cnt'];     
        if(empty($limit)){//page
            $offset=$that->input->post('limit');
            $page=$that->input->post('page');
            if(empty($page)){
               $page=1;
            }
            if(empty($offset)){
                $offset=20;
            }
              $start=($page-1)*$offset;
              $limit=" limit  {$start},{$offset} ";
        } 
        $tmp=$sql.' '.$where.' '.$group.' '.$order.' '.$limit;  
        $pager['items']=query($that,$tmp);      
        return $pager;
    }


    function getAjaxPage(&$that,$sql,$where='',$group='',$order='',$limit='')
    {
        $pager=getPage($that,$sql,$where,$group,$order,$limit); 
        echo  json_encode($pager);
        die;
    }


      function escape_string($str) {

		  if( function_exists('mysql_real_escape_string')){
		   
		   return mysql_real_escape_string($str);

		  } else {
          
			return mysql_escape_string($str);
		  }
 
    }
       


       function where($where_map,$data)
         {
            
             $w="";
             if(isset($data)&& !empty($data))
             {
             $json=$data;
             }
             else
             {
             $json=$_REQUEST;
             }
             foreach($where_map as $key=>$op)
             {
                   if (!isset($json[$key]))  $json[$key]=$op;
                   $keys=preg_split("/,/",$key); 
                   if(count($keys)>1)
                   {
                       $key=$keys[0];

                        // $value=trim(mysql_escape_string(urldecode($json[$keys[1]]))); 
                         
                       $value=  escape_string(trim($json[$keys[1]]));

                   }
                   else
                   {
                      $key=$keys[0];
                       //  $value=trim(mysql_escape_string(urldecode($json[$key])));
                       
                       $value=  escape_string(trim($json[$key]));
                   }
                 
                 if(($value!=null)&&(trim($value)!=""))
                 {
                     switch ($op)
                     {
                         case "eq":
                             $w.=" ".$key." = '".$value."'";
                           break;
                         case "gt":
                             $w.=" ".$key." > '".$value."'";
                           break;
                         case "lt":
                             $w.=" ".$key." < '".$value."'";
                           break;
                         case "neq":
                             $w.=" ".$key." <> '".$value."'";
                           break;
                         case "ge":
                             $w.=" ".$key." >= '".$value."'";
                           break;
                         case "le":
                             $w.=" ".$key." <= '".$value."'";
                           break;
                         case "li":
                             $w.=" ".$key." like '%".$value."%'";
                           break; 
                         case "lil":
                             $w.=" ".$key." like '%".$value."'";
                           break;
                         case "lir":
                             $w.=" ".$key." like ".$value."%";
                           break;
                         case "in":
                         $arr= preg_split("/,/",$value); 
                         $v="";
                         $inLen=count($arr);
                         if($inLen>0)
                         {
                         for($i=0;$i<$inLen;$i++){
//                              if($this->C("db_type")=="mysql") 
//                              {
//                                  $tempv=    mysql_escape_string(urldecode($arr[$i]));     
//                              }
//                              else
//                              {
//                                  $tempv=trim(preg_replace("/\'/","''",urldecode($arr[$i])));        
//                              }
                            if($i==$inLen-1)
                            {
                            $v.= "'".$tempv."'";
                            }
                            else
                            {
                            $v.= "'".$tempv."',"; 
                            }
                         }
                         }
                         else
                         {
//                              if($this->C("db_type")=="mysql") 
//                              {
//                               $v.= "'".mysql_escape_string(urldecode($value))."'"; 
//                              }
//                              else
//                              {
//                               $v.= "'".trim(preg_replace("/\'/","''",urldecode($value)))."'";  
//                              }  
                         }  
                         $w.=" ".$key." in (".$v.")";
                         break;
                           default:
                              // if(($op!='(')||($op!=')'))
                               {
                              // $w=preg_replace('/\s?(and|or|like)$/i', '',trim($w));
                              // $w=preg_replace('/(\s*(?:and|or|like)\s*)*$/im','',$w);   
                               }
                               $w.=" ".$op." ";
                            break;  
                     }
                 }    
             }
             $w=preg_replace("/\(\s*\)/","",$w);
             do
             {
              $len=strlen($w);         
              $w=preg_replace("/^\s*or\s*|\s*or\s*$/"," ",$w);
              $w=preg_replace("/^\s*and\s*|\s*and\s*$/"," ",$w);   
              $w=preg_replace("/^\s*like\s*|\s*like\s*$/"," ",$w); 
              $w=preg_replace("/\s+like\s+or\s+/"," or ",$w); 
              $w=preg_replace("/\s+like\s+and\s+/"," and ",$w); 
              $w=preg_replace("/\s+like\s+like\s+/"," like ",$w); 
              $w=preg_replace("/\s+or\s+and\s+/"," and ",$w); 
              $w=preg_replace("/\s+or\s+like\s+/"," like ",$w); 
              $w=preg_replace("/\s+or\s+or\s+/"," or ",$w); 
              $w=preg_replace("/\s+and\s+or\s+/"," and ",$w);    
              $w=preg_replace("/\s+and\s+like\s+/"," like ",$w);    
              $w=preg_replace("/\s+and\s+and\s+/"," and ",$w);    
              $w=preg_replace("/\s+\(\s+or\s+\)\s+/"," and ",$w);    
              $w=preg_replace("/\s+\(\s+and\s+\)\s+/"," and ",$w);    
              $w=preg_replace("/\s+\(\s+like\s+\)\s+/"," and ",$w);    


			  $w=preg_replace("/\s+and\s+\)/"," ) ",$w);
			  $w=preg_replace("/\s+or\s+\)/"," ) ",$w);
			  $w=preg_replace("/\s+like\s+\)/"," ) ",$w);

			  $w=preg_replace("/\(\s+and\s+/"," ( ",$w);
			  $w=preg_replace("/\(\s+like\s+/"," ( ",$w);
			  $w=preg_replace("/\(\s+or\s+/"," ( ",$w);

              $len2=strlen($w);
              if($len==$len2)
              break;
             }while(true);
             
             if(trim($w)=="")
             {
                 return "";
             } else
             {
             return "  where ".$w;
             }
            
         }