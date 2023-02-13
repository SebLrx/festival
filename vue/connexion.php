<?php
session_start();

require_once(__DIR__ . '\..\models\csrf.php');
require_once(__DIR__ . '\..\models\Utilisateur.php');

$token = new CSRF();
$token->generateToken();

if (isset($_GET['user'])) {
  if ($_GET['user'] == 'auth') {
    // Test email and password
    if (filter_var($_POST['mailUser'], FILTER_VALIDATE_EMAIL) === false || empty($_POST['mdpUser'])) {
      header('Location:' . $_SERVER["PHP_SELF"] . '?page=connection&auth=ko');
    }
  
    $user = new Utilisateur();
    $user->setMailUser($_POST['mailUser']);
    $user->setMdpUser($_POST['mdpUser']);
    
    if ($user->connectUser() === true) {
      header('Location:' . $_SERVER["PHP_SELF"] . '?page=connection&auth=ok');
    } else {
      header('Location:' . $_SERVER["PHP_SELF"] . '?page=connection&auth=ko');
    }
  }  
}
?>

<!-- Connexion au site -->
<h2>Connexion au site</h2>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=connection&user=auth') ?>" method="post">
  <div>
    <label for="mailUser">Email</label>
    <input type="email" name="mailUser" id="mailUser" require>
  </div>
  <div>
    <label for="mailUser">Mot de passe</label>
    <input type="password" name="mdpUser" id="mdpUser" require>
  </div>
  <input type="text" name="csrf" token="<?= $token->getToken() ?>" hidden>
  <button type="submit">Connexion</button>

  <h3>
  <?php
    if(isset($_GET['auth'])) {
      if($_GET['auth'] == 'ok') {
        echo "Vous êtes connecté";
      }
      if ($_GET['auth'] == 'ko') {
        echo "Erreur de connexion";
      }
    }
  ?>
  </h3>
</form>