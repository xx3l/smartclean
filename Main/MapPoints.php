<?php
class MapPointClass {

  protected $config;

  public function __construct($config) {
    $this->config = $config;
    $this->db = new Db($config['db']);
  }
  function add($id, $lat, $lon, $height = 0) {
    return $this->db->insert(
      'point', [
        'point_id' => $id,
        'map_id' => $this->config['model']['id'],
        'lat' => $lat,
        'lon' => $lon,
        'height' => $height,
      ]
    );
  }

  function get($id) {
    return $this->db->get('point', $id);
  }

  function delete($id) {
    return $this->db->delete('point', $id);
  }

}
?>
