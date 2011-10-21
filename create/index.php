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
					}
					$.get("/computers/find/mac", {ip : $("form fieldset input#ip").val()} , function(data){
						if(data == "invalid address"){
							$("form fieldset input#ip").css("border", "2px solid red");
						}else if(data == ""){
							$("form fieldset input#mac").val("not found");
						}else{
							$("form fieldset input#mac").val(data);
						}
						
					});
					
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

function isMACValid(){
	$macRegEx = "/^(([0-9a-f]{2}([:-]|)){6})$/";
	if(preg_match($macRegEx, $_POST['mac'])){
		return true;
	}else{
		return false;
	}
}
function isIPValid(){
	$ipRegEx = "/^(\b\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\b)$/";
	if(preg_match($ipRegEx, $_POST['ip'])){
		return true;
	}else{
		return false;
	}
}

function verifyFields(){
	$fieldsArray = array("mac", "ip", "user");
	$unfilledArray = array();

	foreach ($fieldsArray as $field){
		if((!isset($_POST[$field])) || ($_POST[$field] == "")){
			array_push($unfilledArray, $field);
		}
	}
	if(!in_array("mac",$unfilledArray)){
		if(!isMACValid()){
			array_push($unfilledArray, "mac");
		}
	}
	if(!in_array("ip",$unfilledArray)){
		if(!isIPValid()){
			array_push($unfilledArray, "ip");
		}
	}
	if(count($unfilledArray) > 0){
		return $unfilledArray;
	}else{
		return true;
	}
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$verifyFields = verifyFields();
	$error = array("mac"=>"", "ip"=>"", "user"=>"", "active"=>"");
	if(!is_array($verifyFields)){
		$db = new DBManager();
		$active = 0;
		if(isset($_POST["active"])){
			$active = 1;
		}
		$db->insert($_POST["mac"], $_POST["user"], $_POST["comments"], $_POST["ip"], $active);


	}else{
		echo "You must fill out the required fields. ";
		foreach($verifyFields as $field){
			$error[$field] = "<span class='error'>*</span>";
		 	echo $field . " ";
		}
	}
}
?>

	<div id="content">
		<form id="create_form" method="post" action="">
			<fieldset><legend>new computer</legend>
				
				<span>IP Address:</span><?php if(isset($error)){echo $error["ip"];} ?><br />
					<input type="text" name="ip" id="ip" /><br />
				<span>MAC Address:</span><?php if(isset($error)){echo $error["mac"];} ?> <a href="#" class="find">find</a><br />
					<input type="text" name="mac" id="mac" /><br />
				<span>User:</span><?php if(isset($error)){echo $error["user"];} ?><br />
					<input type="text" name="user" id="user" /><br />
				<span>Comments:</span><br />
					<textarea id="comments" name="comments"></textarea><br />
				<span>Activo:</span>
					<input type="checkbox" name="active" id="active" /><br />

					<input type="submit" name="submit" id="submit" value="send" />

			</fieldset>
		</form>
	</div>
</body>

</html>