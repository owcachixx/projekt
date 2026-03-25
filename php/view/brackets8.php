<?php 
include __DIR__."/../php/controllers/brackets_controller.php";
?>
<section class="buttons">
  <?php generuj_runde(3) ?>
</section>
<div class="bracket8">
  <!-- Ćwierćfinały: 8 drużyn -->
  <section class="round quarterfinals round1">
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

  <!-- Półfinały: 4 drużyny -->
  <section class="round semifinals round2">
    <div class="winners">
      <div class="matchups">
        <?php bracket(2); ?>
      </div>
    </div>
    <div class="connector">
      <div class="merger"></div>
      <div class="line"></div>
    </div>
  </section>

  <!-- Finał: 2 drużyny -->
  <section class="round finals round3">
    <div class="winners">
      <div class="matchups">
        <?php bracket(3); ?>
      </div>
    </div>
  </section>

</div>