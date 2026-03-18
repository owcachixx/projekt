<?php
require_once "../php/includes/database.php";

function pobierz_druzyna() {
    global $con;
    $sql="SELECT * FROM druzyna";
    $query=mysqli_query($con, $sql);
    return $query;
}

function pobierz_druzyny_turniej() {
    global $con;
    if (!isset($_SESSION['turniej_id'])) {
        error_log("Brak turniej_id w sesji!");
        return false;
    }
    $turniej_id = intval($_SESSION['turniej_id']);
    $sql = "SELECT druzyna.* FROM druzyna JOIN udzial ON druzyna.id = udzial.id_druzyna WHERE udzial.id_turniej = $turniej_id";
    $query = mysqli_query($con, $sql);
    if (!$query) {
        error_log("Błąd SQL: " . mysqli_error($con));
    }
    return $query;
}

function pobierz_id_nazwa_druzyny() {
    global $con;
    $sql="SELECT id, nazwa FROM druzyna";
    $query=mysqli_query($con, $sql);
    return $query;
}

function pobierz_druzyna_by_id($row) {
    global $con;
    $sql="SELECT * FROM druzyna WHERE id=$row[id_druzyna]";
    $query=mysqli_query($con, $sql);
    return mysqli_fetch_assoc($query);
}
?>