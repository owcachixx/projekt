<?php 
include __DIR__."/../php/controllers/brackets_controller.php";
?>
<section class="buttons">
  <?php generuj_runde(5); ?>
</section>
<div class="bracket32">
  <!-- Runda 1: 32 drużyny -->
  <section class="round round_of_32 round1">
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

  <!-- Runda 2: 16 drużyn -->
  <section class="round round_of_16 round2">
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

  <!-- Ćwierćfinały: 8 drużyn -->
  <section class="round quarterfinals round3">
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

  <!-- Półfinały: 4 drużyny -->
  <section class="round semifinals round4">
    <div class="winners">
      <div class="matchups">
        <?php bracket(4); ?>
      </div>
    </div>
    <div class="connector">
      <div class="merger"></div>
      <div class="line"></div>
    </div>
  </section>

  <!-- Finał: 2 drużyny -->
  <section class="round finals round5">
    <div class="winners">
      <div class="matchups">
        <?php bracket(5); ?>
      </div>
    </div>
  </section>

</div>