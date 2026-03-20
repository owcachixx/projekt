<?php
    include "../php/controllers/mecz_controllers.php";
    include "../php/includes/session.php";
    include "../php/controllers/get_sedziowie.php";
?>
<section>
    <button id="dodaj_mecz_btn" onclick="dodajMecz()">Dodaj mecz</button>
    <button id="usun_mecz_btn" onclick="usunMecz()">Usuń mecz</button>
    <button id="edytuj_mecz_btn" onclick="edytujMecz()">Modyfikuj mecz</button>
    <button id="generuj_mecze_btn" onclick="generujMecze()">Generuj mecze</button>
    <?php include "../php/controllers/mecz_dodaj_form.php"; ?>
    <?php include "../php/controllers/mecz_generuj_form.php"; ?>
</section>
<section>
<form method="post" id="mecz_form" class="mecze_form">
    <table style="border: 1px solid black;">
        <tr>
            <th>Drużyna A</th>
            <th>Drużyna B</th>
            <th>Wynik</th>
            <th>Sędzia</th>
            <th colspan="2">Sędziowie asystujący</th>
        </tr>
    <?php table_mecze(); ?>
    </table>
    <button type="reset" id="reset_mecz" style="display: none;">Reset</button>
    <button type="submit" id="submit_usun_mecz" style="display: none;">Usuń</button>
    <button type="button" id="submit_edytuj_mecz" style="display: none;" onclick="edytujMeczForm()">Edytuj</button>
</form>
</section>
<section id="edytuj_mecz_section" style="display: none;">
    <h3>Edytuj mecz</h3>
    <form method="post" action="../php/actions/edytuj_mecz.php" id="edytuj_mecz_form">
        <input type="hidden" name="mecz_id" id="edytuj_mecz_id">
        <select name="druzyna_1" id="edytuj_druzyna_1_select">
            <?php select_druzyna_edit(); ?>
        </select>
        <select name="druzyna_2" id="edytuj_druzyna_2_select">
            <?php select_druzyna_edit(); ?>
        </select>
        <select name="sedzia" id="edytuj_sedzia_select">
            <?php sedzia_select($sedziowie); ?>
        </select>
        <select name="sedzia_asystent_1" id="edytuj_sedzia_asystent_1_select">
            <?php sedzia_select($sedziowie); ?>
        </select>
        <select name="sedzia_asystent_2" id="edytuj_sedzia_asystent_2_select">
            <?php sedzia_select($sedziowie); ?>
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
