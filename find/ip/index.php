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
		}else{
			echo "invalid address";
		}		
	}
}
?>