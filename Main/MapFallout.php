<?php
class MapFalloutClass {

  public function __construct($config) {
    $this->config = $config['fallout'];
  }

  public function generate($seed) {
    $sources = [];
    mt_srand($seed);
    $direction = mt_rand(0, 359);
    for ($i = 0; $i < $this->config['generator']['rate']; ++$i) {
      $direction +=  mt_rand(-10, 10);
      $instance = [
        'lat' => 53 + (mt_rand(0, 1000000)/500000.0),
        'lon' => 102 + (mt_rand(0, 1000000)/500000.0),
        'r' => mt_rand(10, 100),
        'power' => mt_rand(1,10),
        'direction' => $direction,
        'speed' => mt_rand(30, 400)/10.0,
      ];
      array_push($sources, $instance);
    }
    return $sources;
  }

}
?>
