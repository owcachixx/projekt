<?php 
include __DIR__."/../controllers/brackets_controller.php";
?>
<section class="buttons">
<button onclick="generujPDF()">Pobierz PDF</button>
</section>
<div class="bracket2">
  <!-- Finał: 2 drużyny -->
  <section class="round finals round1">
    <div class="winners">
      <div class="matchups">
        <?php bracket(); ?>
      </div>
    </div>
  </section>

</div>