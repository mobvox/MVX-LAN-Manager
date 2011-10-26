<meta charset="utf-8" />
<?php
// file: find/list/index.php
// creation date: 17/10/2011
// description: find the mac address by ip

include_once("../../includes/classes.php");
	$db = new DBManager();
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
?>