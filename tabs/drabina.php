<?php
include "../php/controllers/drabina_controller.php";
require_once "../php/models/mecz_model.php";
?>
<section class="buttons">
    <button onclick="generujDrabine(<?php echo pobierz_udzial_cout_druzyny(); ?>)">Generuj drabinę turniejową</button>
</section>
<section class="brak" id="tournamentBracket"></section>
<script src="js/controllers/drabinaController.js"></script>
<script src="js/controllers/brackets.js"></script>
