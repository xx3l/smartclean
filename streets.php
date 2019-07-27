<?php
require_once './Main/SmartClean.php';
$smartClean = new SmartClean(['model' => ['id' => 1]]);
print_r($smartClean->street->selectAll());
?>
