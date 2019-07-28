<?php
class Iterator extends SmartClean {
  public function __construct() {

  }

  public function init() {
    // инициализация итератора, копирование конфигурации в память
    $this->cache[0]['fallout'] = $this->fallout->generate();
    $this->cache[0]['streets'] = $this->streets->selectAll();
    $this->cache[0]['transport'] = $this->transport->selectAll();
  }

  public search($numIterations = 1) {
    // выполяет серию итераций заданной глубины
  }
}
