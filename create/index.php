<!DOCTYPE html>

<html>
	<head>
		<title>Computer Manager - new computer</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../site/css/base.css" />
		<script src="../site/js/jquery-1.6.4.min.js" type="text/javascript" ></script>
		<script type="text/javascript">
			$(function(){

				// TODO: STYLESHEET, this actually is a shit
				$("form fieldset a.find").click(function(){
					if($("form fieldset input#ip").val() == ""){
						$("form fieldset input#ip").css("border", "2px solid red");
					}else{
						$("form fieldset input#ip").css("border", "2px solid #666666");
						$.get("../find/mac", {ip : $("form fieldset input#ip").val()} , function(data){
							if(data == "invalid address"){
								$("form fieldset input#ip").css("border", "2px solid red");
							}else if(data == ""){
								$("form fieldset input#mac").val("not found");
							}else{
								$("form fieldset input#mac").val(data);
							}
					});
					}					
				});

				$("form fieldset a.list").click(function(){
					$.get("../find/list" , function(data){
							$("div#list").html(data);					
					});
				})

				$("form fieldset a.find_mac").click(function(){
					if($("form fieldset input#mac").val() == ""){
						$("form fieldset input#mac").css("border", "2px solid red");
					}else{
						$("form fieldset input#mac").css("border", "2px solid #666666");
						$.get("../find/ip", {mac : $("form fieldset input#mac").val()} , function(data){
							if(data == "invalid address"){
								$("form fieldset input#mac").css("border", "2px solid red");
							}else if(data == ""){
								$("form fieldset input#ip").val("not found");
							}else{
								$("form fieldset input#ip").val(data);
							}
						
					});
					}					
				});
				
			});
		</script>
	</head>
<body>

<?php
 // file: create/index.php
 // creation date: 17/10/2011
 // description: create new computer register form

include_once("../includes/classes.php");

?>

	<div id="content">
		<form id="create_form" method="post" action="">
			<fieldset><legend>new computer</legend>
				
				<span>IP Address:</span><?php if(isset($error)){echo $error["ip"];} ?> <a href="#" class="list">show-me a list</a> <a href="#" class="find_mac">find</a><br />
					<input type="text" name="ip" id="ip" /><br />
				<span>MAC Address:</span><?php if(isset($error)){echo $error["mac"];} ?> <a href="#" class="find">find</a><br />
					<input type="text" name="mac" id="mac" /><br />
				<span>User:</span><?php if(isset($error)){echo $error["user"];} ?><br />
					<input type="text" name="user" id="user" /><br />
				<span>Comments:</span><br />
					<textarea id="comments" name="comments"></textarea><br />
				<span>Active:</span>
					<input type="checkbox" name="active" id="active" /><br />

					<input type="submit" name="submit" id="submit" value="send" />

			</fieldset>
		</form>
		<div id="list"></div>
	</div>
</body>

</html>