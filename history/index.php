<?php
include "../config/koneksi.php";
include "../templates/header.php";
include "../templates/sidebar.php";
?>

<div class="container-fluid">

<h2 class="mb-4">History Perhitungan SMART</h2>

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Alternatif</th>
    <th>Nilai SMART</th>
    <th>Ranking</th>
</tr>

</thead>

<tbody>

<?php

$no=1;

$data=mysqli_query($conn,"
SELECT *
FROM history
ORDER BY tanggal DESC, ranking ASC
");

while($d=mysqli_fetch_assoc($data)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['tanggal']; ?></td>

<td><?= $d['nama_alternatif']; ?></td>

<td><?= round($d['nilai_smart'],3); ?></td>

<td><?= $d['ranking']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<?php
include "../templates/footer.php";
?>