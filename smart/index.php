<?php
include "../config/koneksi.php";
include "../templates/header.php";
include "../templates/sidebar.php";
?>

<div class="container-fluid">

<h2 class="mb-4">Perhitungan SMART</h2>

<!-- ======================= -->
<!-- TABEL DATA NILAI -->
<!-- ======================= -->

<div class="card mb-4">
<div class="card-header bg-primary text-white">
Data Nilai Alternatif
</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-primary">

<tr>

<th>Alternatif</th>

<?php

$kriteria = mysqli_query($conn,"SELECT * FROM kriteria ORDER BY id_kriteria");

while($k=mysqli_fetch_assoc($kriteria)){

?>

<th><?= $k['nama_kriteria']; ?></th>

<?php } ?>

</tr>

</thead>

<tbody>

<?php

$alternatif=mysqli_query($conn,"SELECT * FROM alternatif");

while($a=mysqli_fetch_assoc($alternatif)){

?>

<tr>

<td><?= $a['nama']; ?></td>

<?php

$kriteria=mysqli_query($conn,"SELECT * FROM kriteria ORDER BY id_kriteria");

while($k=mysqli_fetch_assoc($kriteria)){

$nilai=mysqli_query($conn,

"SELECT nilai
FROM nilai
WHERE id_alternatif='$a[id_alternatif]'
AND id_kriteria='$k[id_kriteria]'");

$n=mysqli_fetch_assoc($nilai);

?>

<td>
<?= $n['nilai'] ?? 0; ?>
</td>

<?php } ?>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

<!-- ======================= -->
<!-- NORMALISASI BOBOT -->
<!-- ======================= -->

<div class="card mb-4">

<div class="card-header bg-success text-white">

Normalisasi Bobot

</div>

<div class="card-body">

<?php

$totalBobot=0;

$data=mysqli_query($conn,"SELECT * FROM kriteria");

while($d=mysqli_fetch_assoc($data)){

$totalBobot += $d['bobot'];

}

?>

<table class="table table-bordered">

<thead class="table-success">

<tr>

<th>Kriteria</th>

<th>Bobot Awal</th>

<th>Bobot Normalisasi</th>

</tr>

</thead>

<tbody>

<?php

$data=mysqli_query($conn,"SELECT * FROM kriteria");

while($d=mysqli_fetch_assoc($data)){

$normalisasi=$d['bobot']/$totalBobot;

?>

<tr>

<td><?= $d['nama_kriteria']; ?></td>

<td><?= $d['bobot']; ?></td>

<td><?= round($normalisasi,3); ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

<div class="card mb-4">

<div class="card-header bg-warning">

Normalisasi Utility

</div>

<div class="card-body">

<?php

$kriteria=mysqli_query($conn,"SELECT * FROM kriteria ORDER BY id_kriteria");

while($k=mysqli_fetch_assoc($kriteria)){

echo "<h5>".$k['nama_kriteria']."</h5>";

$max = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT MAX(nilai) AS maxnilai
FROM nilai
WHERE id_kriteria='".$k['id_kriteria']."'"
));

$min = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT MIN(nilai) AS minnilai
FROM nilai
WHERE id_kriteria='".$k['id_kriteria']."'"
));

?>

<table class="table table-bordered">

<tr class="table-warning">

<th>Alternatif</th>

<th>Nilai</th>

<th>Utility</th>

</tr>

<?php

$alternatif = mysqli_query($conn,"SELECT * FROM alternatif");

while($a=mysqli_fetch_assoc($alternatif)){

$n = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT nilai
FROM nilai
WHERE id_alternatif='".$a['id_alternatif']."'
AND id_kriteria='".$k['id_kriteria']."'"
));

if($max['maxnilai']==$min['minnilai']){

$utility=1;

}else{


$nilaiAlternatif = $n['nilai'] ?? 0;

if($k['tipe']=="benefit"){

    $utility =
    ($nilaiAlternatif-$min['minnilai'])
    /
    ($max['maxnilai']-$min['minnilai']);

}else{

    $utility =
    ($max['maxnilai']-$nilaiAlternatif)
    /
    ($max['maxnilai']-$min['minnilai']);

}

}

?>

<tr>

<td><?= $a['nama']; ?></td>

<td><?= $n['nilai'] ?? '-'; ?></td>

<td><?= round($utility,3); ?></td>

</tr>

<?php } ?>

</table>

<?php } ?>

</div>

</div>

<!-- ======================= -->
<!-- PERHITUNGAN SMART -->
<!-- ======================= -->

<div class="card mb-4">

<div class="card-header bg-info text-white">

Perhitungan SMART

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-info">

<tr>

<th>Alternatif</th>

<?php

$kriteria=mysqli_query($conn,"SELECT * FROM kriteria ORDER BY id_kriteria");

while($k=mysqli_fetch_assoc($kriteria)){

?>

<th><?= $k['nama_kriteria']; ?></th>

<?php } ?>

