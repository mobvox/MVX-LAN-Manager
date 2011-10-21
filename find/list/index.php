<?php
// file: find/mac/index.php
// creation date: 17/10/2011
// description: find the mac address by ip

include_once("../../includes/classes.php");
	$server = new ServerManager();
	echo "</pre>";
	print_r($server->getMACAddressList($server->getIPAddressList()));
?>