<?php
$halaman = basename($_SERVER['PHP_SELF']);
$folder = basename(dirname($_SERVER['PHP_SELF']));
?>

<div class="sidebar">

    <div class="logo">

        <h3>SPK SMART</h3>

    </div>

    <ul>

        <li>
            <a href="../dashboard/index.php"
            class="nav-link <?= ($folder=='dashboard') ? 'active' : '' ?>">
                <i class="bi bi-house-door"></i>
             Dashboard
            </a>
        </li>

        <li>
            <a href="../alternatif/index.php"
class="nav-link <?= ($folder=='alternatif') ? 'active' : '' ?>">
    <i class="bi bi-people"></i>
    Alternatif
</a>
        </li>

        <li>
            <a href="../kriteria/index.php"
class="nav-link <?= ($folder=='kriteria') ? 'active' : '' ?>">
    <i class="bi bi-list-check"></i>
    Kriteria
</a>
        </li>

        <li>
            <a href="../nilai/index.php"
class="nav-link <?= ($folder=='nilai') ? 'active' : '' ?>">
    <i class="bi bi-pencil-square"></i>
    Nilai
</a>
        </li>

        <li>
            <a href="../smart/index.php"
class="nav-link <?= ($folder=='smart') ? 'active' : '' ?>">
    <i class="bi bi-calculator"></i>
    SMART
</a>
        </li>

        <li>
            <a href="../history/index.php"
class="nav-link <?= ($folder=='history') ? 'active' : '' ?>">
    <i class="bi bi-clock-history"></i>
    History
</a>
        </li>

    </ul>

</div>

<div class="content">