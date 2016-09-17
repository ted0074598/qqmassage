<?php
header("Content-type: text/html; charset=utf-8"); 

$link = mysqli_connect("localhost","root","","qqmassage") or die("Error " . mysqli_error($link));
//consultation:
//execute the query.
$link->query("SET character_set_client='utf8'");
$link->query("SET character_set_connection='utf8'");
//数据库结束
//
	


	//if isset()

		
		//$query = " SELECT * FROM `blackcard` WHERE `p_phone_class`='联通' and 'p_date'>'15-10-07 11:54:27' ORDER by `p_phone_class`  "  or die("Error in the consult.." . mysqli_error($link));
       $query = "select t1.send1,count(*) as countt 
from 
(

SELECT id,
    (
     case send_Num
     	when '2700961555' then receive_num
     	else send_Num
     end
     ) as send1
FROM `gaofushuai`

) as t1
group by t1.send1
having countt>=2901
ORDER BY countt  DESC"  or die("Error in the consult.." . mysqli_error($link));
	   echo $query.'</br>';
       $result=$link->query($query);
		//$result->fetch_array(MYSQLI_ASSOC);
		$i=1;
		while ($show=$result->fetch_array(MYSQLI_ASSOC)) {
			
			echo $show['send1'].'<=========>'.$show['countt'].'</br>';
			$i++;
			
			//$query="select count(*) as count from gaofushuai where send_Num=".$show['send_Num']." or receive_num=".$show['send_Num'];
			//echo $query.'</br>';
			//$qqnum=$show['send_Num'];
			
			
			
		}
		echo $i.'</br>';
		
		
		

?>