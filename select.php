<form name="input" action="select.php" method="get">
phone_num: 
<input type="text" name="phone_num" />
<input type="submit" value="Submit" />
</form>


<?php



			$link = mysqli_connect("localhost","root","","qqmassage") or die("Error " . mysqli_error($link));
			//consultation:
			//execute the query.
			$link->query("SET character_set_client='utf8'");
			$link->query("SET character_set_connection='utf8'");
			
			
				if (isset($_GET['phone_num']))
				{ 
							$phone_num=$_GET['phone_num'];
				
							$link->query("SET character_set_results='utf8'");
							
							$query = "select  `send_Num`,`ip_add`,`send_time` from gaofushuai where `send_Num`='".$phone_num."'  ORDER BY `send_time` DESC  limit 20"  or die("Error in the consult.." . mysqli_error($link));
							echo $query.'</br>';
							$result=$link->query($query);
							//$result->fetch_array(MYSQLI_ASSOC);
							$i=1;
							while ($show=$result->fetch_array(MYSQLI_ASSOC)) {
									
								echo '</br>'.$show['send_Num'].'</br>'.$show['ip_add'].'</br>'.$show['send_time'].'</br></br></br></br></br>';
								
								$i++;
							}
				}



?>




<?php 



			

?>