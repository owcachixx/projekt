<?php
if(!isset($_SESSION["turniej_id"]) || $_SESSION["turniej_id"] == "") {
    ?>
    <p id="generuj_wybierz_turniej" class="wybierz_turniej" style="display: none;">Nie wybrano turnieju. Wybierz turniej</p>
    <?php
}else{
    ?>
    <form method="post" action="../php/actions/generuj_mecze.php" id="generuj_mecze_form" style="display:block;">
    <input type="hidden" name="turniej_id" value="<?php echo $_SESSION['turniej_id']; ?>">

    <label for="liczba_meczy_jednoczesnie">
        Liczba meczy rozgrywanych w tym samym momencie:
    </label>
    <input type="number" name="liczba_meczy_jednoczesnie" min="1" max="10" value="1" required><br>

    <label for="generuj_sedzia_select">
        Wybierz głównych sędziów (Ctrl+klik by zaznaczyć więcej):
    </label>
    <select name="sedzia[]" id="generuj_sedzia_select" multiple required>
        <?php sedzia_select($sedziowie); ?>
    </select><br>

    <label for="runda_select">Runda:</label>
    <select name="runda" id="runda_select" required>
        <option value="1">Runda 1</option>
        <option value="2">Runda 2</option>
        <option value="3">Runda 3</option>
        <option value="4">Runda 4</option>
        <option value="5">Runda 5</option>
    </select><br>

    <label>Wygenerowanie meczu spowoduje usunięcie wszystkich meczów w wybranym turnieju</label>
    <button type="submit" id="generuj_button">Generuj</button>
</form>
    <?php
}

?>
