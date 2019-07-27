<?php
// это файл с основным классом

class SmartClean {
  public $config = [];

  function __construct() {
    include 'config.php';
    $this->config = $config;
    $this->db_session = mysqli_connect($this->config['db']['host'], $this->config['db']['user'], $this->config['db']['password']);
    print 'Class loaded';
  }
}


?>
