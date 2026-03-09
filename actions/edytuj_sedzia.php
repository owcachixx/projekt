<?php
// require_once "../includes/database.php";

// if(!isset($_POST['sedzia_id']) || !isset($_POST['imie']) || !isset($_POST['nazwisko'])) {
//     header("Location: ../index.html?tab=tabs%2Fsedziowie.php");
//     exit;
// }

// $sedzia_id = $_POST['sedzia_id'];
// $imie = $_POST['imie'];
// $nazwisko = $_POST['nazwisko'];

// $sql = "UPDATE sedzia SET imie='$imie', nazwisko='$nazwisko' WHERE id=$sedzia_id";
// $query = mysqli_query($con, $sql);

// if($query) {
//     header("Location: ../index.html?tab=tabs%2Fsedziowie.php");
// } else {
//     echo "Błąd podczas aktualizacji danych sędziego.";
// }
print_r($_POST);
?>