<?php session_start(); ?>
<div class="przyciski"></div>
<button class="dodaj_druzyne" onclick="dodajDruzyne()">Dodaj drużynę</button>
<form action="../actions/dodaj_druzyna.php" method="post" class="dodaj_druzyne_form" style="display: none;">
    <input type="text" placeholder="Nazwa drużyny" name="nazwa">
    <button type="submit">Dodaj</button>
</form>
<button class="usun_druzyne" onclick="usunDruzyne()">Usuń drużynę</button>
<form>
    
</form>
<button class="zglos_druzyne" onclick="zglosDruzyne()">Zgłoś drużynę</button>
<button class="wycofaj_druzyne" onclick="wycofajDruzyne()">Wycofaj drużynę</button>
<form id="form_druzyny" method="post">
<table style="border: 1px solid black;">
    <tr>
        <th colspan="2" style="border: 1px solid black;">Pula drużyn</th>
    </tr>
    <?php
        require_once "../includes/database.php";
        $sql="SELECT * FROM druzyna";
        $query=mysqli_query($con,$sql);
        while($row=mysqli_fetch_assoc($query)){
            echo "<tr>
            <td><input type='checkbox' class='nie_grajace_druzyny' style='display: none;' value='on' name='$row[id]'></td>
            <td>".$row['nazwa']."</td>
            </tr>";
        }
            ?>
</table>
<table style="border: 1px solid black;">
    <th colspan="2" style="border: 1px solid black;"><?php echo isset($_SESSION['turniej_id']) ? 'Drużyny grające' : 'Wybierz turniej, aby zobaczyć drużyny.'; ?></th>
    <?php
    if(isset($_SESSION['turniej_id'])){
        $sql2="SELECT * FROM udzial JOIN druzyna ON udzial.id_druzyna = druzyna.id WHERE id_turniej = ".$_SESSION['turniej_id'];
        $query2=mysqli_query($con,$sql2);
        while($row2=mysqli_fetch_assoc($query2)){
            $udzial_id = $row2['id'];
            echo "<tr>
            <td>".("<input type='checkbox' class='grajace_druzyny' style='display: none;' value='$udzial_id' name='$udzial_id'>")."</td>
            <td>".($row2['nazwa'])."</td>
            </tr>";
        }}
    mysqli_close($con);
    ?>
</table>
<button type="reset" style="display: none;" id="reset_druzyny">Reset</button>
<button type="submit" style="display: none;" id="submit_druzyny_usun">Usuń</button>
<button type="submit" style="display: none;" id="submit_druzyny_zglos">Zgłoś</button>
<button type="submit" style="display: none;" id="submit_druzyny_wycofaj">Wycofaj</button>
</form>