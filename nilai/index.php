<?php

include "../config/koneksi.php";
include "../templates/header.php";
include "../templates/sidebar.php";

$alternatif=mysqli_query($conn,"SELECT * FROM alternatif");

$kriteria=mysqli_query($conn,"SELECT * FROM kriteria");

?>

<div class="container-fluid">

<h2 class="mb-4">

Input Nilai

</h2>

<form method="POST">

<table class="table table-bordered table-hover">

<thead class="table-primary">

<tr>

<th>Alternatif</th>

<?php

while($k=mysqli_fetch_assoc($kriteria)){

?>

<th><?= $k['nama_kriteria']?></th>

<?php } ?>

</tr>

</thead>

<tbody>

<?php

mysqli_data_seek($kriteria,0);

while($a=mysqli_fetch_assoc($alternatif)){

?>

<tr>

<td>

<?= $a['nama'];?>

</td>

<?php

while($k=mysqli_fetch_assoc($kriteria)){

?>

<td>

<?php

$cek = mysqli_query($conn,

"SELECT nilai
FROM nilai
WHERE id_alternatif='".$a['id_alternatif']."'
AND id_kriteria='".$k['id_kriteria']."'

");

$dataNilai = mysqli_fetch_assoc($cek);

?>

<input

type="number"

step="0.01"

class="form-control"

name="nilai[<?= $a['id_alternatif']?>][<?= $k['id_kriteria']?>]"

value="<?= $dataNilai['nilai'] ?? '' ?>"

required

>

</td>

<?php

}

mysqli_data_seek($kriteria,0);

?>

</tr>

<?php } ?>

</tbody>

</table>

<button

class="btn btn-success"

name="simpan">

Simpan Nilai

</button>

</form>

<?php

if(isset($_POST['simpan'])){

foreach($_POST['nilai'] as $idAlternatif=>$nilai){

foreach($nilai as $idKriteria=>$n){

mysqli_query($conn,


"INSERT INTO nilai
(id_alternatif,id_kriteria,nilai)

VALUES
('$idAlternatif','$idKriteria','$n')

ON DUPLICATE KEY UPDATE

nilai=VALUES(nilai)

");


}

}

echo"

<script>

alert('Nilai berhasil disimpan');

location='index.php';

</script>";

}

include "../templates/footer.php";

?>