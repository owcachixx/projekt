<?php
require_once "../includes/database.php";
if(isset($_POST['nazwa_turnieju']) && isset($_POST['data_turnieju'])){
    $nazwa = $_POST['nazwa_turnieju'];
    $data = $_POST['data_turnieju'];
    $sql="INSERT INTO turniej (nazwa, data) VALUES ('$nazwa', '$data')";
    mysqli_query($con,$sql);
}
header("Location: ../index.html");

?>
