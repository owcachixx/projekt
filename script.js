function openTab(button,file) {
  document.querySelectorAll(".tab-btn").forEach(tab => {
    tab.classList.remove("active");
  });
  button.classList.add("active");
  fetch(file)
    .then(response => response.text())
    .then(data => {
      document.getElementById("content").innerHTML = data;
      setupFormHandler();
    });
}

function setupFormHandler() {
  const allForms = document.querySelectorAll("#content form");
    allForms.forEach(form => {
    if(form.hasListener) return;
    form.hasListener = true;
    
    form.addEventListener("submit", function(e) {
      e.preventDefault();
      const formData = new FormData(form);
      fetch(form.action, {
        method: "POST",
        body: formData,
        credentials: 'same-origin'
      })
      .then(response => response.text())
      .then(data => {
        console.log("Success:", data);
        const forms = document.querySelectorAll("#content form");
        forms.forEach(f => {
          if(f.classList && f.classList.contains("dodaj_druzyne_form")) {
            f.style.display = "none";
            f.reset();
          }
          f.reset();
        });
        const activeBtn = document.querySelector(".tab-btn.active");
        const fileToLoad = activeBtn.getAttribute("onclick").match(/'([^']+)'/)[1];
        openTab(activeBtn, fileToLoad);
      })
      .catch(error => console.error("Error:", error));
    });
  });
}

function resetDruzyna() {
  const resetBtn = document.getElementById("reset_druzyny");
  if(resetBtn) resetBtn.style.display = "block";
}

function hideAllActions() {
  const nieGrajace = document.getElementsByClassName("nie_grajace_druzyny");
  const grajace = document.getElementsByClassName("grajace_druzyny");
  for(let checkBox of nieGrajace) checkBox.style.display = "none";
  for(let checkBox of grajace) checkBox.style.display = "none";

  const submitUsun = document.getElementById("submit_druzyny_usun");
  const submitGlos = document.getElementById("submit_druzyny_zglos");
  const submitWycofaj = document.getElementById("submit_druzyny_wycofaj");
  const dodajForm = document.getElementsByClassName("dodaj_druzyne_form")[0];
  const resetBtn = document.getElementById("reset_druzyny");
  if(resetBtn) resetBtn.style.display = "none";
  if(submitUsun) submitUsun.style.display = "none";
  if(submitGlos) submitGlos.style.display = "none";
  if(submitWycofaj) submitWycofaj.style.display = "none";
  if(dodajForm) dodajForm.style.display = "none";
}

function usunDruzyne() {
  const submitBtn = document.getElementById("submit_druzyny_usun");
  if(submitBtn && submitBtn.style.display === "block") {
    hideAllActions();
  } else {
    hideAllActions();
    const checkBoxes = document.getElementsByClassName("nie_grajace_druzyny");
    for(let checkBox of checkBoxes) checkBox.style.display = "block";
    if(submitBtn) submitBtn.style.display = "block";
    document.getElementById("form_druzyny").action="../actions/usun_druzyna.php";
  }
  resetDruzyna();
}

function zglosDruzyne() {
  const submitBtn = document.getElementById("submit_druzyny_zglos");
  if(submitBtn && submitBtn.style.display === "block") {
    hideAllActions();
  } else {
    hideAllActions();
    const checkBoxes = document.getElementsByClassName("nie_grajace_druzyny");
    for(let checkBox of checkBoxes) checkBox.style.display = "block";
    if(submitBtn) submitBtn.style.display = "block";
    document.getElementById("form_druzyny").action="../actions/zglos_druzyna.php";
  }
  resetDruzyna();
}

function wycofajDruzyne() {
  const submitBtn = document.getElementById("submit_druzyny_wycofaj");
  if(submitBtn && submitBtn.style.display === "block") {
    hideAllActions();
  } else {
    hideAllActions();
    const checkBoxes = document.getElementsByClassName("grajace_druzyny");
    for(let checkBox of checkBoxes) checkBox.style.display = "block";
    if(submitBtn) submitBtn.style.display = "block";
    document.getElementById("form_druzyny").action="../actions/wycofaj_druzyna.php";
  }
  resetDruzyna();
}

function dodajDruzyne() {
  const form = document.getElementsByClassName("dodaj_druzyne_form")[0];
  if(form && form.style.display === "block") {
    hideAllActions();
  } else {
    hideAllActions();
    if(form) form.style.display = "block";
  }
  const resetBtn = document.getElementById("reset_druzyny");
  resetBtn.style.display === "none";
}
function dodajTurniej() {
  const form = document.getElementsByClassName("dodaj_turniej_form")[0];
  const form2 = document.getElementById("turniej_select_form");
  form.style.display = form.style.display === "none" ? "block" : "none";
  if(form2.style.display === "block"){
    form2.style.display = "none";
  }

}
function zmienTurniej() {
  const form = document.getElementById("turniej_select_form");
  form.style.display = form.style.display === "none" ? "block" : "none";
  const form2 = document.getElementsByClassName("dodaj_turniej_form")[0];
  if(form2.style.display === "block"){
    form2.style.display = "none";
  }
}
