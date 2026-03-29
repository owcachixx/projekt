function idChange(liczbaDruzy) {
  const zbior = [2,4,7,8,15,16,31,32];
  const zbior2 = [7,15,31];
  if(zbior.includes(liczbaDruzy)){
    if(zbior2.includes(liczbaDruzy)){
        liczbaDruzy++;
    }
    var id = "bracket" + liczbaDruzy;
  }else{
    var id = "brak";
  }
  document.getElementById("tournamentBracket").className = id;
}

function bracketsSize() {
    var size = document.getElementById("tournamentBracket").className;

    fetch("php/view/brackets" + size + ".php")
        .then(res => res.text())
        .then(data => {
            document.getElementById("tournamentBracket").innerHTML = data;
        });
}

window.onload = function () {
    const el = document.getElementById("tournamentBracket");
    if (el) {
        el.textContent = "TEST DZIAŁA";
    } else {
        console.log("Nie znaleziono elementu");
    }
};

function loadMatches() {
    const round = document.getElementById("round").value;

    fetch("../php/controllers/get_mecze.php?round=" + round)
        .then(res => res.text())
        .then(data => {
            document.getElementById("tableMecz").innerHTML = data;
        });
}