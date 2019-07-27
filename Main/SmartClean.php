<?php
// это файл с основным классом

class SmartClean {
  public $config = [];

  public function __construct() {
    include 'config.php';
    $this->config = $config;
    $this->db_session = mysqli_connect($this->config['db']['host'], $this->config['db']['user'], $this->config['db']['password']);
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
