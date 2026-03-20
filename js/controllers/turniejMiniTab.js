fetch("tabs/miniTab/turniej_select.php", { credentials: 'same-origin' })
  .then(res => res.text())
  .then(data => {
    document.getElementById("turniej_wybor").innerHTML = data;
  });
