<?php
// file: find/ip/index.php
// creation date: 24/10/2011
// description: find the ip address by mac

include_once("../../includes/classes.php");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$macRegEx = "/(([0-9a-f]{2}([:-]|)){6})/";
	if(isset($_GET['mac'])){
		preg_match($macRegEx, $_GET['mac'], $matches);
		if(isset($matches[0])){
			$db = new DBManager();
	
<<<<<<< HEAD
			$arpcache = $db->getCache();
			
			while($row = mysql_fetch_assoc($arpcache)){
				if($row["mac"] == $matches[0]){
					echo $row["ip"];
					mysql_free_result($arpcache);
					return;
				}
			}
			echo "Not Found!";
			mysql_free_result($arpcache);
=======
			$arpcache = $db->getCacheArray();
			
			while($mac = current($arpcache["array"])){
				if($mac == $matches[0]){
					echo key($arpcache["array"]);
					return;
				}else{
					next($arpcache["array"]);
				}
			}
			echo "not found";
>>>>>>> ad2b21e6b06076f2914afad39aa1503df209fe25
		}else{
			echo "invalid address";
		}		
	}
}
?>