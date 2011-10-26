<meta charset="utf-8" />
<?php
// file: find/list/index.php
// creation date: 17/10/2011
// description: find the mac address by ip

include_once("../../includes/classes.php");
	$db = new DBManager();
<<<<<<< HEAD
	$server = new ServerManager();

	$arpcache = $db->getCache();
	$list = "";
	$lastUpdate;
	while($row = mysql_fetch_assoc($arpcache)){
		$lastUpdate = $row["timestamp"];
		$list .= "<div id='row'>" . $row["mac"] . " → " . $row["ip"] . "</div>";
	}

	echo "<div id='lastupdate'>Last update: " . $lastUpdate . "</div>";
	echo $list;
	mysql_free_result($arpcache);
=======
	
	$arpcache = $db->getCacheArray();
	
	echo "<div id='last_update'>Last update: " . $arpcache["timestamp"] . "</div>";

	while ($mac = current($arpcache["array"])) {
   	 	echo "<div id='table_row' >" . $mac . " → " . key($arpcache["array"]) . "</div>";

    	next($arpcache["array"]);
	}
>>>>>>> ad2b21e6b06076f2914afad39aa1503df209fe25
?>