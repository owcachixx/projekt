<?php
require_once __DIR__."/../models/sedzia_model.php";
require_once __DIR__."/../models/mecz_model.php";
require_once __DIR__."/../models/druzyna_model.php";

function select_druzyna() {
    if(!isset($_SESSION['turniej_id'])){
        echo "<option disabled>Brak wybranego turnieju</option>";
    }else{
        $query=pobierz_udzial();
        if(!$query){
            error_log("Błąd zapytania: ".pobierz_udzial());
        }else{
            while($row=mysqli_fetch_assoc($query)){
                $druzyna=pobierz_druzyna_by_id($row);
                echo "<option value='$row[id]'>$druzyna[nazwa]</option>";
            }
        }
    }
}

function sedzia_select($sedziowie) {
    foreach($sedziowie as $row): 
        ?><option value="<?= $row['id'] ?>"><?= $row['imie'] . ' ' . $row['nazwisko'] ?></option>
    <?php endforeach;
}

function wynik_druzyny() {
    for($i=0; $i<=3; $i++){
        echo "<option value='$i'>$i</option>";
    }
}

function select_druzyna_edit() {
    $query=pobierz_id_nazwa_druzyny();
    if(!$query){
        error_log("Błąd zapytania: ".pobierz_id_nazwa_druzyny());
    }else{
        while($row=mysqli_fetch_assoc($query)){
            echo "<option value='$row[id]'>$row[nazwa]</option>";
        }
    }
}

function table_mecze($runda = null) {
    if($runda){
        $query=pobierz_mecz($runda);
    }else{
        $query=pobierz_mecz($runda);
    }
    if(!$query){
        error_log("Błąd zapytania: ".$query);
    }else{
        if(mysqli_num_rows($query) == 0){
        echo "<tr><td colspan='6'>Nie ma jeszcze meczy w turnieju.</td></tr>";
        }else{
            while($row=mysqli_fetch_assoc($query)){
                echo "<tr>
                <td><input type='checkbox' class='mecz_checkbox' id='mecz_id_checkbox_$row[id]' name='mecz_id[]' value='$row[id]' style='display: none;'/>
                <input type='radio' class='mecz_radio' id='mecz_id_radio_$row[id]' name='mecz_id' value='$row[id]' style='display: none;' 
                data-druzyna-1='$row[druzyna_1]' data-druzyna-2='$row[druzyna_2]' data-sedzia-id='$row[sedzia_id]' data-asystent1-id='$row[sedzia1_id]' data-asystent2-id='$row[sedzia2_id]' data-id='$row[id]'/>
                <label for='mecz_id_$row[id]'>$row[druzyna_1]</label></td>
                <td><label for='mecz_id_$row[id]'>$row[wynik_druzyna_1] - $row[wynik_druzyna_2]</label></td>
                <td><label for='mecz_id_$row[id]'>$row[druzyna_2]</label></td>
                <td><label for='mecz_id_$row[id]'>$row[sedzia_imie] $row[sedzia_nazwisko]</label></td>
                <td><label for='mecz_id_$row[id]'>$row[asystent1_imie] $row[asystent1_nazwisko]</label></td>
                <td><label for='mecz_id_$row[id]'>$row[asystent2_imie] $row[asystent2_nazwisko]</label></td>
                <td><label for='mecz_id_$row[id]'>$row[runda]</label></td>
                </tr>";
            }
            $query2=pobierz_jedna_druzyna();
            if(!$query2){
                error_log("Błąd zapytania: ".pobierz_jedna_druzyna());
            }else{
                if(mysqli_num_rows($query2) !== 0){
                $row2=mysqli_fetch_assoc($query2);
                echo "<tr>
                <td><input type='checkbox' class='mecz_checkbox' id='mecz_id_checkbox_$row2[id]' name='mecz_id[]' value='$row2[id]' style='display: none;'/>
                <input type='radio' class='mecz_radio' id='mecz_id_radio_$row2[id]' name='mecz_id' value='$row2[id]' style='display: none;' 
                data-druzyna-1='$row2[druzyna_1]' data-druzyna-2='brak' data-sedzia-id='brak' data-asystent1-id='brak' data-asystent2-id='brak' data-id='$row2[id]'/>
                <label for='mecz_id_$row2[id]'>$row2[druzyna_1]</label></td>
                <td><label for='mecz_id_$row2[id]'>  </label></td>
                <td><label for='mecz_id_$row2[id]'><span class='BYE'>$row2[druzyna_2]</span></label></td>
                </tr>";
                }
            }
        }
    }
}

?>