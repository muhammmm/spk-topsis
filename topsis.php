<?php
class topsis {
  public $alternatif = array();
  public $kriteria = array();
  // public $pembagi = array();

  public function __construct() {
    // data kriteria
    array_push($this->kriteria, array('Lokasi', 5, 'Benefit'));
    array_push($this->kriteria, array('Luas Tanah', 4, 'Benefit'));
    array_push($this->kriteria, array('Harga', 4, 'Cost'));
    array_push($this->kriteria, array('Ukuran', 3, 'Benefit'));
    array_push($this->kriteria, array('Resiko', 4, 'Cost'));
    
    // data alternatif
    array_push($this->alternatif, array('Jalan A', 4, 2000, 5000, 3, 1));
    array_push($this->alternatif, array('Jalan B', 2, 5000, 2000, 4, 4));
    array_push($this->alternatif, array('Jalan C', 3, 4000, 3000, 4, 3));

    $this->pembagi();
    $this->normalisasi();
    $this->bobot();
    $this->normalBobot();
    $this->cmax();
    $this->cmin();
    $this->atribut();
    $this->ymaxMin();
    $this->dplusmin();
  }

  public function pembagi() {
    $this->pembagi = array(0, 0, 0, 0, 0);
    foreach($this->alternatif as $a) {
      for($i=0; $i<count($this->kriteria); $i++) {
        $this->pembagi[$i] += pow($a[$i+1],2);
      }
    }
    for($i=0; $i<count($this->pembagi); $i++) {
      $this->pembagi[$i] = round(sqrt($this->pembagi[$i]),3);
    }
  }

  public function normalisasi() {
    $this->normalisasi = array();
    foreach($this->alternatif as $a) {
      for($i=0; $i<count($this->pembagi); $i++) {
        $a[$i+1] = round($a[$i+1]/$this->pembagi[$i], 3);
      }
      array_push($this->normalisasi, $a);
    }
  }

  public function bobot() {
    $this->bobot = array();
    foreach ($this->kriteria as $k) {
      array_push($this->bobot, $k[1]);
    }
  }

  public function normalBobot() {
    $this->normalBobot = array();
    foreach ($this->normalisasi as $n) {
      for($i=0; $i<count($this->bobot); $i++) {
        $n[$i + 1] = $n[$i + 1] * $this->bobot[$i];
      }
      array_push($this->normalBobot, $n);
    }
  }

  public function cmin() {
    $this->cmin = array(10, 10, 10, 10, 10);
    foreach ($this->normalBobot as $n) {
      if ($this->cmin[0] > $n[1]) $this->cmin[0] = $n[1];
      if ($this->cmin[1] > $n[2]) $this->cmin[1] = $n[2];
      if ($this->cmin[2] > $n[3]) $this->cmin[2] = $n[3];
      if ($this->cmin[3] > $n[4]) $this->cmin[3] = $n[4];
      if ($this->cmin[4] > $n[5]) $this->cmin[4] = $n[5];
    }
  }
  public function cmax() {
    $this->cmax = array(0,0,0,0,0);
    foreach ($this->normalBobot as $n) {
      if ($this->cmax[0] < $n[1]) $this->cmax[0] = $n[1];
      if ($this->cmax[1] < $n[2]) $this->cmax[1] = $n[2];
      if ($this->cmax[2] < $n[3]) $this->cmax[2] = $n[3];
      if ($this->cmax[3] < $n[4]) $this->cmax[3] = $n[4];
      if ($this->cmax[4] < $n[5]) $this->cmax[4] = $n[5];
    }
  }

  public function atribut() {
    $this->atribut = array();
    foreach ($this->kriteria as $k) {
      array_push($this->atribut, $k[2]);
    }
  }

  public function ymaxMin() {
    $this->ymax = array();
    $this->ymin = array();
    for ($i=0; $i < count($this->atribut); $i++) { 
      if ($this->atribut[$i]=='Benefit') {
        array_push($this->ymax, $this->cmax[$i]);
        array_push($this->ymin, $this->cmin[$i]);
      } else if ($this->atribut[$i]=='Cost') {
        array_push($this->ymax, $this->cmin[$i]);
        array_push($this->ymin, $this->cmax[$i]);
      }
    }
  }

  public function dplusmin() {
    $this->dplusmin = array();
    foreach($this->normalBobot as $n) {
      $this->dplus = 0;
      $this->dmin = 0;
      for ($i=0; $i < count($this->ymax); $i++) {
        $this->dplus += pow($this->ymax[$i] - $n[$i + 1], 2);
        $this->dmin += pow($n[$i + 1] - $this->ymin[$i], 2);
      }
      $n[6] = round(sqrt($this->dplus), 3);
      $n[7] = round(sqrt($this->dmin), 3);
      array_push($this->dplusmin, $n);
    }
  }
}
?>