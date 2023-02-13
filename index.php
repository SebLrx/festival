<?php
  require_once('./autoloader.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <?php 
    switch ($_GET['page']) {
      case 'connection':
        include('./vue/connexion.php'); 
        break;
      case 'createUser':
        include('./vue/createUser.php'); 
        break;
      case 'user':
        include('./vue/user.php'); 
        break;
      case 'festival':
        include('./vue/festival.php'); 
        break;
      case 'afficherArtistes':
        include('./vue/afficherArtistes.php'); 
        break;
      case 'profil':
        include('./vue/userProfile.php'); 
        break;
      default:
        break;
    }
  ?>
</body>
</html>