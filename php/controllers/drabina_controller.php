<?php
require_once __DIR__."/../models/druzyna_model.php";
require_once __DIR__."/../models/mecz_model.php";

function liczba_meczy() {
    $zbior = [4,8,16,32];
    $query=pobierz_udzial_cout_mecz();
    if(!$query){
        die("SQL ERROR: " .$query);
    }
    $row=mysqli_fetch_array($query);
    $liczba=$row['liczba_meczy'];
    $liczba = $liczba * 2;
    if(in_array($liczba, $zbior)) {
    return $liczba;
    }else{
        return "brak";
    }
}

function bracket_include() {
    $liczba = liczba_meczy();
    if($liczba !== "brak"){
        include __DIR__."/../view/brackets".$liczba.".php"; 
    } else {
        echo "Brak dopasowania";
    }
}
?>
