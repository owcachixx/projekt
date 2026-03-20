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
        .then(res => {
          if(!res.ok) throw new Error("Błąd serwera: " + res.status);
          return res.text();
        })
        .then(resp => {
          console.log("Success:", resp);
          form.reset();
          const activeTab = document.querySelector(".tab-btn.active");
          openTab(activeTab, activeTab.dataset.file);
        })
        .catch(err => {
          console.error(err);
          alert("Wystąpił błąd podczas przetwarzania żądania.");
        });
    });
  });
  setupMeczSelects();
  setupMeczSelectsSedzia();
}

// Funkcje dla drużyn 
function hideAllActions() {
  const nieGrajace = document.getElementsByClassName("nie_grajace_druzyny");
  const grajace = document.getElementsByClassName("grajace_druzyny");
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
  for(let checkBox of nieGrajace) checkBox.style.display = "none";
  for(let checkBox of grajace) checkBox.style.display = "none";
}
function usunDruzyne() {
  const submitBtn = document.getElementById("submit_druzyny_usun");
  if(submitBtn && submitBtn.style.display === "block") {
    hideAllActions();
  } else {
    hideAllActions();
    const checkBoxes = document.getElementsByClassName("nie_grajace_druzyny");
    const resetBtn = document.getElementById("reset_druzyny");
    if(resetBtn) resetBtn.style.display = "block";
    if(submitBtn) submitBtn.style.display = "block";
    for(let checkBox of checkBoxes) checkBox.style.display = "block";
    document.getElementById("form_druzyny").action="/php/actions/usun_druzyna.php";
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
    document.getElementById("form_druzyny").action="../php/actions/zglos_druzyna.php";
  }
}
function wycofajDruzyne() {
  const submitBtn = document.getElementById("submit_druzyny_wycofaj");
  if(submitBtn && submitBtn.style.display === "block") {
    hideAllActions();
  } else {
    hideAllActions();
    const checkBoxes = document.getElementsByClassName("grajace_druzyny");
    const resetBtn = document.getElementById("reset_druzyny");
    if(resetBtn) resetBtn.style.display = "block";
    for(let checkBox of checkBoxes) checkBox.style.display = "block";
    if(submitBtn) submitBtn.style.display = "block";
    document.getElementById("form_druzyny").action="../php/actions/wycofaj_druzyna.php";
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
    form.style.display = "block";
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
  if (form) form.action = "../php/actions/usun_sedzia.php";
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
  const edytujSection = document.getElementById("edytuj_sedziego_section");
  const resetBtn = document.getElementById("reset_sedziego");
  if(resetBtn) resetBtn.style.display = "none";
  if(submitUsun) submitUsun.style.display = "none";
  if(submitEdytuj) submitEdytuj.style.display = "none";
  if(dodajForm) dodajForm.style.display = "none";
  if(edytujSection) edytujSection.style.display = "none";
  for(let cb of checkBoxes) cb.style.display = "none";
  for(let cb of radioBoxes) cb.style.display = "none";
}
function edytujForm() {
  const selected = document.querySelector(".sedzia_radio:checked");
  if(!selected) {
    alert("Proszę wybrać sędziego do edycji.");
    return;
  }
  const formSection = document.getElementById("edytuj_sedziego_section");
  const label = document.querySelector(`label[for="${selected.id}"]`);
  const imie = label.dataset.imie;
  const nazwisko = label.dataset.nazwisko;
  const id = selected.value;
  document.getElementById("edytuj_imie").value = imie;
  document.getElementById("edytuj_nazwisko").value = nazwisko;
  document.getElementById("edytuj_sedzia_id").value = id;
  formSection.style.display = "block";
}

// Funkcje dla meczy
function HideAllMeczeActions() {
  const druzyna1Select = document.getElementById("druzyna_1_select");
  const druzyna2Select = document.getElementById("druzyna_2_select");
  const submitAddBtn = document.getElementById("submit_dodaj_mecz");
  const resetAddBtn = document.getElementById("reset_dodaj_mecz");
  const resetBtn = document.getElementById("reset_mecz");
  const dodajForm = document.getElementById("dodaj_mecz_form");
  const generateForm = document.getElementById("generuj_mecze_form");
  const wybierzTurniej = document.getElementsByClassName("wybierz_turniej");
  const submitEditBtn = document.getElementById("submit_edytuj_mecz");
  const submitDelBtn = document.getElementById("submit_usun_mecz");
  const checkBoxes = document.getElementsByClassName("mecz_checkbox");
  const radioBoxes = document.getElementsByClassName("mecz_radio");
  if (resetBtn) resetBtn.style.display = "none";
  if (resetAddBtn) resetAddBtn.style.display = "none";
  if (submitAddBtn) submitAddBtn.style.display = "none";
  if (druzyna1Select) druzyna1Select.style.display = "none";
  if (druzyna2Select) druzyna2Select.style.display = "none";
  if (dodajForm) dodajForm.style.display = "none";
  if (submitDelBtn) submitDelBtn.style.display = "none";
  if (generateForm) generateForm.style.display = "none";
  if (submitEditBtn) submitEditBtn.style.display = "none";
  for (let el of wybierzTurniej) {
    el.style.display = "none";
  }
  for (let cb of checkBoxes) {
      cb.style.display = "none";
    }
  for(let rb of radioBoxes){
    rb.style.display = "none";
  }
}
function dodajMecz() {
  const dodajForm = document.getElementById("dodaj_mecz_form");
  if (!dodajForm) return;
  if (window.getComputedStyle(dodajForm).display === "block") {
    HideAllMeczeActions();
  } else {
    HideAllMeczeActions();
    const wybierzTurniej = document.getElementById("dodaj_wybierz_turniej");
    const druzyna1 = document.getElementById("druzyna_1_select");
    const druzyna2 = document.getElementById("druzyna_2_select");
    const submitBtn = document.getElementById("submit_dodaj_mecz");
    const resetBtn = document.getElementById("reset_dodaj_mecz");
    if (wybierzTurniej) wybierzTurniej.style.display = "block";
    if (dodajForm) dodajForm.style.display = "block";
    if (druzyna1) druzyna1.style.display = "block";
    if (druzyna2) druzyna2.style.display = "block";
    if (submitBtn) submitBtn.style.display = "block";
    if (resetBtn) resetBtn.style.display = "block";
  }
}
function setupMeczSelects() {
  const druzyna1 = document.getElementById("druzyna_1_select");
  const druzyna2 = document.getElementById("druzyna_2_select");
  if (!druzyna1 || !druzyna2) return;
  function updateSelects() {
    const val1 = druzyna1.value;
    const val2 = druzyna2.value;
    for (let option of druzyna1.options) {
      option.style.display = (option.value === val2) ? "none" : "block";
    }
    for (let option of druzyna2.options) {
      option.style.display = (option.value === val1) ? "none" : "block";
    }
    if (val1 === val2) {
      druzyna2.value = "";
    }
  }
  if (!druzyna1.dataset.listener) {
    druzyna1.dataset.listener = "true";
    druzyna1.addEventListener("change", updateSelects);
  }
  if (!druzyna2.dataset.listener) {
    druzyna2.dataset.listener = "true";
    druzyna2.addEventListener("change", updateSelects);
  }
}
function setupMeczSelectsSedzia() {
  const sedziaSelect = document.getElementById("sedzia_select");
  const asystent1Select = document.getElementById("sedzia_asystent_1_select");
  const asystent2Select = document.getElementById("sedzia_asystent_2_select");
  if (!sedziaSelect || !asystent1Select || !asystent2Select) return;
  function updateSedziaSelects() {
    const sedziaVal = sedziaSelect.value;
    const asystent1Val = asystent1Select.value;
    const asystent2Val = asystent2Select.value;
    for (let option of sedziaSelect.options) {
      option.style.display = (option.value === asystent1Val || option.value === asystent2Val) ? "none" : "block";
    }
    for (let option of asystent1Select.options) {
      option.style.display = (option.value === sedziaVal || option.value === asystent2Val) ? "none" : "block";
    }
    for (let option of asystent2Select.options) {
      option.style.display = (option.value === sedziaVal || option.value === asystent1Val) ? "none" : "block";
    }
    if (asystent1Val === sedziaVal) asystent1Select.value = "";
    if (asystent2Val === sedziaVal) asystent2Select.value = "";
    if (asystent1Val === asystent2Val) asystent2Select.value = "";
  }
  if (!sedziaSelect.dataset.listener) {
    sedziaSelect.dataset.listener = "true";
    sedziaSelect.addEventListener("change", updateSedziaSelects);
  }
  if (!asystent1Select.dataset.listener) {
    asystent1Select.dataset.listener = "true";
    asystent1Select.addEventListener("change", updateSedziaSelects);
  }
  if (!asystent2Select.dataset.listener) {
    asystent2Select.dataset.listener = "true";
    asystent2Select.addEventListener("change", updateSedziaSelects);
  }
}
function usunMecz() {
  const check = document.getElementsByClassName("mecz_checkbox")[0];
  if (check.style.display === "block") {
    HideAllMeczeActions();
    return;
  }else{
    HideAllMeczeActions();
    const checkBoxes = document.getElementsByClassName("mecz_checkbox");
    const submitBtn = document.getElementById("submit_usun_mecz");
    const resetBtn = document.getElementById("reset_mecz");
    const form = document.getElementById("mecz_form");
    const labels = document.querySelectorAll("label[for^='mecz_id_checkbox_']");
    for (let cb of checkBoxes) {
      cb.style.display = "block";
    }
    if (submitBtn) submitBtn.style.display = "block";
    if (resetBtn) resetBtn.style.display = "block";
    if (form) form.action = "php/actions/usun_mecz.php";
    labels.forEach((label, index) => {
      if (checkBoxes[index]) {
        label.htmlFor = "mecz_id_checkbox_$row[id]";
      }
    });
  }
}
function edytujMecz() {
  const check = document.getElementsByClassName("mecz_radio")[0];
  if (check.style.display === "block"){
    HideAllMeczeActions();
    return;
  }else{
    HideAllMeczeActions();
    const radioBoxes = document.getElementsByClassName("mecz_radio");
    const submitBtn = document.getElementById("submit_edytuj_mecz");
    const resetBtn = document.getElementById("reset_mecz");
    const form = document.getElementById("mecz_form");
    const labels = document.querySelectorAll("label[for^='mecz_id_']");
    for(let rb of radioBoxes){
      rb.style.display = "block";
    }
    if (submitBtn) submitBtn.style.display = "block";
    if(resetBtn) resetBtn.style.display = "block";
    if(form) form.action = "";
    labels.forEach((label, index) => {
      if (radioBoxes[index]) {
        label.htmlFor = "mecz_id_radio_$row[id]";
      }
    });
}
}
function edytujMeczForm() {
  const selected = document.querySelector(".mecz_radio:checked");
  if (!selected) {
    alert("Proszę wybrać mecz do edycji.");
    return;
  }
  const formSection = document.getElementById("edytuj_mecz_section");
  const label = document.querySelector(`label[for="${selected.id}"]`);
  const row = label.closest("tr");
  if (!row) return;
  document.getElementById("edytuj_druzyna_1_select").value = row.dataset.druzyna1Id;
  document.getElementById("edytuj_druzyna_2_select").value = row.dataset.druzyna2Id;
  document.getElementById("edytuj_mecz_id").value = selected.value;
  document.getElementById("edytuj_sedzia_select").value = row.dataset.sedziaId;
  document.getElementById("edytuj_asystent_1_select").value = row.dataset.asystent1Id;
  document.getElementById("edytuj_asystent_2_select").value = row.dataset.asystent2Id;
  if (formSection) formSection.style.display = "block";
}
function generujMecze() {
  const generujForm = document.getElementById("generuj_mecze_form");
  if (!generujForm) return;
  if (window.getComputedStyle(generujForm).display === "block") {
    HideAllMeczeActions();
    return;
  }
  HideAllMeczeActions();
  const wybierzTurniej = document.getElementById("generuj_wybierz_turniej");
  generujForm.style.display = "block";
  if (wybierzTurniej) wybierzTurniej.style.display = "block";
}
