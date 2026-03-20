<?php
if(!isset($_SESSION["turniej_id"]) || $_SESSION["turniej_id"] == "") {
    ?>
    <p id="dodaj_wybierz_turniej" class="wybierz_turniej" style="display: none;">Nie wybrano turnieju. Wybierz turniej</p>
    <?php
}else{
    ?>
    <form method="post" action="../php/actions/dodaj_mecz.php" id="dodaj_mecz_form" style="display: none;">
        <input type="hidden" name="turniej_id" value="<?php include "../php/includes/session_id.php"; ?>">
        <select name="druzyna_1" id="druzyna_1_select" required>
            <option value="">Drużyna A</option>
            <?php select_druzyna(); ?>
        </select>
        <select name="druzyna_2" id="druzyna_2_select" required>
            <option value="">Drużyna B</option>
            <?php select_druzyna(); ?>
        </select>
        <select name="sedzia" id="sedzia_select" required>
            <option value="">Główny Sędzia</option>
            <?php sedzia_select($sedziowie); ?>
        </select>
        <select name="sedzia_asystent_1" id="sedzia_asystent_1_select" required>
            <option value="">Sędzia Asystujący</option>
            <?php sedzia_select($sedziowie); ?>
        </select>
        <select name="sedzia_asystent_2" id="sedzia_asystent_2_select" required>
            <option value="">Sędzia Asystujący</option>
            <?php sedzia_select($sedziowie); ?>
        </select>
        <button type="reset" id="reset_dodaj_mecz" style="display: none;">Reset</button>
        <button type="submit" id="submit_dodaj_mecz">Dodaj</button>
    </form>
    <?php
}
?>