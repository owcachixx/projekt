<?php
    include "../php/controllers/mecz_controllers.php";
    include "../php/models/sedzia_model.php"
?>
<section>
    <button id="dodaj_mecz_btn" onclick="dodajMecz()">Dodaj mecz</button>
    <button id="usun_mecz_btn" onclick="usunMecz()">Usuń mecz</button>
    <button id="edytuj_mecz_btn" onclick="edytujMecz()">Modyfikuj mecz</button>
    <button id="generuj_mecze_btn" onclick="generujMecze()">Generuj mecze</button>
    <form method="post" action="../actions/dodaj_mecz.php" id="dodaj_mecz_form" style="display: none;">
        <select name="druzyna_1" id="druzyna_1_select">
            <?php select_druzyna() ?>
        </select>
        <select name="druzyna_2" id="druzyna_2_select">
            <?php select_druzyna() ?>
        </select>
        <select name="sedzia" id="sedzia_select">
            <?php sendzia_select($sedziowie); ?>
        </select>
        <select name="sedzia_asystent_1" id="sedzia_asystent_1_select">
            <?php sendzia_select($sedziowie); ?>
        </select>
        <select name="sedzia_asystent_2" id="sedzia_asystent_2_select">
            <?php sendzia_select($sedziowie); ?>
        </select>
        <button type="submit">Dodaj</button>
    </form>
    <form method="post" action="../actions/generuj_mecze.php" id="generuj_mecze_form" style="display: none;">
        <input type="hidden" name="turniej_id" value="<?php echo $_SESSION['turniej_id']; ?>">
        <input type="number" name="liczba_meczy_jednoczesnie" placeholder="Liczba meczy jednocześnie" min="1" max="10" required>
        <select name="sedzia" id="generuj_sedzia_select" multiple>
            <?php sendzia_select($sedziowie); ?>
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
    <?php tabe_mecze(); ?>
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
            <?php select_druzyna_edit(); ?>
        </select>
        <select name="druzyna_2" id="edytuj_druzyna_2_select">
            <?php select_druzyna_edit(); ?>
        </select>
        <select name="sedzia" id="edytuj_sedzia_select">
            <?php sendzia_select($sedziowie); ?>
        </select>
        <select name="sedzia_asystent_1" id="edytuj_sedzia_asystent_1_select">
            <?php sendzia_select($sedziowie); ?>
        </select>
        <select name="sedzia_asystent_2" id="edytuj_sedzia_asystent_2_select">
            <?php sendzia_select($sedziowie); ?>
        </select>
        <select name="wynik_druzyna_1" id="edytuj_wynik_druzyna_1_select">
            <?php wynik_druzyny(); ?>
        </select>
        <select name="wynik_druzyna_2" id="edytuj_wynik_druzyna_2_select">
            <?php wynik_druzyny(); ?>
        </select>
        <button type="submit">Zapisz</button>
    </form>
</section>
