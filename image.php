<?php
require_once './Main/SmartClean.php';
$smartClean = new SmartClean(['model' => ['id' => $_GET['map_id']]]);
$smartClean->render->config['render']['resolution'] = [$_GET['x'] ?? 800, $_GET['y'] ?? 600];
$smartClean->render->config['render']['box']['lat1'] = $_GET['lat1'] ?? 0;
$smartClean->render->config['render']['box']['lat2'] = $_GET['lat2'] ?? 0;
$smartClean->render->config['render']['box']['lon1'] = $_GET['lon1'] ?? 0;
$smartClean->render->config['render']['box']['lon2'] = $_GET['lon2'] ?? 0;
$smartClean->render->draw();
