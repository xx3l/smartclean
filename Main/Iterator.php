<?php
require_once 'SmartClean.php';
class Iterator extends SmartClean {

  public $cache = [];
  public function __construct() {

  }

  public function init() {
    // инициализация итератора, копирование конфигурации в память
    $this->cache[0]['fallout'] = $this->fallout->generate();
    $this->cache[0]['streets'] = $this->streets->selectAll();
    $this->cache[0]['transport'] = $this->transport->selectAllRefs();
  }

  public function search($numIterations = 5) {
    // выполяет серию итераций заданной глубины
  }
}
