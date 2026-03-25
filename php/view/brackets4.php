<?php 
include __DIR__."/../php/controllers/brackets_controller.php";
?>
<section class="buttons">
  <?php generuj_runde(2); ?>
</section>
<div class="bracket4">
  <!-- Półfinały: 4 drużyny -->
  <section class="round semifinals round1">
    <div class="winners">
      <div class="matchups">
        <?php bracket(); ?>
      </div>
    </div>
    <div class="connector">
      <div class="merger"></div>
      <div class="line"></div>
    </div>
  </section>

  <!-- Finał: 2 drużyny -->
  <section class="round finals round2">
    <div class="winners">
      <div class="matchups">
        <?php bracket(2); ?>
      </div>
    </div>
  </section>

</div>
