<?php

include "../config/koneksi.php";

include "../templates/header.php";

include "../templates/sidebar.php";

$totalAlternatif=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM alternatif"));

$totalKriteria=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM kriteria"));

$totalHistory=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM history"));

?>

<h2 class="mb-4">

Dashboard

</h2>

<div class="row">

<div class="col-md-4">

<div class="card p-4">

<h5>Total Alternatif</h5>

<h2><?= $totalAlternatif ?></h2>

</div>

</div>

<div class="col-md-4">

<div class="card p-4">

<h5>Total Kriteria</h5>

<h2><?= $totalKriteria ?></h2>

</div>

</div>

<div class="col-md-4">

<div class="card p-4">

<h5>Total History</h5>

<h2><?= $totalHistory ?></h2>

</div>

</div>

</div>

<?php

include "../templates/footer.php";

?>