<?php
require_once __DIR__."/../includes/database.php";
include __DIR__."/../includes/session.php";
if(count($_POST) > 0){
    $ids=$_POST;
    foreach($ids as $id){
        $sql_del_udzal="DELETE FROM udzial WHERE id_druzyna =".$id;
        $query = mysqli_query($con,$sql_del_udzal);
        if(!$query){
            error_log("".mysqli_error($con));
        }
        $sql_del_druzyna="DELETE FROM druzyna WHERE id=".$id;
        $query = mysqli_query($con,$sql_del_druzyna);
        if(!$query){
            error_log("".mysqli_error($con));
        }
    }
}
mysqli_close($con);
?>