<th>Total SMART</th>

</tr>

</thead>

<tbody>

<?php

$totalBobot=0;

$q=mysqli_query($conn,"SELECT * FROM kriteria");

while($b=mysqli_fetch_assoc($q)){

$totalBobot += $b['bobot'];

}

$alternatif=mysqli_query($conn,"SELECT * FROM alternatif");

while($a=mysqli_fetch_assoc($alternatif)){

$total=0;

?>

<tr>

<td><?= $a['nama']; ?></td>

<?php

$kriteria=mysqli_query($conn,"SELECT * FROM kriteria ORDER BY id_kriteria");

while($k=mysqli_fetch_assoc($kriteria)){

$nilai=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT nilai
FROM nilai
WHERE id_alternatif='".$a['id_alternatif']."'
AND id_kriteria='".$k['id_kriteria']."'
"));

$max=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT MAX(nilai) AS maxnilai
FROM nilai
WHERE id_kriteria='".$k['id_kriteria']."'
"));

$min=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT MIN(nilai) AS minnilai
FROM nilai
WHERE id_kriteria='".$k['id_kriteria']."'
"));

if($max['maxnilai']==$min['minnilai']){

    $utility = 1;

}else{

    $nilaiAlternatif = $nilai['nilai'] ?? 0;

    if($k['tipe']=="benefit"){

        $utility =
        ($nilaiAlternatif-$min['minnilai'])/
        ($max['maxnilai']-$min['minnilai']);

    }else{

        $utility =
        ($max['maxnilai']-$nilaiAlternatif)/
        ($max['maxnilai']-$min['minnilai']);

    }

}

$bobot=$k['bobot']/$totalBobot;

$hasil=$utility*$bobot;

$total += $hasil;

?>

<td>

<?= round($hasil,3); ?>

</td>

<?php } ?>

<td>

<strong><?= round($total,3); ?></strong>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

<!-- ======================= -->
<!-- RANKING SMART -->
<!-- ======================= -->

<div class="card mb-4">

<div class="card-header bg-danger text-white">

Ranking SMART

</div>

<div class="card-body">

<?php

$dataRanking=[];

$totalBobot=0;

$q=mysqli_query($conn,"SELECT * FROM kriteria");

while($b=mysqli_fetch_assoc($q)){

$totalBobot += $b['bobot'];

}

$alternatif=mysqli_query($conn,"SELECT * FROM alternatif");

while($a=mysqli_fetch_assoc($alternatif)){

$total=0;

$kriteria=mysqli_query($conn,"SELECT * FROM kriteria");

while($k=mysqli_fetch_assoc($kriteria)){

$nilai=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT nilai
FROM nilai
WHERE id_alternatif='".$a['id_alternatif']."'
AND id_kriteria='".$k['id_kriteria']."'
"));

$max=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT MAX(nilai) AS maxnilai
FROM nilai
WHERE id_kriteria='".$k['id_kriteria']."'
"));

$min=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT MIN(nilai) AS minnilai
FROM nilai
WHERE id_kriteria='".$k['id_kriteria']."'
"));

if($max['maxnilai']==$min['minnilai']){

    $utility = 1;

}else{

    $nilaiAlternatif = $nilai['nilai'] ?? 0;

    if($k['tipe']=="benefit"){

        $utility =
        ($nilaiAlternatif-$min['minnilai'])/
        ($max['maxnilai']-$min['minnilai']);

    }else{

        $utility =
        ($max['maxnilai']-$nilaiAlternatif)/
        ($max['maxnilai']-$min['minnilai']);

    }

}

$bobot=$k['bobot']/$totalBobot;

$total += ($utility*$bobot);

}

$dataRanking[]=[

'nama'=>$a['nama'],

'nilai'=>$total

];

}

usort($dataRanking,function($a,$b){

return $b['nilai'] <=> $a['nilai'];

});

// Hapus history sebelumnya
mysqli_query($conn,"DELETE FROM history");

// Simpan hasil ranking terbaru
$rank=1;

foreach($dataRanking as $d){

mysqli_query($conn,"
INSERT INTO history
(ranking,nama_alternatif,nilai_smart)
VALUES
(
'$rank',
'".$d['nama']."',
'".$d['nilai']."'
)
");

$rank++;

}

?>

<table class="table table-bordered">

<thead class="table-danger">

<tr>

<th>Ranking</th>

<th>Alternatif</th>

<th>Nilai SMART</th>

</tr>

</thead>

<tbody>

<?php

$rank=1;

foreach($dataRanking as $d){

?>

<tr>

<td><?= $rank++; ?></td>

<td><?= $d['nama']; ?></td>

<td><?= round($d['nilai'],3); ?></td>

</tr>

<?php } ?>

</tbody>

</table>

<form method="POST">

<button
type="submit"
name="simpan_history"
class="btn btn-success">

Simpan History

</button>

</form>

</div>

</div>

</div>

<?php
include "../templates/footer.php";
?>