<?php
include "../includes/session.php";
include "mecz_controllers.php";

$round = $_GET['round'] ?? null;

table_mecze($round);
?>