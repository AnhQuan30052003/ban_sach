<?php
  $text = "Nguyễn _Anh Quân";

  $findPos = strpos($text, "Anh");
  if ($findPos) {
    $text = substr($text, 0, $findPos);
  }

  echo "$text";
?>