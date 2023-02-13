<?php
  $user = new User();

  $user->setIdUser($_GET['id']);
  $user->readUserGenres();
?>

<!-- Gout musicaux des utilisateurs -->
<div>
  <ul>
    <?php
      foreach ($variable as $key => $value) {
    ?>
      <li>
        <?= $value ?>
      </li>
    <?php 
      }
    ?>
  </ul>
</div>