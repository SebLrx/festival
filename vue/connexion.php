<?php
session_start();

require_once(__DIR__ . '\..\models\csrf.php');
require_once(__DIR__ . '\..\models\Utilisateur.php');

$token = new CSRF();
$token->generateToken();

if (isset($_GET['user']) && isset($_POST['mdpUser'])) {
  if ($_GET['user'] == 'auth') {
    if ($token->checkToken($_POST['csrf']) === false) {
      header('Location:' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?page=connection&auth=koCsrf');
    }

    // Test email and password
    if (filter_var($_POST['mailUser'], FILTER_VALIDATE_EMAIL) === false || empty($_POST['mdpUser'])) {
      header('Location:' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?page=connection&auth=mailko');
    }
  
    $user = new Utilisateur();
    $user->setMailUser(htmlspecialchars($_POST['mailUser']));
    $user->setMdpUser($_POST['mdpUser']);
    // var_dump($user->connectUser());
    if ($user->connectUser() === true) {
      $userResult = $user->readUserByMail();
      $_SESSION['id'] = $userResult[0][0];
      $_SESSION['name'] = $userResult[0][3];
      $_SESSION['surname'] = $userResult[0][4];
      $_SESSION['mail'] = $userResult[0][1];
      $_SESSION['adress'] = $userResult[0][2];
      header('Location:' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?page=connection&auth=ok');
    } else {
      header('Location:' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?page=connection&auth=passwordko');
    }
  }  
}

if(isset($_POST['deconnexion'])) {
  session_destroy();
  session_unset();
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
    <label for="mdpUser">Mot de passe</label>
    <input type="password" name="mdpUser" id="mdpUser" require>
  </div>
  <input type="text" name="csrf" value="<?= $token->getToken() ?>" hidden>
  <button type="submit">Connexion</button>

  <h3>
  <?php
    if(isset($_GET['auth'])) {
      if(htmlspecialchars($_GET['auth']) == 'ok') {
        echo "Vous êtes connecté";
      }
      if (htmlspecialchars($_GET['auth']) == 'ko') {
        echo "Erreur de connexion";
      }
    }
    if(isset($_SESSION['id'])) {
  ?>
      <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=connection') ?>" method="post">
        <button type="submit" id="deconnexion" name="deconnexion">Se déconnecter</button>
      </form>
  <?php
    }
  ?>
  </h3>
</form>