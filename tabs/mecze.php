<?php
    require_once "../includes/database.php";
    $sedziowie=[];
    $sql="SELECT * FROM sedzia";
    $query=mysqli_query($con,$sql);
    while($row=mysqli_fetch_assoc($query)){
        $sedziowie[]=$row;
    }
?>
<section>
    <button id="dodaj_mecz_btn" onclick="dodajMecz()">Dodaj mecz</button>
    <button id="usun_mecz_btn" onclick="usunMecz()">Usuń mecz</button>
    <button id="edytuj_mecz_btn" onclick="edytujMecz()">Modyfikuj mecz</button>
    <button id="generuj_mecze_btn" onclick="generujMecze()">Generuj mecze</button>
    <form method="post" action="../actions/dodaj_mecz.php" id="dodaj_mecz_form" style="display: none;">
        <select name="druzyna_1" id="druzyna_1_select">
            <?php
                if(!isset($_SESSION['turniej_id'])){
                    echo "<option disabled>Brak wybranego turnieju</option>";
                }else{
                    $sql="SELECT * FROM udzial JOIN druzyna ON udzial.id_druzyna = druzyna.id WHERE id_turniej = ".$_SESSION['turniej_id'];
                    $query=mysqli_query($con,$sql);
                    if(!$query){
                        error_log("Błąd zapytania: " . mysqli_error($con));
                    }else{
                        while($row=mysqli_fetch_assoc($query)){
                            $sql2="SELECT * FROM druzyna WHERE id = $row[id_druzyna]";
                            $query2=mysqli_query($con,$sql2);
                            $druzyna=mysqli_fetch_assoc($query2);
                            echo "<option value='$row[id]'>$druzyna[nazwa]</option>";
                        }
                    }
                }
            ?>
        </select>
        <select name="druzyna_2" id="druzyna_2_select">
            <?php
                if(!isset($_SESSION['turniej_id'])){
                    echo "<option disabled>Brak wybranego turnieju</option>";
                }else{
                    $sql="SELECT * FROM udzial JOIN druzyna ON udzial.id_druzyna = druzyna.id WHERE id_turniej = ".$_SESSION['turniej_id'];
                    $query=mysqli_query($con,$sql);
                    if(!$query){
                        error_log("Błąd zapytania: " . mysqli_error($con));
                    }else{
                        while($row=mysqli_fetch_assoc($query)){
                            $sql2="SELECT * FROM druzyna WHERE id = $row[id_druzyna]";
                            $query2=mysqli_query($con,$sql2);
                            $druzyna=mysqli_fetch_assoc($query2);
                            echo "<option value='$row[id]'>$druzyna[nazwa]</option>";
                        }
                    }
                }
            ?>
        </select>
        <select name="sedzia" id="sedzia_select">
            <?php foreach($sedziowie as $row): ?>
                <option value="<?= $row['id'] ?>"><?= $row['imie'] . ' ' . $row['nazwisko'] ?></option>
            <?php endforeach; ?>
        </select>
        <select name="sedzia_asystent_1" id="sedzia_asystent_1_select">
            <?php foreach($sedziowie as $row): ?>
                <option value="<?= $row['id'] ?>"><?= $row['imie'] . ' ' . $row['nazwisko'] ?></option>
            <?php endforeach; ?>
        </select>
        <select name="sedzia_asystent_2" id="sedzia_asystent_2_select">
            <?php foreach($sedziowie as $row): ?>
                <option value="<?= $row['id'] ?>"><?= $row['imie'] . ' ' . $row['nazwisko'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Dodaj</button>
    </form>
    <form method="post" action="../actions/generuj_mecze.php" id="generuj_mecze_form" style="display: none;">
        <input type="hidden" name="turniej_id" value="<?php echo $_SESSION['turniej_id']; ?>">
        <input type="number" name="liczba_meczy_jednoczesnie" placeholder="Liczba meczy jednocześnie" min="1" max="10" required>
        <select name="sedzia" id="generuj_sedzia_select" multiple>
            <?php foreach($sedziowie as $row): ?>
                <option value="<?= $row['id'] ?>"><?= $row['imie'] . ' ' . $row['nazwisko'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Generuj</button>
    </form>
</section>
<section>
<form method="post" id="mecz_form" class="mecze_form">
    <table style="border: 1px solid black;">
        <tr>
            <th>Drużyna A</th>
            <th>Drużyna B</th>
            <th>Wynik</th>
            <th>Sędzia</th>
            <th>Sędzia asystujący 1</th>
            <th>Sędzia asystujący 2</th>
        </tr>
    <?php
        $sql="SELECT mecz.id, d1.nazwa AS druzyna_1, d2.nazwa AS druzyna_2, mecz.wynik_druzyna_1, mecz.wynik_druzyna_2, s.imie AS sedzia_imie, s.nazwisko AS sedzia_nazwisko, sa1.imie AS asystent1_imie, sa1.nazwisko AS asystent1_nazwisko, sa2.imie AS asystent2_imie, sa2.nazwisko AS asystent2_nazwisko FROM mecz INNER JOIN druzyna d1 ON mecz.druzyna_1 = d1.id INNER JOIN druzyna d2 ON mecz.druzyna_2 = d2.id INNER JOIN sedzia s ON mecz.sedzia = s.id INNER JOIN sedzia sa1 ON mecz.sedzia_asystent_1 = sa1.id INNER JOIN sedzia sa2 ON mecz.sedzia_asystent_2 = sa2.id";
        $query=mysqli_query($con, $sql);
        if(!$query){
            error_log("Błąd zapytania: " . mysqli_error($con));
        }else{
            while($row=mysqli_fetch_assoc($query)){
                echo "<tr>
                <td><input type='checkbox' class='mecz_checkbox' id='mecz_id_checkbox_$row[id]' name='mecz_id[]' value='$row[id]' style='display: none;'/>
                <input type='radio' class='mecz_radio' id='mecz_id_$row[id]' name='mecz_id' value='$row[id]' style='display: none;' data-druzyna-1='$row[druzyna_1]' data-druzyna-2='$row[druzyna_2]' data-sedzia-id='$row[sedzia_id]' data-asystent1-id='$row[asystent1_id]' data-asystent2-id='$row[asystent2_id]'/>
                <label for='mecz_id_$row[id]'>$row[druzyna_1]</label></td>
                <td><label for='mecz_id_$row[id]'>$row[druzyna_2]</label></td>
                <td><label for='mecz_id_$row[id]'>$row[wynik_druzyna_1] - $row[wynik_druzyna_2]</label></td>
                <td><label for='mecz_id_$row[id]'>$row[sedzia_imie] $row[sedzia_nazwisko]</label></td>
                <td><label for='mecz_id_$row[id]'>$row[asystent1_imie] $row[asystent1_nazwisko]</label></td>
                <td><label for='mecz_id_$row[id]'>$row[asystent2_imie] $row[asystent2_nazwisko]</label></td>
                </tr>";
            }
        }
    ?>
    </table>
    <button type="reset" id="reset_mecz" style="display: none;">Reset</button>
    <button type="submit" id="submit_usun_mecz" style="display: none;">Usuń</button>
    <button type="button" id="submit_edytuj_mecz" style="display: none;" onclick="edytujMeczForm()">Edytuj</button>
</form>
</section>
<section id="edytuj_mecz_section" style="display: none;">
    <h3>Edytuj mecz</h3>
    <form method="post" action="../actions/edytuj_mecz.php" id="edytuj_mecz_form">
        <input type="hidden" name="mecz_id" id="edytuj_mecz_id">
        <select name="druzyna_1" id="edytuj_druzyna_1_select">
            <?php
                $sql="SELECT id, nazwa FROM druzyna";
                $query=mysqli_query($con,$sql);
                if(!$query){
                    error_log("Błąd zapytania: " . mysqli_error($con));
                }else{
                    while($row=mysqli_fetch_assoc($query)){
                        echo "<option value='$row[id]'>$row[nazwa]</option>";
                    }
                }
            ?>
        </select>
        <select name="druzyna_2" id="edytuj_druzyna_2_select">
            <?php
                $sql="SELECT id, nazwa FROM druzyna";
                $query=mysqli_query($con,$sql);
                if(!$query){
                    error_log("Błąd zapytania: " . mysqli_error($con));
                }else{
                    while($row=mysqli_fetch_assoc($query)){
                        echo "<option value='$row[id]'>$row[nazwa]</option>";
                    }
                }
            ?>
        </select>
        <select name="sedzia" id="edytuj_sedzia_select">
            <?php foreach($sedziowie as $row): ?>
                <option value="<?= $row['id'] ?>"><?= $row['imie'] . ' ' . $row['nazwisko'] ?></option>
            <?php endforeach; ?>
        </select>
        <select name="sedzia_asystent_1" id="edytuj_sedzia_asystent_1_select">
            <?php foreach($sedziowie as $row): ?>
                <option value="<?= $row['id'] ?>"><?= $row['imie'] . ' ' . $row['nazwisko'] ?></option>
            <?php endforeach; ?>
        </select>
        <select name="sedzia_asystent_2" id="edytuj_sedzia_asystent_2_select">
            <?php foreach($sedziowie as $row): ?>
                <option value="<?= $row['id'] ?>"><?= $row['imie'] . ' ' . $row['nazwisko'] ?></option>
            <?php endforeach; ?>
        </select>
        <select name="wynik_druzyna_1" id="edytuj_wynik_druzyna_1_select">
            <?php
                for($i=0; $i<=3; $i++){
                    echo "<option value='$i'>$i</option>";
                }
            ?>
        </select>
        <select name="wynik_druzyna_2" id="edytuj_wynik_druzyna_2_select">
            <?php
                for($i=0; $i<=3; $i++){
                    echo "<option value='$i'>$i</option>";
                }
                mysqli_close($con);
            ?>
        </select>
        <button type="submit">Zapisz</button>
    </form>
</section>
