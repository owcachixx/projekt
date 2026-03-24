<?php
require_once __DIR__."/../models/druzyna_model.php";
require_once __DIR__."/../models/mecz_model.php";

function liczba_druzyn() {
    $query=pobierz_udzial_cout_druzyny();
    $row=mysqli_fetch_array($query);
    return $row['liczba_druzyn'];
}
?>
