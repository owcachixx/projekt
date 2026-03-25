<?php


function bracket($runda=1,) {
    $liczba_druzyn=liczba_druzyn();
    $query=get_mecz($runda);
    if(!$query){
        error_log("Błąd zapytania: ".$query);
    }else{
        if(mysqli_num_rows($query)> 0){
            while($row=mysqli_fetch_assoc($query)){
                echo "<div class='matchup' 
                        data-id='$row[id_meczu]'
                        data-score1='$row[wynik_1]'
                        data-score2='$row[wynik_2]'
                        data-team1='$row[druzyna_1]'
                        data-team2='$row[druzyna_2]'>
                    <div class='participants'>
                    <div class='participant'>
                        <span>$row[druzyna_1]</span>
                        <span class='score'>$row[wynik_1]</span>
                    </div>
                    <div class='participant'>
                        <span>$row[druzyna_2]</span>
                        <span class='score'>$row[wynik_2]</span>
                    </div>
                </div>";
            }
            if($runda == 1){
                $query_bye=get_mecz_BYE();
                if(!$query_bye){
                    error_log("Błąd zapytania: ".$query_bye);
                }else{
                    $row_bye=mysqli_fetch_assoc($query_bye);
                    echo "<div class='matchup' 
                            data-id='$row[id_meczu]'
                            data-score1='$row[wynik_1]'
                            data-score2='$row[wynik_2]'
                            data-team1='5'
                            data-team2='0'>
                        <div class='participants'>
                            <div class='participant'>
                            <span>$row_bye[druzyna_1]</span>
                            <span class='score'>$row_bye[wynik_1]</span>
                        </div>
                        <div class='participant'>
                            <span>$row_bye[druzyna_2]</span>
                            <span class='score'>$row_bye[wynik_2]</span>
                        </div>
                    </div>";
                }
            }
        }else{
            for($i= 0;$i<$liczba_druzyn/2*$runda;$i++){
                echo "<div class='matchup'>
                    <div class='participants'>
                    <div class='participant'>
                        <span>-</span>
                        <span class='score'>-</span>
                    </div>
                    <div class='participant'>
                        <span>-</span>
                        <span class='score'>-</span>
                    </div>
                </div>";
            }
        }
    }     
}

function generuj_runde($liczba_rund){
    for($runda=0;$runda< $liczba_rund;$runda++){
        $query=get_mecz_by_runda($runda);
        if(!$query){
            error_log("Błąd zapytania: ".$query);
        }else{
            if(mysqli_num_rows($query)> 0){
                while($row=mysqli_fetch_assoc($query)){
                    if(($row['wynik_1'] == 5 || $row['wynik_2'] == 5) && ($row['wynik_1'] != $row['wynik_2'])){
                        $query_next_round=get_mecz_by_runda($runda+1);
                        if(!$query_next_round){
                            error_log(''.$query_next_round);
                        }else{
                            if(mysqli_num_rows($query_next_round)> 0){
                                echo "";
                            }else{
                                ?>
                                <form method="post" action="../php/actions/generuj_runde.php" id='form_generuj_runde'>
                                    <input type='hidden' value='<?= $runda; ?>' name='runda'>
                                    <input type="hidden" name="turniej_id" value="<?php include "../php/includes/session_id.php"; ?>">
                                    <label for="liczba_meczy_jednoczesnie"><p>Liczba meczy rozgrywanych w tym samym momencie:</p></label>
                                    <input type="number" name="liczba_meczy_jednoczesnie" placeholder="Liczba meczy jednocześnie" min="1" max="10" value="1" id="liczba_meczy_jednoczesnie" required><br>
                                    <label for="generuj_sedzia_select"><p>Wybierz głównych sędziów:<br><span>(Prztyrzymaj Control by zaznaczyć więcej)</span></p></label>
                                    <select name="sedzia[]" id="generuj_sedzia_select" multiple required>
                                    <button id='generuj_runde' onclick="checkAllWinners()">Generuj kolejną rundę</button>
                                </form>
                                <?php
                            }
                        }
                    }else{
                        echo "Nie dokończona runda.";
                    }
                }
            }
        }
    }
}
?>


