<?php
include "session.php";

if (isset($_POST['turniej_id']) && $_POST['turniej_id'] !== "brak") {
    $_SESSION['turniej_id'] = $_POST['turniej_id'];
    error_log("Session turniej_id set to: " . $_SESSION['turniej_id']);
} else {
    unset($_SESSION['turniej_id']);
    error_log("Session turniej_id cleared");
}
header("Location: ../../index.php");
exit;
?>