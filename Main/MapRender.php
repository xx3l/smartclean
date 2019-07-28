<?php
class MapRender {

  public $config;

  public function __construct($config) {
    $this->config = $config;
    $this->db = new Db($config['db']);
  }

  public function draw() {
    $this->x_res = $this->config['render']['resolution'][0];
    $this->y_res = $this->config['render']['resolution'][1];
    $im = imagecreatetruecolor($this->x_res, $this->y_res);
    $c_transparent = imagecolorallocatealpha($im, 255, 255, 255, 127);
    imagecolortransparent($im, $c_transparent);
    imagefill($im, 0, 0, $c_transparent);

    $c_points = imagecolorallocatealpha($im, 255, 128, 100, 5);
    $c_lines = imagecolorallocatealpha($im, 1, 100, 250, 5);
    imagesetthickness($im, 5);


    imagefilledrectangle($im, 0, 0, $this->x_res, $this->y_res, $c_transparent);
    $this->db->debug = false;
    $limits = $this->db->rawSql('select min(lat) minLat,max(lat) maxLat, min(lon) minLon, max(lon) maxLon from point');
    $minLat = ($this->config['render']['box']['lat1'] == 0) ? $limits[0]['minLat'] : $this->config['render']['box']['lat1'];
    $maxLat = ($this->config['render']['box']['lat2'] == 0) ? $limits[0]['maxLat'] : $this->config['render']['box']['lat2'];
    $minLon = ($this->config['render']['box']['lon1'] == 0) ? $limits[0]['minLon'] : $this->config['render']['box']['lon1'];
    $maxLon = ($this->config['render']['box']['lon2'] == 0) ? $limits[0]['maxLon'] : $this->config['render']['box']['lon2'];

    $points = $this->db->rawSql('select lat, lon, point_id from point');
    $x_scale = $this->x_res / ($maxLon - $minLon);
    $y_scale = $this->y_res / ($maxLat - $minLat);
    // print_r($points);
    $pnt = [];
    foreach ($points as $point) {
      $pnt[$point['point_id']] = [$point['lat'], $point['lon']];
    }
    $streets = $this->db->rawSql('select p1, p2 from street');
    foreach ($streets as $street) {
      $x1 = $x_scale * ($pnt[$street['p1']][1] - $minLon);
      $y1 = $this->y_res - $y_scale * ($pnt[$street['p1']][0] - $minLat);
      $x2 = $x_scale * ($pnt[$street['p2']][1] - $minLon);
      $y2 = $this->y_res - $y_scale * ($pnt[$street['p2']][0] - $minLat);
      imageline($im, $x1, $y1, $x2, $y2, $c_lines);
    }
    if (($this->config['render']['showPoints'] ?? false) == true) {
      foreach ($points as $point) {
        $x = $x_scale * ($point['lon'] - $minLon);
        $y = $this->y_res - $y_scale * ($point['lat'] - $minLat);
        // print floor($x)."-".floor($y)."=";
        imagefilledrectangle($im, $x-5, $y-5, $x+5, $y+5, $c_points);
      }
    }

    header('Content-type: image/png');
    imagepng($im);
    die();
  }
}
