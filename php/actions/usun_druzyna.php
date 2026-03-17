<?php
require_once __DIR__."/../includes/database.php";
session_start();
if(isset($_SESSION['turniej_id']) && !empty($_POST)){
    $ids = [];
    foreach($_POST as $key => $value){
        if(is_numeric($key)){
            $ids[]=(int)$key;
        }
    }
    if(!empty($ids)){
        $ids_string = implode(",", $ids);
        $turniej_id = (int)$_SESSION['turniej_id'];
        $sql="DELETE FROM udzial 
                WHERE id_druzyna IN ($ids_string)
                AND id_turniej = $turniej_id";
        mysqli_query($con, $sql);
        $sql="DELETE FROM druzyna 
                WHERE id IN ($ids_string)";
        mysqli_query($con, $sql);
    }
}
mysqli_close($con);
header("Location: index.php");
exit;
?>