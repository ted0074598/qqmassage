<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '\Classes\PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data

// Miscellaneous glyphs, UTF-8







			$link = mysqli_connect("localhost","root","","qqmassage") or die("Error " . mysqli_error($link));
			//consultation:
			//execute the query.
			$link->query("SET character_set_client='utf8'");
			$link->query("SET character_set_connection='utf8'");
			
			
				if (isset($_GET['phone_num']))
				{ 
							$count_num=$_GET['phone_num'];
				
							$link->query("SET character_set_results='utf8'");
							
							$query = "SELECT `send_Num`,`ip_add`,`receive_num`,`send_time`,`qq_massge` from gaofushuai
where `send_Num`='".$count_num."' or( `send_Num`='2700961555' and `receive_num`='".$count_num."')
ORDER BY `gaofushuai`.`send_time`  ASC  "  or die("Error in the consult.." . mysqli_error($link));
							//echo $query.'</br>';
							$result=$link->query($query);
							//$result->fetch_array(MYSQLI_ASSOC);
							
							$i=1;
							while ($show=$result->fetch_array(MYSQLI_ASSOC)) {
									
		//echo '|'.$show['send_Num'].'|'.$show['ip_add'].'|'.$show['receive_num'].'|'.$show['send_time'].'|'.$show['qq_massge'].'|</br>';
								$A='A'.$i;
								$B='B'.$i;
								$C='C'.$i;
								$D='D'.$i;
								$E='E'.$i;
								
					$objPHPExcel->setActiveSheetIndex(0)
									   ->setCellValue($A,$show['send_Num'])
									   ->setCellValue($B,$show['ip_add'])
								       ->setCellValue($C,$show['receive_num'])
									   ->setCellValue($D,$show['send_time'])
									   ->setCellValue($E,$show['qq_massge']);
					

 					$objPHPExcel->getActiveSheet()->getStyle($A)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);



									         
								$i++;	            	

								
							}
				








//=======================================================================================

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle($count_num);



// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); 
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25); 
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); 
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25); 
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);  



// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$count_num.'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

}

?>



<form name="input" action="select.php" method="get">
phone_num: 
<input type="text" name="phone_num" />
<input type="submit" value="Submit" />
</form>

<?php
					$link->query("SET character_set_results='utf8'");
					$query = "select t1.对方号码,count(*) as 联系频率 
							from 
							(

							SELECT id,
							    (
							     case send_Num
							     	when '2700961555' then receive_num
							     	else send_Num
							     end
							     ) as '对方号码'
							FROM `gaofushuai`

							) as t1
							group by t1.对方号码
							having 联系频率>300
							ORDER BY `联系频率`  DESC"  or die("Error in the consult.." . mysqli_error($link));
							//echo $query.'</br>';
							$result=$link->query($query);
							foreach ($result as $key) {

								echo '<a href="select.php?phone_num='.$key['对方号码'].'">'.$key['对方号码'].'</a><====>'.$key['联系频率'].'次<br/>';
							}


?>