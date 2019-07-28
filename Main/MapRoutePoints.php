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

  function deleteAllPreparing() {
    return $this->db->deleteAll('route_point_preparing');
  }

  function pushPreparedToRealData() {
    $this->db->deleteAll('route_point');
    $this->db->rawSql('INSERT INTO `route_point_preparing`(`transport_id`, `street_id`, `lat`, `lon`, `planned_time`)"
					." SELECT `transport_id`, `street_id`, `lat`, `lon`, `planned_time` FROM `route_point_preparing`;');
    $this->db->deleteAll('route_point_preparing');
  }
  function SelectAll($transport_id) {
    return $this->db->select(
      'route_point', [
        'transport_id' => $transport_id,
      ]
    );
  }

}
?>
