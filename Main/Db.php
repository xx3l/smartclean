<?php
class Db {
  public $db;
  public $data = [];
  public $debug = true;
  public function __construct($config) {
    $this->debug = $config['debug'] ?? $this->debug;
    $this->db = new mysqli($config['host'], $config['user'], $config['password'],  $config['name']);
  }
  public function rawSql($sql) {
    if ($this->debug) print $sql;
    $result = $this->db->query($sql);
    while ($row = $result->fetch_assoc()) {
      array_push($this->data, $row);
    }
    return $this->data;
  }

  public function insert($table, $data = []) {
    $sql = "insert into ".$table." (".implode(",", array_keys($data)).") values('".implode("','", $data)."')";
    if ($this->debug) print $sql;
    $this->db->query($sql);
    return $this->db->insert_id;
  }

  public function delete($table, $id) {
    $sql = 'delete from '.$table.' where '.$table.'_id = '.$id;
    if ($this->debug) print $sql;
    return $this->db->query($sql);
  }

  public function get($table, $id) {
    $sql = 'select * from '.$table.' where '.$table.'_id = '.$id;
    $result = $this->db->query($sql);
    return $result->fetch_assoc();
  }

}
?>
