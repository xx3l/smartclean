<?php
class MapRender {

  public $config;

  public function __construct($config) {
    $this->config = $config;
    $this->db = new Db($config['db']);
  }

  public function draw($drawImage = 1) {
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
    $limits = $this->db->rawSql('select min(lat) minLat,max(lat) maxLat, min(lon) minLon, max(lon) maxLon from point where map_id='.$this->config['model']['id']);
    $minLat = ($this->config['render']['box']['lat1'] == 0) ? $limits[0]['minLat'] : $this->config['render']['box']['lat1'];
    $maxLat = ($this->config['render']['box']['lat2'] == 0) ? $limits[0]['maxLat'] : $this->config['render']['box']['lat2'];
    $minLon = ($this->config['render']['box']['lon1'] == 0) ? $limits[0]['minLon'] : $this->config['render']['box']['lon1'];
    $maxLon = ($this->config['render']['box']['lon2'] == 0) ? $limits[0]['maxLon'] : $this->config['render']['box']['lon2'];

    $points = $this->db->rawSql('select lat, lon, point_id from point where map_id='.$this->config['model']['id']);
    $x_scale = $this->x_res / ($maxLon - $minLon);
    $y_scale = $this->y_res / ($maxLat - $minLat);
    // print_r($points);
    $pnt = [];
    foreach ($points as $point) {
      $pnt[$point['point_id']] = [$point['lat'], $point['lon']];
    }
    $streets = $this->db->rawSql('select p1, p2 from street where map_id='.$this->config['model']['id']);
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
    if (@$_GET['tr'] != '') {
      $imt = imagecreatefromjpeg('pix/tr.jpg');
      $units = $this->db->rawSql('select * from transport t left join ref_transport r on r.ref_transport_id=t.ref_transport_id');
      foreach ($units as $unit) {
        $x = $x_scale * ($unit['current_lon'] - $minLon);
        $y = $this->y_res - $y_scale * ($unit['current_lat'] - $minLat);
        // imagecopyresampled($im, $imt, $x, $y, 0, 0, 25, 20, 132, 78);
        imagecopyresampled($im, $imt, $x, $y, 0, 0, 25, 20, 275, 184);
      }

    }
    if ($drawImage == 1) {
      header('Content-type: image/png');
      imagepng($im);
      die();
    } else {
      imagepng($im, $drawImage);
    }
  }
}
