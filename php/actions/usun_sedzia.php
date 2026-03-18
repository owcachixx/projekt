<?php
require_once __DIR__."/../includes/database.php";

if(isset($_POST['sedzia_id']) && !empty($_POST['sedzia_id'])) {
    foreach($_POST['sedzia_id'] as $id) {
        $id = (int)$id;
        $sql_del_mecz = "DELETE FROM mecz 
            WHERE sedzia = $id 
            OR sedzia_asystent_1 = $id 
            OR sedzia_asystent_2 = $id";
        if(!mysqli_query($con, $sql_del_mecz)){
            error_log(mysqli_error($con));
        }
        $sql = "DELETE FROM sedzia WHERE id = $id";
        if(!mysqli_query($con, $sql)){
            error_log("Błąd SQL: " . mysqli_error($con));
        }
    }
}
mysqli_close($con);
?>