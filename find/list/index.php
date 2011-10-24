<?php
// file: find/list/index.php
// creation date: 17/10/2011
// description: find the mac address by ip

include_once("../../includes/classes.php");
	$server = new ServerManager();
	$db = new DBManager();
	
	$ipList = $server->getIPAddressList();
	$macList = $server->getMACAddressList($ipList);


	foreach($ipList as $ip){
		if (isset($macList[$ip])){
			$dbRegister = $db->getComputerByMAC($macList[$ip]);
			
			if(isset($dbRegister[0])){
				echo "<div>" . $dbRegister . " - " . $ip . " - " . $macList[$ip] . "</div><br />";
			}else{
				echo "<div>" . $ip . " - " . $macList[$ip] . "</div><br />";
			}
			
		}
		
	}

?>