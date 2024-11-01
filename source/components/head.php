<?php
  function head(string $namePage = "Document") {
    echo "
      <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='../../assets/styles/main.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'>
        <script scr=''></script>
        <title>$namePage</title>
      </head>
    ";
  }
?>