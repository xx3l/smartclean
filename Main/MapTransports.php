<?php
class MapTransportClass {

  protected $config;

  public function __construct($config) {
    $this->config = $config;
    $this->db = new Db($config['db']);
  }

  function selectAll() {
    return $this->db->select(
      'transport', [
        'active' => 1,
      ]
    );
  }
}
?>
