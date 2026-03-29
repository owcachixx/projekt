<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turniej</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bracketsCss/style_brackets32.css">
    <link rel="stylesheet" href="bracketsCss/style_brackets16.css">
    <link rel="stylesheet" href="bracketsCss/style_brackets8.css">
    <link rel="stylesheet" href="bracketsCss/style_brackets4.css">
    <link rel="stylesheet" href="bracketsCss/style_brackets2.css">
    <script src="script.js" defer></script>
    <script src="js/controllers/bracketsController.js" defer></script>
    <script src="js/controllers/brackets.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>
<body>
<div class="tabs">
  <button class="tab-btn" data-file="tabs/druzyny.php">Drużyny</button>
  <button class="tab-btn" data-file="tabs/sedziowie.php">Sędziowie</button>
  <button class="tab-btn" data-file="tabs/mecze.php">Mecze turnieu</button>
  <button class="tab-btn" data-file="tabs/drabina.php">Tablica wyników</button>
</div>
<div id="turniej_wybor">
  <?php include "tabs/miniTab/turniej_select.php"; ?>
</div>
<div id="content"></div>

</body>
</html>
