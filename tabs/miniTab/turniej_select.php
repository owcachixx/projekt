<?php
include "../php/controllers/turniej_select_controllers.php"
?>
<h3>
<?php wybrany_turniej(); ?>
</h3>
<button onclick="zmienTurniej()">Zmień turniej</button>
<button onclick="dodajTurniej()">Dodaj turniej</button>
<form method="post" action="includes/sesja_turniej.php" id="turniej_select_form" style="display: none;">
    <select name="turniej_id">
        <option value="brak">Brak</option>
        <?php select_turniej(); ?>
    </select>
    <button type="submit">Wybierz</button>
</form>
<form method="post" action="/actions/dodaj_turniej.php" id="dodaj_turniej_form" class="dodaj_turniej_form" style="display: none;">
    <input type="text" name="nazwa_turnieju" placeholder="Nazwa turnieju">
    <label for="data_turnieju">Data turnieju:</label>
    <input type="date" name="data_turnieju" id="data_turnieju">
    <button type="submit">Dodaj</button>
</form>