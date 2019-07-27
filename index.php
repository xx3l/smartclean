<?php
require_once './Main/SmartClean.php';
$smartClean = new SmartClean(['model' => ['id' => 1]]);

// примеры исползоватния методов
//
// -- points
// $pointID = $smartClean->point->add(OSMid, lat, lon, [height]);
// $smartClean->point->delete($pointID);
// $smartClean->point->get($pointID);
//
// -- streets
// $smartClean->street->add(p1, p2, [path_id = 0], [one_way = 0], [width], [len], [priority], [active]);
// $smartClean->street->delete($pointID);
// $smartClean->street->get($pointID);

// $smartClean->point->add(87687, 123, 32);
// $smartClean->point->add(333, 5, 6);
// $smartClean->point->delete(333);
$r = $smartClean->point->get(285814785);
print_r($r);
?>
