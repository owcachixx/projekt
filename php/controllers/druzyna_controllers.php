<?php
require_once __DIR__."/../models/druzyna_model.php";

function pokaz_pule_druzyn() {
    $query=pobierz_druzyna();
    while($row=mysqli_fetch_assoc($query)){
            echo "<tr>
            <td><input type='checkbox' class='nie_grajace_druzyny' style='display: none;' value='on' name='$row[id]'></td>
            <td>".$row['nazwa']."</td>
            </tr>";
        }
}
function pokaz_druzyny_turjeju($turniej_id) {
    $query=pobierz_druzyny_turniej($turniej_id);
    while($row=mysqli_fetch_assoc($query)){
        $udzial_id = $row['id'];
        echo "<tr>
        <td>".("<input type='checkbox' class='grajace_druzyny' style='display: none;' value='$udzial_id' name='$udzial_id'>")."</td>
        <td>".($row['nazwa'])."</td>
        </tr>";
    }
}
?>