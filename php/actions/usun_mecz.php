<?php
if(isset($_POST['mecz_id'])){
    require_once __DIR__."/../includes/database.php";
    $id_array[]=$_POST['mecz_id'];
    foreach($id_array as $id){
    $sql="DELETE FROM mecz WHERE id = $id";
    mysqli_query($con,$sql);
    }
    mysqli_close($con);
}
header("Location: index.php?tab=tabs%2Fmecze.php");
?>