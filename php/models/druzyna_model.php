<?
require_once "../includes/database.php";

function pobierz_druzyna() {
    global $con;
    $sql="SELECT * FROM druzyna";
    $query=mysqli_query($con, $sql);
    return $query;
}

function pobierz_druzyny_turniej() {
    $turniej_id=isset($_SESSION['turniej_id']) ? $_SESSION['turniej_id'] : null;
    global $con;
    $sql="SELECT druzyna.* FROM druzyna JOIN pula_druzyna ON druzyna.id = pula_druzyna.druzyna_id WHERE pula_druzyna.pula_id = $turniej_id";
    $query=mysqli_query($con, $sql);
    return $query;
}

function pobierz_id_nazwa_druzyny() {
    global $con;
    $sql="SELECT id, nazwa FROM druzyna";
    $query=mysqli_query($con, $sql);
}

function pobierz_druzyna_by_id($row) {
    global $con;
    $sql="SELECT * FROM druzyna WHERE id=$row[id_druzyna]";
    $query=mysqli_query($con, $sql);
    return mysqli_fetch_assoc($query);
}
?>