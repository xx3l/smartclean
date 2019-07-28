<?php
require_once './Main/Iterator.php';

$model = $argv[1] ?? 0;
if ($model == 0) {
  die("Use CLI launch with iterator.php <modelID>\n");
}
print "Using model ".$model."\n";
$iter = new Iterator24(['model' => ['id' => $model]]);
$iter->init();
$iter->search(5);
