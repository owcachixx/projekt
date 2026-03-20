<?php 
include "../php/includes/session.php";
include "../php/controllers/druzyna_controllers.php";
?>
<section class="buttons">
<button class="dodaj_druzyne" onclick="dodajDruzyne()">Dodaj drużynę</button>
<button class="usun_druzyne" onclick="usunDruzyne()">Usuń drużynę</button>
<button class="zglos_druzyne" onclick="zglosDruzyne()">Zgłoś drużynę</button>
<button class="wycofaj_druzyne" onclick="wycofajDruzyne()">Wycofaj drużynę</button>
<form action="../php/actions/dodaj_druzyna.php" method="post" class="dodaj_druzyne_form" style="display: none;">
    <input type="text" placeholder="Nazwa drużyny" name="nazwa">
    <button type="submit">Dodaj</button>
</form>
</section>
<section id="turniej_info">
<form id="form_druzyny" method="post">
<table style="border: 1px solid black;">
    <tr>
        <th colspan="2" style="border: 1px solid black;">Pula drużyn</th>
    </tr>
    <?php pokaz_pule_druzyn(); ?>
</table>
<table style="border: 1px solid black;">
    <th colspan="2" style="border: 1px solid black;"><?php echo isset($_SESSION['turniej_id']) ? 'Drużyny grające' : 'Wybierz turniej, aby zobaczyć drużyny.'; ?></th>
    <?php pokaz_druzyny_turjeju(); ?>
</table>
<button type="reset" style="display: none;" id="reset_druzyny">Reset</button>
<button type="submit" style="display: none;" id="submit_druzyny_usun">Usuń</button>
<button type="submit" style="display: none;" id="submit_druzyny_zglos">Zgłoś</button>
<button type="submit" style="display: none;" id="submit_druzyny_wycofaj">Wycofaj</button>
</form>
</section>