<?php
require_once "../php/includes/database.php";

function pobierz_sedziow() {
    global $con;
    $sql="SELECT * FROM sedzia";
    $query=mysqli_query($con, $sql);
    return $query;
}
?>