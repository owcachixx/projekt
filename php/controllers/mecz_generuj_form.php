<?php
if(!isset($_SESSION["turniej_id"]) || $_SESSION["turniej_id"] == "") {
    ?>
    <p id="generuj_wybierz_turniej" class="wybierz_turniej" style="display: none;">Nie wybrano turnieju. Wybierz turniej</p>
    <?php
}else{
    ?>
    <form method="post" action="../php/actions/generuj_mecze.php" id="generuj_mecze_form" style="display: none;">
        <input type="hidden" name="turniej_id" value="<?php include "../php/includes/session_id.php"; ?>">
        <label for="liczba_meczy_jednoczesnie"><p>Liczba meczy rozgrywanych w tym samym momencie:</p></label>
        <input type="number" name="liczba_meczy_jednoczesnie" placeholder="Liczba meczy jednocześnie" min="1" max="10" value="1" id="liczba_meczy_jednoczesnie" required><br>
        <label for="generuj_sedzia_select"><p>Wybierz głównych sędziów:<br><span>(Prztyrzymaj Control by zaznaczyć więcej)</span></p></label>
        <select name="sedzia" id="generuj_sedzia_select" multiple>
            <?php sedzia_select($sedziowie); ?>
        </select><br>
        <lebel for="generuj_button">Wygenerowanie meczu spowoduje usunięcie wszystkich meczów w wybranym turnieju</lebel>
        <button type="submit" id="generuj_button">Generuj</button>
    </form>
    <?php
}

?>