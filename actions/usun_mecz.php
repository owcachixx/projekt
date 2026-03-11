<?php
if(isset($_POST['mecz_id'])){
    require_once "../includes/database.php";
    $id=$_POST['mecz_id'];
    $sql="DELETE FROM mecz WHERE id = $id";
    mysqli_query($con,$sql);
    mysqli_close($con);
}
header("Location: ../index.html?tab=tabs%2Fmecze.php");
?>