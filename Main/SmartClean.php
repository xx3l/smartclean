<?php
// это файл с основным классом
require_once 'Db.php';
require_once 'MapPoints.php';
require_once 'MapRoutePoints.php';
require_once 'MapStreets.php';
require_once 'MapTransports.php';
require_once 'MapFallout.php';
require_once 'MapRender.php';
require_once 'Helper.php';

class SmartClean {
  public $config = [];
  protected $db;
  protected $modelId = 0;
  public $point, $routePoint, $street, $transport, $fallout, $render;

  public function __construct($param = []) {
    include 'config.php';

    $this->config = $config;

    $this->config['model']['id'] = $param['model']['id'] ?? 1;

    $this->db_session = mysqli_connect($this->config['db']['host'], $this->config['db']['user'], $this->config['db']['password']);
    $this->db = new Db($this->config['db']);
    $this->point = new MapPointClass($this->config);
    $this->routePoint = new MapRoutePointClass($this->config);
    $this->street = new MapStreetClass($this->config);
    $this->transport = new MapTransportClass($this->config);
    $this->fallout = new MapFalloutClass($this->config);
    $this->render = new MapRender($this->config);
    $this->helper = new Helper($this->config);
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
