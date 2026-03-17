<?php
require_once __DIR__."/../models/sedzia_model.php";
$sedziowie=[];
$query=pobierz_sedziow();
while($row = mysqli_fetch_assoc($query)) {
    $sedziowie[] = $row;
}
?>