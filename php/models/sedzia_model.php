<?php
require_once "../includes/database.php";

function pobierz_sedziow() {
    global $con;
    $sql="SELECT * FROM sedzia";
    $query=mysqli_query($con, $sql);
    return $query;
}
?>
