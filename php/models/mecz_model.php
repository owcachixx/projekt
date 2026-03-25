<?php
require_once "../php/includes/database.php";
require_once "../php/includes/session.php";

function pobierz_udzial() {
    global $con;
    $sql="SELECT * FROM udzial JOIN druzyna ON udzial.id_druzyna = druzyna.id WHERE id_turniej = ".$_SESSION['turniej_id'];
    $query=mysqli_query($con, $sql);
    return $query;
}

function pobierz_udzial_cout_druzyny() {
    global $con;
    $sql="SELECT COUNT(druzyna_1) + COUNT(druzyna_2) AS liczba_druzyn
        FROM mecz
        WHERE turniej_id =".$_SESSION['turniej_id'];
    $query=mysqli_query($con, $sql);
    return $query;
}

function pobierz_mecz($runda) {
    global $con;
    if(!$runda) {
        $sql="SELECT 
        mecz.id, 
        d1.nazwa AS druzyna_1, 
        d2.nazwa AS druzyna_2, 
        mecz.wynik_druzyna_1, 
        mecz.wynik_druzyna_2, 
        s.imie AS sedzia_imie, 
        s.nazwisko AS sedzia_nazwisko,
        s.id AS sedzia_id, 
        sa1.imie AS asystent1_imie, 
        sa1.nazwisko AS asystent1_nazwisko,
        sa1.id AS sedzia1_id, 
        sa2.imie AS asystent2_imie, 
        sa2.nazwisko AS asystent2_nazwisko,
        sa2.id AS sedzia2_id,
        runda
        FROM mecz 
        INNER JOIN druzyna d1 ON mecz.druzyna_1 = d1.id 
        INNER JOIN druzyna d2 ON mecz.druzyna_2 = d2.id 
        INNER JOIN sedzia s ON mecz.sedzia = s.id 
        INNER JOIN sedzia sa1 ON mecz.sedzia_asystent_1 = sa1.id 
        INNER JOIN sedzia sa2 ON mecz.sedzia_asystent_2 = sa2.id WHERE runda = $runda AND turniej_id =".$_SESSION['turniej_id'];
        $query=mysqli_query($con, $sql);
        return $query;
    }else{
        $sql="SELECT 
        mecz.id, 
        d1.nazwa AS druzyna_1, 
        d2.nazwa AS druzyna_2, 
        mecz.wynik_druzyna_1, 
        mecz.wynik_druzyna_2, 
        s.imie AS sedzia_imie, 
        s.nazwisko AS sedzia_nazwisko,
        s.id AS sedzia_id, 
        sa1.imie AS asystent1_imie, 
        sa1.nazwisko AS asystent1_nazwisko,
        sa1.id AS sedzia1_id, 
        sa2.imie AS asystent2_imie, 
        sa2.nazwisko AS asystent2_nazwisko,
        sa2.id AS sedzia2_id,
        runda
        FROM mecz 
        INNER JOIN druzyna d1 ON mecz.druzyna_1 = d1.id 
        INNER JOIN druzyna d2 ON mecz.druzyna_2 = d2.id 
        INNER JOIN sedzia s ON mecz.sedzia = s.id 
        INNER JOIN sedzia sa1 ON mecz.sedzia_asystent_1 = sa1.id 
        INNER JOIN sedzia sa2 ON mecz.sedzia_asystent_2 = sa2.id WHERE turniej_id =".$_SESSION['turniej_id'];
        $query=mysqli_query($con, $sql);
        return $query;
    }
}

function pobierz_jedna_druzyna() {
    global $con;
    $sql="SELECT 
    mecz.id,
    COALESCE(d1.nazwa, 'BYE') AS druzyna_1,
    'BYE' AS druzyna_2,
    mecz.turniej_id,
    mecz.runda
    FROM mecz INNER JOIN druzyna d1 ON mecz.druzyna_1 = d1.id
    WHERE druzyna_2 IS NULL AND turniej_id = ".$_SESSION['turniej_id'];
    $query=mysqli_query($con, $sql);
    return $query;
}
?>
