<?php
require_once './Main/SmartClean.php';
$smartClean = new SmartClean(['model' => ['id' => 1]]);

// 1. Найти все улицы и технику
$streets = $smartClean->street->selectAll();
//print_r($streets);
$transports = $smartClean->transport->selectAll();
print_r($transports);

?>
