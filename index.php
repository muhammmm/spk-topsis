<?php
require_once 'topsis.php';
$topsis = new topsis();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Topsis</title>
  </head>
  <body>
    <div class="container">
      <h1>Technique for Order Preference by Similarity to Ideal Solution (TOPSIS)</h1>
      <hr>
      <h2>kriteria, Bobot dan Atribut</h2>
      <table class="table">
        <thead>
          <tr>
            <th>No.</th>
            <th>kode</th>
            <th>kriteria</th>
            <th>Bobot</th>
            <th>Atribut</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 1;
            foreach($topsis->kriteria as $k) {
          ?>
          <tr>
            <td><?=$no?></td>
            <td>C<?=$no?></td>
            <td><?=$k[0]?></td>
            <td><?=$k[1]?></td>
            <td><?=$k[2]?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <h2>Alternatif</h2>
      <table class="table">
        <thead>
          <tr>
            <th>No.</th>
            <th>kode</th>
            <th>C1</th>
            <th>C2</th>
            <th>C3</th>
            <th>C4</th>
            <th>C5</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 1;
            foreach($topsis->alternatif as $a) {
          ?>
          <tr>
            <td><?=$no?></td>
            <td><?=$a[0]?></td>
            <td><?=$a[1]?></td>
            <td><?=$a[2]?></td>
            <td><?=$a[3]?></td>
            <td><?=$a[4]?></td>
            <td><?=$a[5]?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <h2>Menghitung Matriks Keputusan Ternomalisasi</h2>
      <table class="table">
        <thead>
          <tr>
            <th>Kriteria</th>
            <th>C1</th>
            <th>C2</th>
            <th>C3</th>
            <th>C4</th>
            <th>C5</th>
          </tr>
        </thead>
        <tbody>
          <td>Pembagi</td>
          <td><?=$topsis->pembagi[0]?></td>
          <td><?=$topsis->pembagi[1]?></td>
          <td><?=$topsis->pembagi[2]?></td>
          <td><?=$topsis->pembagi[3]?></td>
          <td><?=$topsis->pembagi[4]?></td>
        </tbody>
      </table>
      <table class="table">
        <thead>
          <tr>
            <th>No.</th>
            <th>kode</th>
            <th>C1</th>
            <th>C2</th>
            <th>C3</th>
            <th>C4</th>
            <th>C5</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 1;
            $total = 0;
            foreach($topsis->normalisasi as $n) {
          ?>
          <tr>
            <td><?=$no?></td>
            <td><?=$n[0]?></td>
            <td><?=$n[1]?></td>
            <td><?=$n[2]?></td>
            <td><?=$n[3]?></td>
            <td><?=$n[4]?></td>
            <td><?=$n[5]?></td>
          </tr>
          <?php } ?>
          <tr>
            <th colspan="2">Bobot</th>
            <td><?=$topsis->bobot[0]?></td>
            <td><?=$topsis->bobot[1]?></td>
            <td><?=$topsis->bobot[2]?></td>
            <td><?=$topsis->bobot[3]?></td>
            <td><?=$topsis->bobot[4]?></td>
          </tr>
        </tbody>
      </table>
      <h2>Menghitun Matriks Keputusan Ternomalisasi dan Terbobot</h2>
      <table class="table">
        <thead>
          <tr>
            <th>No.</th>
            <th>kode</th>
            <th>C1</th>
            <th>C2</th>
            <th>C3</th>
            <th>C4</th>
            <th>C5</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 1;
            foreach($topsis->normalBobot as $n) {
          ?>
          <tr>
            <td><?=$no?></td>
            <td><?=$n[0]?></td>
            <td><?=$n[1]?></td>
            <td><?=$n[2]?></td>
            <td><?=$n[3]?></td>
            <td><?=$n[4]?></td>
            <td><?=$n[5]?></td>
          </tr>
          <?php } ?>
          <tr>
            <th></th>
            <th>Atribut</th>
            <td><?=$topsis->atribut[0]?></td>
            <td><?=$topsis->atribut[1]?></td>
            <td><?=$topsis->atribut[2]?></td>
            <td><?=$topsis->atribut[3]?></td>
            <td><?=$topsis->atribut[4]?></td>
          </tr>
        </tbody>
      </table>
      <h2>Mencari Solusi Ideal Positif (Maks) dan Solusi Ideal Negatif (Min)</h2>
      <table class="table">
        <tbody>
          <tr>
            <th>Max(y+)</th>
            <td><?=$topsis->ymax[0]?></td>
            <td><?=$topsis->ymax[1]?></td>
            <td><?=$topsis->ymax[2]?></td>
            <td><?=$topsis->ymax[3]?></td>
            <td><?=$topsis->ymax[4]?></td>
          </tr>
          <tr>
            <th>Min(y-)</th>
            <td><?=$topsis->ymin[0]?></td>
            <td><?=$topsis->ymin[1]?></td>
            <td><?=$topsis->ymin[2]?></td>
            <td><?=$topsis->ymin[3]?></td>
            <td><?=$topsis->ymin[4]?></td>
          </tr>
        </tbody>
      </table>
      <h2>Mencari D+ dan D- Untuk Setiap Alternatif</h2>
      <table class="table">
        <thead>
          <tr>
            <th>No.</th>
            <th>Alternatif</th>
            <th>D+</th>
            <th>D-</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 1;
            foreach($topsis->dplusmin as $dpm) {
          ?>
          <tr>
            <td><?=$no?></td>
            <td><?=$dpm[0]?></td>
            <td><?=$dpm[6]?></td>
            <td><?=$dpm[7]?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <h2>Mencari Hasil Preferensi</h2>
      <table class="table">
        <thead>
          <tr>
            <th>No.</th>
            <th>Alternatif</th>
            <th>Preferensi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 1;
            foreach($topsis->dplusmin as $dpm) {
            $preferensi = round($dpm[7] / ($dpm[7] + $dpm[6]), 2);
          ?>
          <tr>
            <td><?=$no?></td>
            <td><?=$dpm[0]?></td>
            <td><?=$preferensi?></td>
          </tr>
          <?php } ?>
        </tbody>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
