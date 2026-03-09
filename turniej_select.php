
<?php
session_start();
require_once "includes/database.php";
?>
<h3>
<?php 
if(isset($_SESSION['turniej_id'])){
    $sql="SELECT * FROM turniej WHERE id = ".$_SESSION['turniej_id'];
    $query=mysqli_query($con,$sql);
    $row=mysqli_fetch_assoc($query);
    echo "Turniej: ".$row['nazwa']."<br>Data: ".$row['data'];
} else {
    echo "nie wybrano turnieju";
}
?>
</h3>
<button onclick="zmienTurniej()">Zmień turniej</button>
<button onclick="dodajTurniej()">Dodaj turniej</button>
<form method="post" action="includes/sesja_turniej.php" id="turniej_select_form" style="display: none;">
    <select name="turniej_id">
        <option value="brak">Brak</option>
        <?php
            $sql="SELECT * FROM turniej";
            $query=mysqli_query($con,$sql);
            while($row=mysqli_fetch_assoc($query)){
                echo "<option value='$row[id]'>$row[nazwa] - $row[data]</option>";
            }
        ?>
    </select>
    <button type="submit">Wybierz</button>
</form>
<form method="post" action="/actions/dodaj_turniej.php" id="dodaj_turniej_form" class="dodaj_turniej_form" style="display: none;">
    <input type="text" name="nazwa_turnieju" placeholder="Nazwa turnieju">
    <label for="data_turnieju">Data turnieju:</label>
    <input type="date" name="data_turnieju" id="data_turnieju">
    <button type="submit">Dodaj</button>
</form>
