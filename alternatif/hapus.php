<?php

include "../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($conn,
"DELETE FROM alternatif
WHERE id_alternatif='$id'");

echo "

<script>

alert('Data berhasil dihapus');

location='index.php';

</script>

";