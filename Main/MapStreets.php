<?php
class MapStreetClass {

  protected $config;

  public function __construct($config) {
    $this->config = $config;
    $this->db = new Db($config['db']);
  }

  function add($p1, $p2, $one_way = 0, $path_id = 0, $width = 3.5, $len = 0, $priority = 1, $active = 1) {
    return $this->db->insert(
      'street', [
        'p1' => $p1,
        'p2' => $p2,
        'path_id' => $path_id,
        'one_way' => $one_way,
        'width' => $width,
        'len' => $len,
        'priority' => $priority,
        'active' => $active,
      ]
    );
  }

  function get($id) {
    return $this->db->get('point', $id);
  }

  function selectAll() {
    return $this->db->select(
      'street', [
        'active' => 1,
      ]
    );
  }

  function delete($id) {
    return $this->db->delete('street', $id);
  }

}
?>
