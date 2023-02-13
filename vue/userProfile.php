<?php
session_start();

require_once(__DIR__ . '\..\models\csrf.php');
require_once(__DIR__ . '\..\models\Utilisateur.php');

$token = new CSRF();
$token->generateToken();

if(isset($_SESSION['id'])) {
?>
    <h2>Mon profil</h2>
    <br>
    <p>Nom :<?$_SESSION['name']?></p>
    <p>Prenom :<?$_SESSION['surname']?></p>
    <p>Adresse :<?$_SESSION["adress"]?></p>
    <p>Email :<?$_SESSION["mail"]?></p>
    <p>Mot de passe :</p>
<?php
} else {
?>
    <a href="http://localhost/festival/index.php?page=connection">Veuillez vous connecter en cliquant ici</a>
<?php
}
?>