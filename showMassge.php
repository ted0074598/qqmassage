<?php
header("Content-type: text/html; charset=utf-8"); 
require_once 'Classes/PHPExcel.php';




$link = mysqli_connect("localhost","root","","qqmassage") or die("Error " . mysqli_error($link));
//consultation:
//execute the query.
$link->query("SET character_set_client='utf8'");
$link->query("SET character_set_connection='utf8'");
//$link->query("SET character_set_results='utf8'");
//数据库结束


/**对excel里的日期进行格式转化*/
function GetData($val){
	$jd = GregorianToJD(1, 1, 1970);
	$gregorian = JDToGregorian($jd+intval($val)-25569);
	return $gregorian;/**显示格式为 “月/日/年” */
}

$filePath = 'qq5.xls';
set_time_limit(0);

$PHPExcel = new PHPExcel();

/**默认用excel2007读取excel，若格式不对，则用之前的版本进行读取*/
$PHPReader = new PHPExcel_Reader_Excel2007();
if(!$PHPReader->canRead($filePath)){
	$PHPReader = new PHPExcel_Reader_Excel5();
	if(!$PHPReader->canRead($filePath)){
		echo 'no Excel';
		return ;
	}
}

$PHPExcel = $PHPReader->load($filePath);
/**读取excel文件中的第一个工作表*/
$currentSheet = $PHPExcel->getSheet(0);
/**取得最大的列号*/
$allColumn = $currentSheet->getHighestColumn();
/**取得一共有多少行*/
$allRow = $currentSheet->getHighestRow();
/**从第二行开始输出，因为excel表中第一行为列名*/


echo $allRow.'<br/>';

for($currentRow = 2;$currentRow <= $allRow;$currentRow++){
	//for($currentRow = 2;$currentRow <= 2;$currentRow++){
       //  从第A列开始输出
	 
	for($currentColumn= 'A';$currentColumn<= $allColumn; $currentColumn++){
		 
		 $val = $currentSheet->getCellByColumnAndRow(ord($currentColumn)-65,$currentRow)->getValue();/**ord()将字符转为十进制数*/
		 
		
				 if(ord($currentColumn)-65==0)
				 {
				 	$send_Num=$val;
				 }		
					    
				 if(ord($currentColumn)-65==2)
				 {
				 	$ip_add=$val;
				 }
			    if(ord($currentColumn)-65==3)
			    {
			    	$receive_num=$val;
			    }
	
			 
			    if(ord($currentColumn)-65==5)
			    {
			    	$send_time=$val;
			    }
			     if(ord($currentColumn)-65==6)
			    {
			    	$qq_massge=$val;
			    }
			    
			    
			    
			    
	    }
	    	echo "</br>";
	    
		
		

		
				echo $send_Num.'----'.$ip_add.'----'. $receive_num.'----'. $send_time.'----'. $qq_massge.'</br>';
	

		echo '========================================================================</br>';
			
				$query='INSERT INTO `gaofushuai`(`send_Num`,`ip_add`,`receive_num`, `send_time`, `qq_massge`) VALUES
		        ("'.$send_Num.'","'
		        .$ip_add.'","'
		        .$receive_num.'","'
		        .$send_time.'","'
		        .$qq_massge.'")';
 
				   
		
				if($send_time>'2016-09-02 23:58:51')
				{

					echo $query.'<br/>';
							if($link->query($query))
				 		{
				 			echo "插入成功".'<br/>';
				 		}
				}
				
					
	



	  
}






?>