<?php
  function head(string $namePage = "Document", string $exists = "../../") {
    echo "
      <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='" . $exists . "assets/styles/main.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'>
        <script src='" . $exists . "assets/javascripts/validate.js'></script>
        <title>$namePage</title>
      </head>
    ";
  }
?>