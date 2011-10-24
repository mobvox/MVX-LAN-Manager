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
		}else{
			echo "invalid address";
		}		
	}
}
?>