<?php
if(isset($_POST['nazwa_turnieju']) && isset($_POST['data_turnieju'])){
    require_once __DIR__."/../includes/database.php";
    $nazwa = $_POST['nazwa_turnieju'];
    $data = $_POST['data_turnieju'];
    $sql="INSERT INTO turniej (nazwa, data) VALUES ('$nazwa', '$data')";
    mysqli_query($con,$sql);
    mysqli_close($con);
}
?>