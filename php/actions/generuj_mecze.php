<?php
if (
    isset($_POST['turniej_id']) &&
    isset($_POST['liczba_meczy_jednoczesnie']) &&
    isset($_POST['sedzia']) &&
    is_array($_POST['sedzia'])
) {
    require_once __DIR__."/../includes/database.php";

    $turniej_id = intval($_POST['turniej_id']);
    $sql_delete = "DELETE FROM mecz WHERE turniej_id = $turniej_id";
    if (!mysqli_query($con, $sql_delete)) {
        error_log("Błąd DELETE: " . mysqli_error($con));
    }

    $liczba_meczy_jednoczesnie = intval($_POST['liczba_meczy_jednoczesnie']);
    $sedzia_glowni = array_map('intval', $_POST['sedzia']);
    if (count($sedzia_glowni) < 1) {
        error_log("Brak głównych sędziów.");
        exit;
    }

    $sql_sedziowie = "SELECT id FROM sedzia";
    $query_sedziowie = mysqli_query($con, $sql_sedziowie);
    if (!$query_sedziowie) {
        error_log("Błąd pobierania sędziów: ".mysqli_error($con));
        exit;
    }
    $sedziowie_wszyscy = [];
    while ($row = mysqli_fetch_assoc($query_sedziowie)) {
        $sedziowie_wszyscy[] = $row['id'];
    }

    $sedziowie_asystenci = array_values(array_diff($sedziowie_wszyscy, $sedzia_glowni));
    if (count($sedziowie_asystenci) < 2) {
        error_log("Za mało asystentów (min 2 wymaganych).");
        exit;
    }

    $sql_druzyny = "SELECT id_druzyna FROM udzial WHERE id_turniej = $turniej_id";
    $query_druzyny = mysqli_query($con, $sql_druzyny);
    if (!$query_druzyny) {
        error_log("Błąd zapytania drużyn: ".mysqli_error($con));
        exit;
    }

    $druzyny = [];
    while ($row = mysqli_fetch_assoc($query_druzyny)) {
        $druzyny[] = $row['id_druzyna'];
    }

    if (count($druzyny) < 2) {
        error_log("Za mało drużyn do wygenerowania meczy.");
        exit;
    }

    shuffle($druzyny);

    $mecze = [];
    if (count($druzyny) % 2 != 0) {
        $mecze[] = [
            'druzyna_1' => $druzyny[count($druzyny)-1],
            'druzyna_2' => null
        ];
    }
    for ($i = 0; $i < count($druzyny) - 1; $i += 2) {
        $mecze[] = [
            'druzyna_1' => $druzyny[$i],
            'druzyna_2' => $druzyny[$i+1]
        ];
    }

    $licznik_meczy = 0;
    $pula_glownych = [];
    $pula_asystentow = [];
    $dostepni_asystenci = [];

    foreach ($mecze as $mecz) {
        if ($licznik_meczy % $liczba_meczy_jednoczesnie == 0) {
            $pula_glownych = $sedzia_glowni;
            $pula_asystentow = $sedziowie_asystenci;
            shuffle($pula_glownych);
            shuffle($pula_asystentow);
            $dostepni_asystenci = $pula_asystentow;
        }

        $sedzia = array_shift($pula_glownych);

        if (count($dostepni_asystenci) < 2) {
            error_log("Za mało dostępnych asystentów w tym batchu.");
            break;
        }

        $asystent1 = array_shift($dostepni_asystenci);
        $asystent2 = array_shift($dostepni_asystenci);

        if ($sedzia === null || $asystent1 === null || $asystent2 === null) {
            error_log("Brak wystarczającej liczby sędziów w puli.");
            continue;
        }

        $druzyna1 = intval($mecz['druzyna_1']);
        $druzyna2 = ($mecz['druzyna_2'] !== null) ? intval($mecz['druzyna_2']) : "NULL";

        $sql_insert = "INSERT INTO mecz
        (druzyna_1, druzyna_2, sedzia, sedzia_asystent_1, sedzia_asystent_2, turniej_id, runda)
        VALUES ($druzyna1, $druzyna2, $sedzia, $asystent1, $asystent2, $turniej_id, 1)";

        if (!mysqli_query($con, $sql_insert)) {
            error_log("Błąd INSERT: ".mysqli_error($con)." | SQL: $sql_insert");
        } else {
            error_log("Mecz dodany: $druzyna1 vs $druzyna2 | Sedzia: $sedzia, Asystenci: $asystent1, $asystent2");
        }

        $licznik_meczy++;
    }

    mysqli_close($con);
    exit;

} else {
    error_log("Nieprawidłowe dane wejściowe do generowania meczy.");
}
?>
