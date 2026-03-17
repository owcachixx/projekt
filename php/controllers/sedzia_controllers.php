<?php
require_once "../models/sedzia_model.php";

function pokaz_sedziow() {
    $query=pobierz_sedziow();
    while($row=mysqli_fetch_assoc($query)){
        echo "<tr>
        <td><input type='checkbox' class='sedzia_checkbox' id='sedzia_id_checkbox_$row[id]' name='sedzia_id[]' value='$row[id]' style='display: none;'/></td>
        <td><input type='radio' class='sedzia_radio' id='sedzia_id_$row[id]' name='sedzia_id' value='$row[id]' style='display: none;'/></td>
        <td><label data-imie='$row[imie]' data-nazwisko='$row[nazwisko]'>$row[imie] $row[nazwisko]</label></td>
        </tr>";
        }
}

?>