<?php
require_once 'SmartClean.php';
class Iterator24 extends SmartClean {

  public $cache = [];
  public function __construct() {
    parent::__construct();
  }

  public function init() {
    // инициализация итератора, копирование конфигурации в память
    $this->cache[0]['fallout'] = $this->fallout->generate(1); // init seed
    $this->cache[0]['streets'] = $this->street->selectAll();
    $this->cache[0]['transport'] = $this->transport->selectAllRefs();
  }

  public function search($depth = 5, $cacheVersion = []) { // resursive iteration
    for ($i = 1; $i <= $depth; $i++) {
      // $this->cache[$i] = $this->makeStep($this->cache[$i - 1]);

      // Drop water on the streets;
      $fallouts = $this->cache[$i - 1]['fallout'];
      foreach ($fallouts as $fallout) {
        // moving rain drops
      }
      // print_r($fallout);

      $routePool = $this->getTrasportRoutesAvailable($this->cache[0]['transport'])
      $weight = $this->helper->analyzeMetrics();
      // $this->render->draw('./Iterator/cache/1.png');
      // file_put_contents('./Iterator/cache/'.$i.'.cache', gzencode(json_encode($this->cache), 9));
    }
    // выполяет серию итераций заданной глубины
    return $this->cache;
  }
}
