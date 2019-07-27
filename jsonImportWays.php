<?php
require_once './Main/SmartClean.php';
$smartClean = new SmartClean(['model' => ['id' => 1]]);

function LatLonLen($lat1,$lon1,$lat2,$lon2) {
  $r = 6371; // Radius of the earth in km
  $dLat = deg2rad($lat2-$lat1);  // deg2rad below
  $dLon = deg2rad($lon2-$lon1); 
  $a = 	sin($dLat/2) * sin($dLat/2) +
		cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * 
		sin($dLon/2) * sin($dLon/2); 
  $c = 2 * atan2(sqrt($a), sqrt(1-$a)); 
  $d = $r * $c; // Distance in km
  return $d;
}
/*
function deg2rad($deg) {
  return ($deg * (pi()/180));
}
*/
$objArray = json_decode(file_get_contents("newJSON.json"),true);
//print_r($objArray);
for($i=0;$i<Count($objArray["elements"]);$i++) {
	if($objArray['elements'][$i]["type"] == "way") {

		for($j=0;$j<count($objArray['elements'][$i]["nodes"])-1;$j++) {
			$p1 = $objArray['elements'][$i]["nodes"][$j];
			$p2 = $objArray['elements'][$i]["nodes"][$j+1];
			if(isset($objArray['elements'][$i]["tags"]["oneway"]) && strtolower($objArray['elements'][$i]["tags"]["oneway"]) == "yes") $oneway = 1;  else $oneway = 0;
			$node1 = $smartClean->point->get($objArray['elements'][$i]["nodes"][$j]);
			$node2 = $smartClean->point->get($objArray['elements'][$i]["nodes"][$j+1]);
			echo LatLonLen($node1["lat"],$node1["lon"],$node2["lat"],$node2["lon"])." ";
			
		//	$smartClean->street->add(str_replace(",","",$p1), str_replace(",","",$p2), $oneway);
			
		}
	}
}


?>
