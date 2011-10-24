<meta charset="utf-8" />
<?php
// file: find/list/index.php
// creation date: 17/10/2011
// description: find the mac address by ip

include_once("../../includes/classes.php");
	$db = new DBManager();
	
	$arpcache = $db->getCacheArray();
	
	echo "<div id='last_update'>Last update: " . $arpcache["timestamp"] . "</div>";

	while ($mac = current($arpcache["array"])) {
   	 	echo "<div id='table_row' >" . $mac . " → " . key($arpcache["array"]) . "</div>";

    	next($arpcache["array"]);
	}
?>