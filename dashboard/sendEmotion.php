<?php


if(isset($_POST["emotion"])){
  $json =$_POST["emotion"];
  //$array = json_decode($json, true);
  echo"Got JSON response";
  $fp = fopen('sampleEmotion.json', 'w');
  fwrite($fp, $json);
  fclose($fp);
}

if(!isset($_POST["qr"]) && !isset($_POST["emotion"])){
  echo "No post variable was detected";
}

if(isset($_POST["key"])){

echo $_POST["key"];
}

/*
function getMaxEmo($arr){
  $arrayTemp = $arr;
	for($i = 0; $i < count($arrayTemp) ; $i++){
		$returnArray[] = $arrayTemp[$i];
	}
	return $returnArray;
}
*/

?>