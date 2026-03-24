<?php

if (!isset($_POST['turniej_id'], $_POST['liczba_meczy_jednoczesnie'], $_POST['sedzia']) || !is_array($_POST['sedzia'])) {
    error_log("Nieprawidłowe dane wejściowe");
    exit;
}

require_once __DIR__ . "/../includes/database.php";

$turniej_id = intval($_POST['turniej_id']);
$liczba_meczy_jednoczesnie = intval($_POST['liczba_meczy_jednoczesnie']);
$sedzia_glowni = array_map('intval', $_POST['sedzia']);

if (count($sedzia_glowni) < 1) {
    error_log("Brak głównych sędziów.");
    exit;
}

$sql_delete = "DELETE FROM mecz WHERE turniej_id = $turniej_id";
if (!mysqli_query($con, $sql_delete)) {
    error_log("Błąd DELETE: " . mysqli_error($con));
}

$query_sedziowie = mysqli_query($con, "SELECT id FROM sedzia");
if (!$query_sedziowie) {
    error_log("Błąd sędziowie: " . mysqli_error($con));
    exit;
}

$sedziowie_wszyscy = [];
while ($row = mysqli_fetch_assoc($query_sedziowie)) {
    $sedziowie_wszyscy[] = $row['id'];
}

$sedziowie_asystenci = array_values(array_diff($sedziowie_wszyscy, $sedzia_glowni));

if (count($sedziowie_asystenci) < 2) {
    error_log("Za mało asystentów.");
    exit;
}

$query_druzyny = mysqli_query($con, "SELECT id_druzyna FROM udzial WHERE id_turniej = $turniej_id");
if (!$query_druzyny) {
    error_log("Błąd drużyny: " . mysqli_error($con));
    exit;
}

$druzyny = [];
while ($row = mysqli_fetch_assoc($query_druzyny)) {
    $druzyny[] = $row['id_druzyna'];
}

if (count($druzyny) < 2) {
    error_log("Za mało drużyn.");
    exit;
}

shuffle($druzyny);

$mecze = [];

if (count($druzyny) % 2 != 0) {
    $mecze[] = ['druzyna_1' => $druzyny[count($druzyny) - 1], 'druzyna_2' => null];
}

for ($i = 0; $i < count($druzyny) - 1; $i += 2) {
    $mecze[] = ['druzyna_1' => $druzyny[$i], 'druzyna_2' => $druzyny[$i + 1]];
}

$licznik_meczy = 0;
$pula_glownych = [];
$pula_asystentow = [];
$dostepni_asystenci = [];

foreach ($mecze as $mecz) {

    $druzyna1 = intval($mecz['druzyna_1']);

    if ($mecz['druzyna_2'] === null) {
        $sql_insert = "INSERT INTO mecz(druzyna_1, druzyna_2, sedzia, sedzia_asystent_1, sedzia_asystent_2, turniej_id, runda)
                       VALUES($druzyna1, NULL, NULL, NULL, NULL, $turniej_id, 1)";
        if (!mysqli_query($con, $sql_insert)) {
            error_log("Błąd INSERT: " . mysqli_error($con));
        } else {
            error_log("BYE: drużyna $druzyna1 przechodzi dalej");
        }
        continue;
    }

    if ($licznik_meczy % $liczba_meczy_jednoczesnie == 0) {
        $pula_glownych = $sedzia_glowni;
        $pula_asystentow = $sedziowie_asystenci;
        shuffle($pula_glownych);
        shuffle($pula_asystentow);
        $dostepni_asystenci = $pula_asystentow;
    }

    $sedzia = array_shift($pula_glownych);

    if (count($dostepni_asystenci) < 2) {
        error_log("Za mało asystentów");
        break;
    }

    $asystent1 = array_shift($dostepni_asystenci);
    $asystent2 = array_shift($dostepni_asystenci);

    if ($sedzia === null || $asystent1 === null || $asystent2 === null) {
        error_log("Brak sędziów");
        continue;
    }

    $druzyna2 = intval($mecz['druzyna_2']);

    $sql_insert = "INSERT INTO mecz(druzyna_1, druzyna_2, sedzia, sedzia_asystent_1, sedzia_asystent_2, turniej_id, runda)
                   VALUES($druzyna1, $druzyna2, $sedzia, $asystent1, $asystent2, $turniej_id, 1)";

    if (!mysqli_query($con, $sql_insert)) {
        error_log("Błąd INSERT: " . mysqli_error($con));
    } else {
        error_log("Mecz: $druzyna1 vs $druzyna2");
    }

    $licznik_meczy++;
}

mysqli_close($con);
exit;

?>
