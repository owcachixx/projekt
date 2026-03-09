<?php
session_start();
require_once "../includes/database.php";

if(isset($_SESSION['turniej_id'])){
    foreach($_POST as $key => $value){
        if($value === 'on'){
            $check_sql="SELECT id FROM udzial WHERE id_druzyna = $key AND id_turniej = ".$_SESSION['turniej_id'];
            $check_result=mysqli_query($con, $check_sql);
            if(mysqli_num_rows($check_result) == 0){
                $sql="INSERT INTO udzial (id_druzyna, id_turniej) VALUES ($key, ".$_SESSION['turniej_id'].")";
            }
        }
    }
}

mysqli_query($con, $sql);
header("Location: ../index.html");
exit;

?>
