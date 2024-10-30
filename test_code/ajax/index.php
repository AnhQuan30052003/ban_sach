<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <title>Document</title>
</head>

<body>
  <h1>Test Ajax </h1>
  <?php
    for ($i = 1; $i <= 3; $i++) {
      echo "
        <div class='heart' id='$i' style='margin: 10px;'>
          <i class='fa-regular fa-heart'></i>
        </div>
      ";
    }
  ?> 

  <script>
     const hearts = document.querySelectorAll(".heart");
     hearts.forEach(item => {
      item.addEventListener("click", function() {
        let id = this.getAttribute("id");
        
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'handle.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id=' + id);
      });
    });
  </script>
</body>
</html>