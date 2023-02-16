<?php
session_start();

require_once(__DIR__ . '\..\models\csrf.php');
require_once(__DIR__ . '\..\models\Utilisateur.php');

$token = new CSRF();
$token->generateToken();

$user = new Utilisateur();

if(isset($_GET["method"])) {
    if($_GET["method"] === "update") {
        $user->setIdUser($_SESSION['id']);
        $user->setNomUser(htmlspecialchars($_SESSION['name']));
        $user->setPrenomUser(htmlspecialchars($_SESSION['surname']));
        $user->setAdresseUser(htmlspecialchars($_SESSION['adress']));
        $user->setMailUser(htmlspecialchars($_SESSION['mail']));
        $user->setMdpUser($user->getPasswordById()[0][0]);

        switch($_GET["field"]) {
            case 'name':
                $user->setNomUser(htmlspecialchars($_POST["name"]));
                break;
            case 'surname':
                $user->setPrenomUser(htmlspecialchars($_POST["surname"]));
                break;
            case 'adress':
                $user->setAdresseUser(htmlspecialchars($_POST["adress"]));
                break;
            case 'mail':
                $user->setMailUser(htmlspecialchars($_POST["mail"]));
                break;
            case 'password':
                $user->setMdpUser(htmlspecialchars($_POST["actualMDP"]));
                if($user->verifyPasswordById() === true) {
                    if($_POST["newMDP"] != $_POST["confNewMDP"]) {
                        header('Location:' . htmlspecialchars($_SERVER['PHP_SELF']) . '?page=profil&method=update&field=password&success=false');
                    } else {
                        $user->setMdpUser(htmlspecialchars($_POST["newMDP"]));
                    }
                }
                break;
            default:
                header('Location:' . htmlspecialchars($_SERVER['PHP_SELF']) . '?page=profil&success=false');
        }

        if($user->updateUser() === true) {
            switch(htmlspecialchars($_GET["field"])) {
                case 'name':
                    $_SESSION['name'] = $user->getNomUser();
                    break;
                case 'surname':
                    $_SESSION['surname'] = $user->getPrenomUser();
                    break;
                case 'adress':
                    $_SESSION['adress'] = $user->getAdresseUser();
                    break;
                case 'mail':
                    $_SESSION['mail'] = $user->getMailUser();
                    break;
            }
            //header('Location:' . htmlspecialchars($_SERVER['PHP_SELF']) . '?page=profil&method=update&success=true');
        }
    } else if(htmlspecialchars($_GET["method"]) === "delete") {
        $user->setIdUser($_SESSION['id']);
        $user->setMdpUser($_POST["delete"]);
        var_dump($user->confirmDelete());
        
        if($user->confirmDelete() === true) {
            $user->deleteUser();
            session_destroy();
            session_unset();
            header('Location:' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?page=connection');
        } else {
            echo "mauvais mot de passe";
        }
    }
}

if(isset($_SESSION['id'])) {
?>
    <h2>Mon profil</h2>
    <br>
<?php
    if(isset($_GET["success"])) {
        if ($_GET["success"] == "true") {
?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative my-2" role="alert">
                <strong class="font-bold">informations mises à jour avec succès</strong>
            </div>
<?php 
        }
    }
?>
    <br>
    <p>Nom : <?=$_SESSION['name']?></p>
<?php
    if(isset($_POST['modifyName'])) {
?>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=profil&method=update&field=name') ?>" method="POST">
        <div>
            <input type="text" name="name" id="name" require>
            <button type="submit">Valider</button>
        </div>
    </form>
<?php
    } else {
?>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=profil') ?>" method="post">
        <button type="submit" id="modifyName" name="modifyName">Modifier</button>
    </form>
<?php
    }
?>
    <p>Prenom : <?=$_SESSION['surname']?></p>
<?php
    if(isset($_POST['modifySurname'])) {
?>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=profil&method=update&field=surname') ?>" method="POST">
            <div>
                <input type="text" name="surname" id="surname" require>
                <button type="submit">Valider</button>
            </div>
        </form>
<?php
    } else {
?>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=profil') ?>" method="post">
        <button type="submit" id="modifySurname" name="modifySurname">Modifier</button>
    </form>
<?php
    }
?>
    <p>Adresse : <?=$_SESSION["adress"]?></p>
<?php
    if(isset($_POST['modifyAdress'])) {
?>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=profil&method=update&field=adress') ?>" method="POST">
            <div>
                <input type="text" name="adress" id="adress" require>
                <button type="submit">Valider</button>
            </div>
        </form>
<?php
    } else {
?>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=profil') ?>" method="post">
        <button type="submit" id="modifyAdress" name="modifyAdress">Modifier</button>
    </form>
<?php
    }
?>
    <p>Email : <?= $_SESSION["mail"]?></p>
<?php
    if(isset($_POST['modifyMail'])) {
?>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=profil&method=update&field=mail') ?>" method="POST">
            <div>
                <input type="text" name="mail" id="mail" require>
                <button type="submit">Valider</button>
            </div>
        </form>
<?php
    } else {
?>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=profil') ?>" method="post">
        <button type="submit" id="modifyMail" name="modifyMail">Modifier</button>
    </form>
<?php
    }
?>
    <?php
    if(isset($_POST['modifyMDP'])) {
?>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=profil&method=update&field=password') ?>" method="POST">
            <div>
                <label for="actualMDP">Mot de passe actuel :</label>
                <input type="text" name="actualMDP" id="actualMDP" require>
            </div>
            <div>
                <label for="newMDP">Nouveau mot de passe :</label>
                <input type="text" name="newMDP" id="newMDP" require>
            </div>
            <div>
                <label for="confNewMDP">Confirmer le nouveau mot de passe :</label>
                <input type="text" name="confNewMDP" id="confNewMDP" require>
            <div>
            </div>
                <button type="submit">Valider</button>
            </div>
        </form>
<?php
    } else {
?>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=profil') ?>" method="post">
        <button type="submit" id="modifyMDP" name="modifyMDP">Changer le mot de passe</button>
    </form>
<?php
    }
?>
<?php
    if(isset($_POST['deleteAccount'])) {
?>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=profil&method=delete&field=delete') ?>" method="POST">
            <div>
                <label for="delete">Confirmer avec votre mot de passe :</label>
                <input type="text" name="delete" id="delete" require>
                <button type="submit">Valider</button>
            </div>
        </form>
<?php
    } else {
?>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=profil') ?>" method="post">
        <button type="submit" id="deleteAccount" name="deleteAccount">Supprimer son compte</button>
    </form>
<?php
    }
} else {
?>
    <a href="http://localhost/festival/index.php?page=connection">Veuillez vous connecter en cliquant ici</a>
<?php
}
?>