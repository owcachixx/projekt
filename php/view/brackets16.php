<?php 
include __DIR__."/../php/controllers/brackets_controller.php";
?>
<section class="buttons">
  <?php generuj_runde(4); ?>
</section>
<div class="bracket16">
  <!-- Runda 2: 16 drużyn -->
  <section class="round round_of_16 round1">
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

  <!-- Ćwierćfinały: 8 drużyn -->
  <section class="round quarterfinals round2">
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

  <!-- Półfinały: 4 drużyny -->
  <section class="round semifinals round3">
    <div class="winners">
      <div class="matchups">
        <?php bracket(3); ?>
      </div>
    </div>
    <div class="connector">
      <div class="merger"></div>
      <div class="line"></div>
    </div>
  </section>

  <!-- Finał: 2 drużyny -->
  <section class="round finals round4">
    <div class="winners">
      <div class="matchups">
        <?php bracket(4); ?>
      </div>
    </div>
  </section>

</div>