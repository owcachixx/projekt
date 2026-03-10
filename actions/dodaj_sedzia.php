<?php
require_once "../includes/database.php";
if(isset($_POST['imie']) && isset($_POST['nazwisko'])){
    $imie=$_POST['imie'];
    $nazwisko=$_POST['nazwisko'];
    $sql="INSERT INTO sedzia (imie, nazwisko) VALUES ('$imie', '$nazwisko')";
    mysqli_query($con,$sql);
}
mysqli_close($con);
header("Location: ../index.html?tab=tabs%2Fsedziowie.php");
?>
