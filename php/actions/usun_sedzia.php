<?php
require_once __DIR__."/../includes/database.php";

if(isset($_POST['sedzia_id'])) {
    $sedzia_ids = $_POST['sedzia_id'];
    foreach($sedzia_ids as $id) {
        $sql="DELETE FROM sedzia WHERE id = $id";
        mysqli_query($con, $sql);
    }
}
mysqli_close($con);
header("Location: index.php?tab=tabs%2Fsedziowie.php");
?>