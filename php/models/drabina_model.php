<?php
require_once "../php/includes/database.php";

function get_mecz($runda) {
    global $con;
    $sql="SELECT 
    mecz.id, 
    d1.nazwa AS druzyna_1, 
    d2.nazwa AS druzyna_2, 
    mecz.wynik_druzyna_1 AS wynik_1, 
    mecz.wynik_druzyna_2 AS wynik_2, 
    runda
    FROM mecz 
    INNER JOIN druzyna d1 ON mecz.druzyna_1 = d1.id 
    INNER JOIN druzyna d2 ON mecz.druzyna_2 = d2.id 
    WHERE runda = $runda AND turniej_id =".$_SESSION['turniej_id'];
    $query=mysqli_query($con, $sql);
    return $query;
}

function get_mecz_BYE() {
    global $con;
    $sql="SELECT 
    mecz.id, 
    d1.nazwa AS druzyna_1, 
    'BYE' AS druzyna_2, 
    '-' AS wynik_1, 
    '-' AS wynik_2, 
    runda
    FROM mecz 
    INNER JOIN druzyna d1 ON mecz.druzyna_1 = d1.id 
    INNER JOIN druzyna d2 ON mecz.druzyna_2 = d2.id 
    WHERE druzyna_2 IS NULL AND runda = 1 AND turniej_id =".$_SESSION['turniej_id'];
    $query=mysqli_query($con, $sql);
    return $query;
}

function get_mecz_by_runda($runda) {
    global $con;
    $sql='SELECT id, wynik_druzyna_1 AS wynik_1, wynik_druzyna_2 AS wynik_1 FROM mecz WHERE runda = $runda AND id = '.$_SESSION['turniej_id'];
    $query=mysqli_query($con, $sql);
    return $query;
}
?>
