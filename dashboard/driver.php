<?php


if(isset($_POST["emotion"])){
echo "<br><h1>Detected a post variable with Emotion JSON</h1><br>";
  $json =$_POST["emotion"];
  $array = json_decode($json, true);
  echo"<br> The array decodede from json<br>";
  var_dump($array);
  echo"<br> The array encoded to json<br>";
  var_dump(json_encode(getMaxEmo($array)) );
  $fp = fopen('sampleEmotion.json', 'w');
  fwrite($fp, json_encode(getMaxEmo($array)));
  fclose($fp);
}

if(isset($_POST["qr"])){
  echo "<br><h1>Detected a post variable with Qr JSON</h1><br>";
  $json2 =$_POST["qr"];
  $array2 = json_decode($json2, true);
  echo"<br> The array decodede from json<br>";
  var_dump($array2);
  echo"<br> The array encoded to json<br>";

  var_dump(json_encode(getQr($array2)) );
  $fp2 = fopen('sampleQr.json', 'w');
  fwrite($fp2, json_encode(getQr($array2)));
  fclose($fp2);
}

if(!isset($_POST["qr"]) && !isset($_POST["emotion"])){
  echo "<br><h1>No post variable was detected</h1><br>";
  var_dump($_POST["qr"]);
  var_dump($_POST["emotion"]);
}

function getMaxEmo($arr){
  $arrayTemp = $arr["emotion"];
	for($i = 0; $i < count($arrayTemp) ; $i++){
		//$returnArray[] = max($arrayTemp[$i]["scores"]);// put id instead the value
		$returnArray[] = array_search(max($arrayTemp[$i]["scores"]), $arrayTemp[$i]["scores"]);
	}
  echo "<br>".count($returnArray)."<br>";
	return $returnArray;
}

function getQr($arr){
  $arrayTemp = $arr["qrs"];
  $returnArray2 = Array();
  for($i = 0; $i < count($arrayTemp) ; $i++){
    $temp= explode("-",$arrayTemp[$i]);
    $returnArray2[$temp[1]] = 0;

    }
  for($i = 0; $i < count($arrayTemp) ; $i++){
    $temp= explode("-",$arrayTemp[$i]);
     $returnArray2[$temp[1]] = $returnArray2[$temp[1]]+1;

    }
  echo "<br>".count($returnArray2)."<br>";
 return $returnArray2;
}

?>