<?php


$ipRegEx = "/\b\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\b/";

$macRegEx = "/(([0-9a-f]{2}([:-]|)){6})/";

$contentArray = array();

$errorJson = '{"return":"error","error":"invalid-field-content","fields":"';

$hasErrors = false;
if($_SERVER['REQUEST_METHOD'] == "GET"){
	if(isset($_GET["ip"])){
		preg_match($ipRegEx, $_GET["ip"], $matches);
		if(isset($matches[0])){
			$contentArray["ip"] = $matches[0];
		}else{
			$errorJson .= 'ip|';
			
		}
	}

	if(isset($_GET["mac"])){
		preg_match($macRegEx, $_GET["mac"], $matches);
		if(isset($matches[0])){
			$contentArray["mac"] = $matches[0];
		}else{
			$errorJson .= 'mac|';
			$hasErrors = true;
		}
	}

	if(isset($_GET["user"])){
		if($_GET["user"] != ""){
			$contentArray["user"] = $_GET["user"];
		}else{
			$errorJson .= 'user|';
			$hasErrors = true;
		}
	}else{
		$errorJson .= 'user|';
		$hasErrors = true;
	}
	if(isset($_GET["comments"])){
		$contentArray["comments"] = $_GET["comments"];
	}
}

$errorJson .= '"}';

if($hasErrors != true){
	echo '{"return":"success"}';
}else{
	echo $errorJson; 
}
?>