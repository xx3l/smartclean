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


  function selectAllWithNearestPoint() {
  $sql = <<<SQL
SELECT transport_id, current_lat, current_lon, point_id, map_id, lat, lon
FROM `transport` t, `point` p
WHERE t.active = 1
ORDER BY
	atan2(sqrt(
    	pow(sin(p.lon-t.current_lon)*3.1415/180, 2) 
    	+cos(t.current_lat*3.1415/180) * sin(t.current_lat*3.1415/180)
    	+pow(sin(p.lon-t.current_lon)*3.1415/180, 2) 
    ), sqrt(1-
    	pow(sin(p.lon-t.current_lon)*3.1415/180, 2) 
    	+cos(t.current_lat*3.1415/180) * sin(t.current_lat*3.1415/180)
    	+pow(sin(p.lon-t.current_lon)*3.1415/180, 2) 
    ))
SQL;
    return $this->db->rawSql($sql);
  }
  
}
?>
