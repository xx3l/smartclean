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
print_r($transports);

$sum_len = [];				// длины маршрутов в км.
$last_node = [];			// id последней точки в маршруте
for ($i=0; $i < size($transports); $i++)
	$last_node[$i] = $transports[$i]["point_id"];

// 3. увеличивать маршруты, пока для каждой машины не будет вычислено минимум 5 км. расстояние
$min_len = 0;				// длина минимального маршрута
$i_min_len = 0;				// номер минимального маршрута

while ($min_len < 5) {

	// 4. Находим улицу, которая ещё не пройдена
	// и которая идёт следом за последней в этом массиве
	$flag = 0;
	for ($i=0; $i < size($streets); $i++)
		if (!in_array($streets["street_id"], $visited_streets) && ($streets["p1"] == $last_node[$i_min_len] || !$streets["one_way"] && $streets["p2"] == $last_node[$i_min_len])) {
			// нашли - добавляем
			$is_p1 = ($streets["p1"] == $last_node[$i_min_len]);
			$visited_streets_id[] = $streets["street_id"];
			$last_node[] = $streets["street_id"];
			$sum_len += $streets["len"];
			$min_len = min($sum_len);
			$i_min_len = size($visited_streets_id[]) - 1;
			echo "11111";
			print_r($transport[$i]["transport_id"]);
			print_r($streets["street_id"]);
			//if ($is_p1)
			//	$smartClean->routePoint->prepare($transport[$i]["transport_id"], $streets["street_id"], $streets["lat"], $lon) {
			$flag = 1;
			break;
		}

	// 5. если не добавилась ни одна улица, то можно повторно пройти по одной из улиц (но не обратно)
	if (!$flag) {
		for ($i=0; $i < size($streets); $i++)
			if (($streets["p1"] == $last_node[$i_min_len] || !$streets["one_way"] && $streets["p2"] == $last_node[$i_min_len])) {
				// нашли - добавляем
				$visited_streets_id[] = $streets["street_id"];
				$last_node[] = $streets["street_id"];
				$sum_len += $streets["len"];
				$min_len = min($sum_len);
				$i_min_len = size($visited_streets_id[]) - 1;
				echo "22222";
				print_r($transport[$i]["transport_id"]);
				print_r($streets["street_id"]);
				$flag = 1;
				break;
			}
	}

	// 6. если и такую не нашли, то это тупик и идём обратно
	if (!$flag) {
/*		$last_node[] = $streets["street_id"];
		$sum_len += $streets["len"];
		$min_len = min($sum_len);
		$i_min_len = size($visited_streets_id[]) - 1;
		$flag = 1;*/
	}
}

// 7. Сохраняем найденные маршруты
print_r($visited_streets_id);

// 6. Если есть более приоритетный участок улицы, то ближайшая техника должна ехать к нему

?>
