<?php
require_once __DIR__."/../models/druzyna_model.php";
require_once __DIR__."/../models/mecz_model.php";

function liczba_druzyn() {
    $zbior = [2,4,7,8,15,16,31,32];
    $zbior2 = [7,15,31];
    $query=pobierz_udzial_cout_druzyny();
    $row=mysqli_fetch_array($query);
    $liczba=$row['liczba_druzyn'];
    if(in_array($liczba, $zbior)) {
        if(in_array($liczba, $zbior2)){
            $liczba++;
        }
    return $liczba;
    }else{
        return "brak";
    }
}

function bracket_include() {
    $liczba = liczba_druzyn();
    if($liczba !== "brak"){
        include __DIR__."/../php/view/brackets".$liczba.".php"; 
    }
}
?>