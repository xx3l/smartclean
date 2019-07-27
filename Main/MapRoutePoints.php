<?php
class MapRoutePointClass {

  protected $config;

  public function __construct($config) {
    $this->config = $config;
    $this->db = new Db($config['db']);
  }

  function prepare($transport_id, $street_id, $lat, $lon) {
    return $this->db->insert(
      'route_point_preparing', [
        'transport_id' => $transport_id,
        'street_id' => $street_id,
        'lat' => $lat,
        'lon' => $lon,
      ]
    );
  }

  function get($id) {
    return $this->db->get('route_point', $id);
  }

  function delete($id) {
    return $this->db->delete('route_point', $id);
  }

}
?>
