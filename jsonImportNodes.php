<?php
require_once './Main/SmartClean.php';
$smartClean = new SmartClean(['model' => ['id' => 1]]);

if(!isset($_GET['map_id'])) die('Enter the map_id, please!');

$objArray = json_decode(file_get_contents("JSON.json"),true);
//print_r($objArray);
for($i=0;$i<Count($objArray["elements"]);$i++) {
	if($objArray['elements'][$i]["type"] == "node") {
		// echo $objArray['elements'][$i]["id"]." ".$objArray['elements'][$i]["lat"]." ".$objArray['elements'][$i]["lon"]."\n";
		$smartClean->point->add(
			$objArray['elements'][$i]["id"], 
			$objArray['elements'][$i]["lat"], 
			$objArray['elements'][$i]["lon"],
			$_GET['map_id']
		);
	}
}


?>
