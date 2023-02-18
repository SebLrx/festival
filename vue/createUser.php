<?php
session_start();

require_once(__DIR__ . '\..\models\csrf.php');
require_once(__DIR__ . '\..\models\Utilisateur.php');

$token = new CSRF();
$token->generateToken();

if (isset($_GET['user'])) {
  if ($_GET['user'] == 'newUser') {
    if ($token->checkToken(htmlspecialchars($_POST['csrf'])) === false) {
      header('Location:' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?page=connection&auth=ko');
    }

    // Test email and password
    if (filter_var($_POST['mailUser'], FILTER_VALIDATE_EMAIL) === false || empty($_POST['mdpUser'])) {
      header('Location:' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?page=createUser&newUser=ko');
    }

    $user = new Utilisateur();
    $user->setNomUser(htmlspecialchars($_POST['nameUser']));
    $user->setPrenomUser(htmlspecialchars($_POST['surnameUser']));
    $user->setAdresseUser(htmlspecialchars($_POST['adressUser']));
    $user->setMailUser(htmlspecialchars($_POST['mailUser']));
    $result = $user->checkUserMail();

    if ($result != 0) {
      echo "Email déjà utilisé";
      exit;
    }
    if ($_POST['mdpUser'] === $_POST['confimMdpUser']) {
      $user->setMdpUser($_POST['mdpUser']);
    } else {
      echo "mots de passe différents";
      exit;
    }
    $user->setIdRole($_POST['role']);

    if ($user->createUser() === true) {
      header('Location:' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?page=createUser&newUser=ok');
    } else {
      header('Location:' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?page=createUser&newUser=ko');
    }
  }
}
?>

<!-- Connexion au site -->
<h2>Créer un nouveau compte</h2>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=createUser&user=newUser') ?>" method="POST">
  <div>
    <label for="nameUser">Nom</label>
    <input type="text" name="nameUser" id="nameUser" require>
  </div>
  <div>
    <label for="surnameUser">Prenom</label>
    <input type="text" name="surnameUser" id="surnameUser" require>
  </div>
  <div>
    <label for="adressUser">Adresse</label>
    <input type="text" name="adressUser" id="adressUser" require>
  </div>
  <div>
    <label for="mailUser">Email</label>
    <input type="email" name="mailUser" id="mailUser" require>
  </div>
  <div>
    <label for="mdpUser">Mot de passe</label>
    <input type="password" name="mdpUser" id="mdpUser" minlength="8" require>
  </div>
  <div>
    <label for="confimMdpUser">Confirmez le mot de passe</label>
    <input type="password" name="confimMdpUser" id="confimMdpUser" min="8" require>
  </div>
  <div>
    <label for="role">Role</label>
    <select name="role" id="role">
      <option value=1>Utilisateur</option>
      <option value=3>Artiste</option>
    </select>
  </div>
  <input type="text" name="csrf" token="<?= $token->getToken() ?>" hidden>
  <button type="submit">Créer compte</button>

  <h3>
    <?php
    if (isset($_GET['newUser'])) {
      if (htmlspecialchars($_GET['newUser']) == 'ok') {
        echo "Compte créé avec succès";
      }
      if (htmlspecialchars($_GET['newUser']) == 'ko') {
        echo "Erreur lors de la création de compte";
      }
    }
    ?>
  </h3>
</form>