<?php
require_once './Main/SmartClean.php';
$smartClean = new SmartClean(['model' => ['id' => 1]]);




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
      $len = $smartClean->helper->LatLonLen($node1["lat"],$node1["lon"],$node2["lat"],$node2["lon"]);

      $smartClean->street->add(str_replace(",","",$p1), str_replace(",","",$p2), $oneway, 0,0,$len);

    }
  }
}


?>
