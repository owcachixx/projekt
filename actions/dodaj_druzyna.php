<?php
require_once "../includes/database.php";
if(isset($_POST['nazwa'])){
    $nazwa = $_POST['nazwa'];
    $sql = "INSERT INTO druzyna (nazwa) VALUES ('$nazwa')";
    mysqli_query($con,$sql);
}
mysqli_close($con);
header("Location: ../index.html");

