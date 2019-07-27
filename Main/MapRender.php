<?php
class MapRender {
  public function __costruct($config) {
    $this->config = $config;
    $this->db = new Db($config['db']);

  }
}
