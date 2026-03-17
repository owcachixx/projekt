<?php
if(isset($_POST['druzyna_1']) && isset($_POST['druzyna_2']) && isset($_POST['turniej']) && isset($_POST['sedzia']) && isset($_POST['sedzia_asystent_1']) && isset($_POST['sedzia_asystent_2'])){
    require_once __DIR__."/../includes/database.php";
    $druzyna_1 = $_POST['druzyna_1'];
    $druzyna_2 = $_POST['druzyna_2'];
    $turniej = $_POST['turniej'];
    $sedzia = $_POST['sedzia'];
    $sedzia_asystent_1 = $_POST['sedzia_asystent_1'];
    $sedzia_asystent_2 = $_POST['sedzia_asystent_2'];
    $sql="INSERT INTO mecz (druzyna_1, druzyna_2, turniej_id, sedzia, sedzia_asystent_1, sedzia_asystent_2) VALUES ('$druzyna_1', '$druzyna_2', '$turniej', '$sedzia', '$sedzia_asystent_1', '$sedzia_asystent_2')";
    mysqli_query($con,$sql);
    mysqli_close($con);
}
header("Location: index.php?tab=tabs%2Fmecze.php");
?>