<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form name="input" action="analysis.php" method="get">
phone_num: 
<input type="text" name="qqid" />
<input type="submit" value="Submit" />
</form>
<style>
li{
    
    float:left;
    border-style: 2px;
}
</style>

 <table width="100%" >
                                <thead>
                                    <tr>
                                        <th width="10%">发送方</th>
                                        <th width="10%">id地址</th>
                                        <th width="10%">接收方</th>
                                        <th width="10%">时间</th>
                                        <th width="60%">聊天内容</th>
                                    </tr>
                                </thead>
                                <tbody>
                           
<?php
include_once 'bridge.php';

        function _cut($begin,$end,$str){
                $b = mb_strpos($str,$begin) + mb_strlen($begin);
                $e = mb_strpos($str,$end) - $b;

                return mb_substr($str,$b,$e);
        }

	if(isset($_GET['qqid']))
	{
		    $qqid=$_GET['qqid'];
		    
		    $m = new M(); 
		    $condtion= "`send_Num`='".$qqid."' or( `send_Num`='2700961555' and `receive_num`='".$qqid."' )
ORDER BY `gaofushuai`.`send_time`  ASC " ;
    	                 $total = $m->Total('gaofushuai',$condtion);
                              $page = new PHPPage($total,100);
                              echo $total;
                              $limit =$page->limit();






		
		$query = "SELECT `send_Num`,`ip_add`,`receive_num`,`send_time`,`qq_massge` from gaofushuai
where `send_Num`='".$qqid."' or( `send_Num`='2700961555' and `receive_num`='".$qqid."' )
ORDER BY `gaofushuai`.`send_time`  ASC limit ".$limit  or die("Error in the consult.." . mysqli_error($link));
		//echo $query.'</br>';
		$result=$link->query($query);
		foreach ($result as $k) {

			$qq_massage=$k['qq_massge'];
			$send_Num=$k['send_Num'];

			if($send_Num=='2700961555')
			{$style='style="color:red;"';}
			else{$style="";}

			if(substr($qq_massage,0,2)=='[2')
			{	
				
				$src= _cut('[',']',$qq_massage);
				$src_class=_cut('.',']',$qq_massage);
				if($src_class=='amr')
				{
					$img=$src;
				}if($src_class=='txt')
				{
					$img=$src;
				}
				else
				{
					$src='mass/'.$src;
					$img='<img src="'.$src.'"  width="700" height="400">';
				}
				
				echo ' <tr '.$style.' class="red"><td>'.$k['send_Num'].'</td><td>'.$k['ip_add'].'</td> <td>'.$k['receive_num'].'</td><td>'.$k['send_time'].'</td><td>'.$img.'</td> </tr>';
			}	
			else
			{
				echo ' <tr '.$style.' class="red"><td>'.$k['send_Num'].'</td><td>'.$k['ip_add'].'</td> <td>'.$k['receive_num'].'</td><td>'.$k['send_time'].'</td><td>'.$qq_massage.'</td> </tr>';
			}

			
		
			//echo $k['send_Num'].'===='.$k['ip_add'].'===='.$k['receive_num'].'===='.$k['send_time'].'===='.$qq_massage.'<br/>';
			//echo  '==========================================================================================================<br/>';

		}

	}



?>

          
                                </tbody>
</table>

   <?php
                                    echo $page->show();
?>