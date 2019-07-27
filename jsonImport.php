<?php
class ImportJSON {

  protected $config;

  public function __construct($config) {
    $this->config = $config;
    $this->db = new Db($config['db']);

  }

  function loadfile($fname) {
	  $obj = json_decode(file_get_contents($fname),true);
	  print_r($obj);
  }
/*
  function add($p1, $p2, $width = 3.5, $len = 0, $priority = 1, $active = 1) {
    return $this->db->insert(
      'street', [
        'p1' => $p1,
        'p2' => $p2,
        'width' => $width,
        'len' => $len,
        'priority' => $priority,
        'active' => $active,
      ]
    );
  }
*/
}
?>
