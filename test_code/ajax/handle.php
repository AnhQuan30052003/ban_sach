<?php
  $id = $_POST["id"];

  $fileName = "a.txt";
  $text = "Nhận được id: $id \n";

  file_put_contents($fileName, $text, FILE_APPEND);
?> 