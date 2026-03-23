const target = document.getElementById("tournamentBracket");

const observer = new MutationObserver((mutationsList) => {
  for (let mutation of mutationsList) {
    if (mutation.type === "attributes" && mutation.attributeName === "class") {
      const newClass = target.className;
      if (newClass === "brak") {
          console.log("Ukrywam drabinkę");
          target.innerHTML = "";
        }else{
          console.log("Pokazuję drabinkę");
          bracketsSize(newClass);
        }
    }
  }
});