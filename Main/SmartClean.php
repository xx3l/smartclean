<?php
// это файл с основным классом
require_once 'Db.php';
require_once 'MapPoints.php';
require_once 'MapStreets.php';
require_once 'MapFallout.php';
require_once 'MapRender.php';

class SmartClean {
  public $config = [];
  protected $db;
  protected $modelId = 0;
  public $point, $street, $fallout, $render;

  public function __construct($param) {
    include 'config.php';

    $this->config = $config;

    $this->config['model']['id'] = $paran['model']['id'] ?? 1;

    $this->db_session = mysqli_connect($this->config['db']['host'], $this->config['db']['user'], $this->config['db']['password']);
    $this->db = new Db($this->config['db']);
    $this->point = new MapPointClass($this->config);
    $this->street = new MapStreetClass($this->config);
    $this->fallout = new MapFalloutClass($this->config);
    $this->render = new MapRender($this->config);
    $this->log('Class loaded');
  }

  public function log($message) {
    if ($this->config['debug']) {
      $fp = fopen($this->config['log']['path'], 'a+');
      fwrite($fp, date('Y.m.d H:i:s ').$message."\n");
      fclose($fp);
    }
    return;
  }
}


?>
