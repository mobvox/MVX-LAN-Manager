<?php
// file: find/mac/index.php
// creation date: 17/10/2011
// description: find the mac address by ip

include_once("../../includes/classes.php");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$ipRegEx = "/\b\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\b/";
	if(isset($_GET['ip'])){
		preg_match($ipRegEx, $_GET['ip'], $matches);
		if(isset($matches[0])){
			$server = new ServerManager();
			echo $server->getMACAddress($matches[0]);
		}else{
			echo "invalid address";
		}		
	}
}
?>