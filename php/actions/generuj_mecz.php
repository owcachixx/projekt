<?php
require_once __DIR__."/../includes/database.php";
if(isset($_POST['turniej_id'], $_POST['liczba_meczy_jednoczesnie'], $_POST['sedzia']) && is_array($_POST['sedzia'])){
    $turniej_id = intval($_POST['turniej_id']);
    $liczba_meczy_jednoczesnie = intval($_POST['liczba_meczy_jednoczesnie']);
    $sedzia_ids = array_map('intval', $_POST['sedzia']);
    $sql_druzyny = "SELECT id_druzyna FROM udzial WHERE id_turniej = $turniej_id";
    $query_druzyny = mysqli_query($con, $sql_druzyny);
    if(!$query_druzyny){
        error_log("Błąd zapytania drużyn: " . mysqli_error($con));
        exit;
    }
    $druzyny = [];
    while($row = mysqli_fetch_assoc($query_druzyny)){
        $druzyny[] = $row['id_druzyna'];
    }
    if(count($druzyny) < 2){
        error_log("Niewystarczająca liczba drużyn do wygenerowania meczy.");
        exit;
    }
    shuffle($druzyny);
    $mecze = [];
    if(count($druzyny) % 2 != 0){
        $mecze[] = [
            'druzyna_1' => $druzyny[count($druzyny)-1],
            'druzyna_2' => null
        ];
    }
    for($i=0;$i<count($druzyny)-1;$i+=2){
        $mecze[] = [
            'druzyna_1' => $druzyny[$i],
            'druzyna_2' => $druzyny[$i+1]
        ];
    }
    $pula_sedziow = $sedzia_ids;
    $licznik_meczy = 0;
    foreach($mecze as $mecz){
        if($licznik_meczy % $liczba_meczy_jednoczesnie == 0){
            $pula_sedziow = $sedzia_ids;
        }
        shuffle($pula_sedziow);
        $sedzia = array_shift($pula_sedziow);
        $asystent1 = array_shift($pula_sedziow);
        $asystent2 = array_shift($pula_sedziow);
        $druzyna1 = intval($mecz['druzyna_1']);
        $druzyna2 = $mecz['druzyna_2'] !== null ? intval($mecz['druzyna_2']) : "NULL";
        $sql_insert = "INSERT INTO mecz (druzyna_1, druzyna_2, sedzia, sedzia_asystent_1, sedzia_asystent_2, turniej_id) VALUES ($druzyna1, $druzyna2, $sedzia, $asystent1, $asystent2, $_SESSION[turniej_id])";
        $query_insert = mysqli_query($con, $sql_insert);
        if(!$query_insert){
            error_log("Błąd zapytania: " . mysqli_error($con));
        }else{
            error_log("Mecz wygenerowany: Drużyna 1 ID: $druzyna1, Drużyna 2 ID: $druzyna2, Sędzia ID: $sedzia, Asystent 1 ID: $asystent1, Asystent 2 ID: $asystent2");
        }
        $licznik_meczy++;
    }
}else{
    error_log("Nieprawidłowe dane wejściowe do generowania meczy.");
}
mysqli_close($con);
header("Location: index.php?tab=tabs%2Fmecze.php");
?>