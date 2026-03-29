function generujDrabine() {
  fetch("drabina.php")
    .then(res => res.text())
    .then(data => {
      idChange(data);
    });
}

function idChange(liczbaDryzy) {
  const zbior = [2,3,4,7,8,15,16,31,32];
  if(zbior.includes(liczbaDryzy)){
    var id = liczbaDryzy;
  }else{
    var id = "brak";
  }
  document.getElementById("tournamentBracket").className = id;
}

function bracketsSize(size) {
    target = document.getElementById("tournamentBracket");
    target.innerHTML = "include __DIR__.'/php/view/brackets"+ size +".php'";
}