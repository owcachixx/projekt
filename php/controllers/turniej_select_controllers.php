<?php 
require_once "../models/turniej_model.php";
require_once "../includes/session.php";

function wybrany_turniej() {
    if(isset($_SESSION['turniej_id'])){
        $query=pobierz_turniej_by_id($_SESSION['turniej_id']);
        $row=mysqli_fetch_assoc($query);
        echo "Turniej: ".$row['nazwa']."<br>Data: ".$row['data'];
    } else {
        echo "nie wybrano turnieju";
    }
}
function select_turniej() {
    $query=pobierz_turniej();
    while($row=mysqli_fetch_assoc($query)){
        echo "<option value='$row[id]'>$row[nazwa] - $row[data]</option>";
    }
}
?>