<?php
if(isset($_POST['druzyna_1']) && isset($_POST['druzyna_2']) && isset($_POST['turniej']) && isset($_POST['sedzia']) && isset($_POST['sedzia_asystent_1']) && isset($_POST['sedzia_asystent_2']) && isset($_POST['wynik_druzyna_1']) && isset($_POST['wynik_druzyna_2']) && isset($_POST['mecz_id'])){
    require_once __DIR__."/../includes/database.php";
    $druzyna_1 = $_POST['druzyna_1'];
    $druzyna_2 = $_POST['druzyna_2'];
    $turniej = $_POST['turniej'];
    $sedzia = $_POST['sedzia'];
    $sedzia_asystent_1 = $_POST['sedzia_asystent_1'];
    $sedzia_asystent_2 = $_POST['sedzia_asystent_2'];
    $wynik_druzyna_1 = $_POST['wynik_druzyna_1'];
    $wynik_druzyna_2 = $_POST['wynik_druzyna_2'];
    $mecz_id = $_POST['mecz_id'];
    $sql="UPDATE mecz SET druzyna_1='$druzyna_1', druzyna_2='$druzyna_2', turniej='$turniej', sedzia='$sedzia', sedzia_asystent_1='$sedzia_asystent_1', sedzia_asystent_2='$sedzia_asystent_2', wynik_druzyna_1='$wynik_druzyna_1', wynik_druzyna_2='$wynik_druzyna_2' WHERE id=$mecz_id";
    mysqli_query($con,$sql);
    mysqli_close($con);
}
header("Location: index.php?tab=tabs%2Fmecze.php");
?>