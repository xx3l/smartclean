<?php
class MapPointClass {
  protected $config;

  public function __construct($config) {
    $this->config = $config;
    $this->db = new Db($config['db']);
  }
  function add($lat, $lon, $height = 0) {
    $this->db->insert(
      'point', [
        'map_id' => $this->config['model']['id'],
        'lat' => $lat,
        'lon' => $lon,
        'height' => $height,
      ]
    );
  }
}
?>
