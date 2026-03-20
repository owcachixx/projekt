<?php
require_once __DIR__."/../includes/database.php";

function pobierz_turniej_by_id($turniej_id) {
    global $con;
    $sql="SELECT * FROM turniej WHERE id = ".$turniej_id;
    $query=mysqli_query($con,$sql);
    return $query;
}
function pobierz_turniej() {
    global $con;
    $sql="SELECT * FROM turniej";
    $query=mysqli_query($con,$sql);
    return $query;
}
?>