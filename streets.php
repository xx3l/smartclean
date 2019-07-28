<?php
require_once './Main/SmartClean.php';
$smartClean = new SmartClean(['model' => ['id' => 1]]);

// 1. Найти все улицы
$streets = $smartClean->street->selectAll();
//print_r($streets);

// 1.5. Найти все пройденные улицы за последние 2 часа
$visited_streets_ids = [];// $smartClean->street->selectVisitedStreets(60); // за последние 60 мин

// 2. Определить технику и вершины, ближайшие к технике
$transports = $smartClean->transport->selectAllWithNearestPoint();
//print_r($transports);

$sum_len = [];				// длины маршрутов в км.
$last_node = [];			// id последней точки в маршруте
for ($i=0; $i < sizeof($transports); $i++) {
	$sum_len[$i] = 0;
	$last_node[$i] = $transports[$i]["point_id"];
}

// 3. увеличивать маршруты, пока для каждой машины не будет вычислено минимум 5 км. расстояние
$min_len = 0;				// длина минимального маршрута
$i_min_len = 0;				// номер минимального маршрута
$count = 0;
while ($count < 1000 && $min_len < 5) {

	// 4. Находим улицу, которая ещё не пройдена
	// и которая идёт следом за последней в этом массиве
	$flag = 0;
	for ($i=0; $i < sizeof($streets); $i++)
		if (!in_array($streets[$i]["street_id"], $visited_streets_ids) && ($streets[$i]["p1"] == $last_node[$i_min_len] || !$streets[$i]["one_way"] && $streets[$i]["p2"] == $last_node[$i_min_len])) {
			// нашли - добавляем
			$is_p1 = ($streets[$i]["p1"] == $last_node[$i_min_len]);
			$visited_streets_ids[] = $streets[$i]["street_id"];
			$last_node[$i_min_len] = $streets[$i]["street_id"];
			$sum_len[$i_min_len] += $streets[$i]["len"];
			$min_len = min($sum_len);
			//if ($is_p1)       
			print_r($streets[$i]);
				$p = $smartClean->point->get($streets[$i]["p1"]);
				$smartClean->routePoint->prepare($transports[$i]["transport_id"], $streets[$i]["street_id"], $p['lat'], $p['lon']);
			$flag = 1;
			break;
		}

	// 5. если не добавилась ни одна улица, то можно повторно пройти по одной из улиц (но не обратно)
	if (!$flag) {
		for ($i=0; $i < sizeof($streets); $i++)
			if (($streets[$i]["p1"] == $last_node[$i_min_len] || !$streets[$i]["one_way"] && $streets[$i]["p2"] == $last_node[$i_min_len])) {
				// нашли - добавляем
				$visited_streets_ids[] = $streets[$i]["street_id"];
				$last_node[$i_min_len] = $streets[$i]["street_id"];
				$sum_len[$i_min_len] += $streets[$i]["len"];
				$min_len = min($sum_len);
				$flag = 1;
				break;
			}
	}

	// 6. если и такую не нашли, то это тупик и идём обратно
	if (!$flag) {
/*		$last_node[] = $streets[$i]["street_id"];
		$sum_len += $streets[$i]["len"];
		$min_len = min($sum_len);
		$i_min_len = size($visited_streets_id[]) - 1;
		$flag = 1;*/
	}

	// 7. обновляем индекс минимального по длине маршрута
	for ($i=0; $i < sizeof($sum_len); $i++)
		if ($min_len < $sum_len[$i]) {
			$min_len = $sum_len[$i];
			$i_min_len = $i;
		}

	$count++;
}

// 7. Сохраняем найденные маршруты
//print_r($visited_streets_ids);

// 6. Если есть более приоритетный участок улицы, то ближайшая техника должна ехать к нему

?>
