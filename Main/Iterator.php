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
    $this->cache[0]['streets'] = $this->streets->selectAll();
    $this->cache[0]['transport'] = $this->transport->selectAllRefs();
  }

  public function search($numIterations = 5) {
    // выполяет серию итераций заданной глубины
  }
}
