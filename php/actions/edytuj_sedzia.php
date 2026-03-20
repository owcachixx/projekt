<?php
if(isset($_POST['sedzia_id']) && isset($_POST['imie']) && isset($_POST['nazwisko'])){
    require_once __DIR__."/../includes/database.php";
    $id=$_POST['sedzia_id'];
    $imie=$_POST['imie'];
    $nazwisko=$_POST['nazwisko'];
    $sql="UPDATE sedzia SET imie='$imie', nazwisko='$nazwisko' WHERE id = $id";
    mysqli_query($con,$sql);
    mysqli_close($con);
}
?>