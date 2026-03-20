<?php
require_once __DIR__."/../includes/database.php";
session_start();
if(isset($_SESSION['turniej_id']) && !empty($_POST)){
    foreach($_POST as $id){
        $turniej_id = (int)$_SESSION['turniej_id'];
        $sql = "DELETE FROM udzial WHERE id_druzyna = $id AND id_turniej = $turniej_id";
        $query=mysqli_query($con, $sql);
        if(!$query){
            error_log("Błąd SQL: " . mysqli_error($con));
        }
    }
}
mysqli_close($con);
?>