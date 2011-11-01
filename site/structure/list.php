<script>
$(function(){
	$('input#filtrar').quicksearch("div.content div.center_content ul li");
	
});
</script>
<div class="list_heading">
	<span> Filtrar: </span>
	<input type="text" id="filtrar"/>
</div>
<div class="list">
	<ul>
	<?php

	include_once("../../includes/classes.php");

	$db = new DBManager();
	$arpcache = $db->getCache();

	while($row = mysql_fetch_assoc($arpcache)){
		
	?>
	<li>
		<div class="buttons_toolkit">
			<div class="power_button"><a href="#"><img src="site/images/power-off.png"></a></div>
			<div class="edit_button"><a href="#"><img src="site/images/edit.png"></a></div>
			<div class="trash_button"><a href="#"><img src="site/images/trash.png"></a></div>
		</div>
		<div class="computer_info">
			<div id="computer_icon">&nbsp;</div>
			<div id="info">
				<p id="user">Jonas Trevisan</p>
				<p id="ip"><?php echo $row["ip"] ?></p>
				<p id="mac"><?php echo $row["mac"] ?></p>
				<p>Status: <span id="status" class="offline">OFFLINE</span></p>
			</div>
		</div>
		<div class="comments">
			<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam</p>
		</div>
	</li>
	<?php
	}
		mysql_free_result($arpcache);
	?>
</ul>
</div>