document.addEventListener("DOMContentLoaded", () => {
  const tabs = document.querySelectorAll(".tab-btn");
  tabs.forEach(btn => {
    btn.addEventListener("click", () => {
      openTab(btn, btn.dataset.file);
    });
  });
  const params = new URLSearchParams(window.location.search);
  const tabFromUrl = params.get("tab");
  let defaultTab = tabs[0];
  if(tabFromUrl) {
    const btn = Array.from(tabs).find(b => b.dataset.file === tabFromUrl);
    if(btn) defaultTab = btn;
  }
  openTab(defaultTab, defaultTab.dataset.file);
});

function openTab(button, file) {
  document.querySelectorAll(".tab-btn").forEach(tab => tab.classList.remove("active"));
  button.classList.add("active");
  history.replaceState(null, "", "?tab=" + encodeURIComponent(file));
  fetch(file)
    .then(res => {
      if(!res.ok) throw new Error("Nie znaleziono pliku: " + file);
      return res.text();
    })
    .then(html => {
      document.getElementById("content").innerHTML = html;
      setupFormHandler();
    })
    .catch(err => {
      console.error(err);
      document.getElementById("content").innerHTML = "<p>Nie udało się załadować zakładki.</p>";
    });
}

function setupFormHandler() {
  const forms = document.querySelectorAll("#content form");
  forms.forEach(form => {
    if(form.dataset.listener) return;
    form.dataset.listener = "true";
    form.addEventListener("submit", e => {
      e.preventDefault();
      const data = new FormData(form);
      fetch(form.action, { method: "POST", body: data, credentials: 'same-origin' })
        .then(res => res.text())
        .then(resp => {
          console.log("Success:", resp);
          form.reset();
          openTab(document.querySelector(".tab-btn.active"), document.querySelector(".tab-btn.active").dataset.file);
        })
        .catch(err => console.error(err));
    });
  });
}

// Funkcje dla drużyn 
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
  if(submitBtn && submitBtn.style.display === "block") {
    hideAllActions();
  } else {
    hideAllActions();
    const checkBoxes = document.getElementsByClassName("nie_grajace_druzyny");
    const submitBtn = document.getElementById("submit_druzyny_usun");
    const resetBtn = document.getElementById("reset_druzyny");
    if(resetBtn) resetBtn.style.display = "block";
    if(submitBtn) submitBtn.style.display = "block";
    for(let checkBox of checkBoxes) checkBox.style.display = "block";
    if(submitBtn) submitBtn.style.display = "block";
    document.getElementById("form_druzyny").action="../actions/usun_druzyna.php";
  }
}

function zglosDruzyne() {
  const submitBtn = document.getElementById("submit_druzyny_zglos");
  if(submitBtn && submitBtn.style.display === "block") {
    hideAllActions();
  } else {
    hideAllActions();
    const checkBoxes = document.getElementsByClassName("nie_grajace_druzyny");
    const submitBtn = document.getElementById("submit_druzyny_zglos");
    const resetBtn = document.getElementById("reset_druzyny");
    if(resetBtn) resetBtn.style.display = "block";
    if(submitBtn) submitBtn.style.display = "block";
    for(let checkBox of checkBoxes) checkBox.style.display = "block";
    if(submitBtn) submitBtn.style.display = "block";
    document.getElementById("form_druzyny").action="../actions/zglos_druzyna.php";
    resetDruzyna();
  }
}

function wycofajDruzyne() {
  if(submitBtn && submitBtn.style.display === "block") {
    hideAllActions();
  } else {
    hideAllActions();
    const checkBoxes = document.getElementsByClassName("grajace_druzyny");
    const resetBtn = document.getElementById("reset_druzyny");
    const submitBtn = document.getElementById("submit_druzyny_wycofaj");
    if(resetBtn) resetBtn.style.display = "block";
    for(let checkBox of checkBoxes) checkBox.style.display = "block";
    if(submitBtn) submitBtn.style.display = "block";
    document.getElementById("form_druzyny").action="../actions/wycofaj_druzyna.php";
    resetDruzyna();
  }
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

// Funkcje dla turnieju
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

// Funkcje dla sędziów
function dodajSedziego() {
  const form = document.getElementById("dodaj_sedziego_form");
  if(form.style.display === "block") {
    HideAllSedziowieActions();
  } else {
    HideAllSedziowieActions();
  form.style.display = form.style.display === "none" ? "block" : "none";
  }
}
function usunSedziego() {
  const checkBoxes = document.getElementsByClassName("sedzia_checkbox");
  const submitBtn = document.getElementById("submit_usun_sedziego");
  const resetBtn = document.getElementById("reset_sedziego");
  const form = document.getElementById("sedzia_form");
  if (window.getComputedStyle(submitBtn).display === "block") {
    HideAllSedziowieActions();
    return;
  }
  HideAllSedziowieActions();
  const labels = document.querySelectorAll("label[data-imie][data-nazwisko]");
  labels.forEach((label, index) => {
    if (checkBoxes[index]) {
      label.htmlFor = checkBoxes[index].id;
    }
  });
  if (form) form.action = "../actions/usun_sedzia.php";
  if (resetBtn) resetBtn.style.display = "block";
  for (let cb of checkBoxes) {
    cb.style.display = "block";
  }
  submitBtn.style.display = "block";
}
function edytujSedziego() {
  const radioBoxes = document.getElementsByClassName("sedzia_radio");
  const submitBtn = document.getElementById("submit_edytuj_sedziego");
  const resetBtn = document.getElementById("reset_sedziego");
  const form = document.getElementById("sedzia_form");
  if (window.getComputedStyle(submitBtn).display === "block") {
    HideAllSedziowieActions();
    return;
  }
  HideAllSedziowieActions();
  const labels = document.querySelectorAll("label[data-imie][data-nazwisko]");
  labels.forEach((label, index) => {
    if (radioBoxes[index]) {
      label.htmlFor = radioBoxes[index].id;
    }
  });
  for (let rb of radioBoxes) {
    rb.style.display = "block";
  }
  if (form) form.action = "";
  if (submitBtn) submitBtn.style.display = "block";
  if (resetBtn) resetBtn.style.display = "block";
}
function HideAllSedziowieActions() {
  const checkBoxes = document.querySelectorAll("input[name='sedzia_id[]']");
  const radioBoxes = document.querySelectorAll("input[name='sedzia_id']");
  const submitUsun = document.getElementById("submit_usun_sedziego");
  const submitEdytuj = document.getElementById("submit_edytuj_sedziego");
  const dodajForm = document.getElementById("dodaj_sedziego_form");
  const resetBtn = document.getElementById("reset_sedziego");
  if(resetBtn) resetBtn.style.display = "none";
  if(dodajForm) dodajForm.style.display = "none";
  for(let cb of checkBoxes){
    cb.style.display = "none";
  }
  for(let cb of radioBoxes){
    cb.style.display = "none";
  }
  if(submitUsun) submitUsun.style.display = "none";
  if(submitEdytuj) submitEdytuj.style.display = "none";
}
function edytujForm() {
  const formSection = document.getElementById
  ("edytuj_sedziego_section");
  const selected = document.querySelector(".sedzia_radio:checked");
  const label = document.querySelector(`label[for="${selected.id}"]`);
  const imie = label.dataset.imie;
  const nazwisko = label.dataset.nazwisko;
  const id = selected.value;
  document.getElementById("edytuj_imie").value = imie;
  document.getElementById("edytuj_nazwisko").value = nazwisko;
  document.getElementById("edytuj_sedzia_id").value = id;
  formSection.style.display = "block";
}
