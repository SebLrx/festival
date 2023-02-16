<?php
  require_once('./autoloader.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Festival</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <nav>
    <ul class="grid grid-cols-4 w-full place-items-center py-10">
      <li><a href="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=connection') ?>">Connexion</a></li>
      <li><a href="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=createUser') ?>">Créer un compte</a></li>
      <li><a href="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=festival') ?>">Festival</a></li>
      <li><a href="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=profil') ?>">Profil</a></li>
    </ul>
  </nav>

  <?php 
    if (isset($_GET['page'])) {
      switch ($_GET['page']) {
        case 'connection':
          include('./vue/connexion.php'); 
          break;
        case 'createUser':
          include('./vue/createUser.php'); 
          break;
        case 'festival':
          include('./vue/festival.php'); 
          break;
        case 'profil':
          include('./vue/userProfile.php'); 
          break;
        default:
          include('./vue/connexion.php');
          break;
      }
    } else {
      include('./vue/connexion.php');
    }
  ?>
</body>
</html>