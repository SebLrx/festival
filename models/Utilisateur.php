<?php
require_once(__DIR__ . '.\..\utilitaires\BDD.php');

class Utilisateur
{
    //attributs
    public $connect;
    private $table = 'utilisateur';

    private int $idUser;
    private string $mailUser;
    private string $mdpUser;
    private string $adresseUser;
    private string $nomUser;
    private string $prenomUser;
    private int $idRole;

    public function __construct()
    {
        $this->connect = BDD::getConnexion();
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function setTable(string $table): void
    {
        $this->table = $table;
    }

    public function getIdUser(): int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    public function getMailUser(): string
    {
        return $this->mailUser;
    }

    public function setMailUser(string $mailUser)
    {
        $this->mailUser = $mailUser;
    }

    public function getMdpUser(): string
    {
        return $this->mdpUser;
    }

    public function setMdpUser(string $mdpUser): void
    {
        $this->mdpUser = $mdpUser;
    }

    public function getNomUser(): string
    {
        return $this->nomUser;
    }

    public function setNomUser(string  $nomUser): void
    {
        $this->nomUser = $nomUser;
    }

    public function getPrenomUser(): string
    {
        return $this->prenomUser;
    }

    public function setPrenomUser(string $prenomUser): void
    {
        $this->prenomUser = $prenomUser;
    }

    public function getAdresseUser(): string
    {
        return $this->adresseUser;
    }

    public function setAdresseUser(string $adresseUser): void
    {
        $this->adresseUser = $adresseUser;
    }

    public function getIdRole(): int
    {
        return $this->idRole;
    }

    public function setIdRole(int $idRole): void
    {
        $this->idRole = $idRole;
    }

    public function createUser(): bool
    {
        $myQuery = "INSERT INTO
                        utilisateur
                    SET
                        mailUser = :mailUser,
                        mdpUser = :mdpUser,
                        adresseUser = :adresseUser,
                        nomUser = :nomUser,
                        prenomUser = :prenomUser,
                        idRole = :idRole";

        $stmt = $this->connect->prepare($myQuery);

        $password = password_hash($this->mdpUser, PASSWORD_BCRYPT);

        $stmt->bindParam(':mailUser', $this->mailUser);
        $stmt->bindParam(':mdpUser', $password);
        $stmt->bindParam(':adresseUser', $this->adresseUser);
        $stmt->bindParam(':nomUser', $this->nomUser);
        $stmt->bindParam(':prenomUser', $this->prenomUser);
        $stmt->bindParam(':idRole', $this->idRole);

        return $stmt->execute();
    }

    public function readUserById(): bool
    {
        $myQuery = "SELECT
                        *
                    FROM
                        utilisateur
                    WHERE
                        idUser = :idUser";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idUser', $this->idUser);

        return $stmt->execute();
    }

    public function readUserByMail(): array
    {
        $myQuery = "SELECT
                        idUser, mailUser, adresseUser, nomUser, prenomUser
                    FROM
                        utilisateur
                    WHERE
                        mailUser = :mailUser
                    LIMIT 1";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':mailUser', $this->mailUser);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    //permet de récupérer si un utilisateur existe déjà via son mail
    public function checkUserMail(): array
    {
        $myQuery = "SELECT 
                        COUNT(*)
                    FROM
                        utilisateur
                    WHERE
                        mailUser = :mailUser";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':mailUser', $this->mailUser);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function getPasswordById(): array
    {
        $myQuery = "SELECT
                        mdpUser
                    FROM
                        utilisateur
                    WHERE
                        idUser = :idUser
                    LIMIT 1";
        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idUser', $this->idUser);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function verifyPasswordById(): bool
    {
        $myQuery = "SELECT
                        mdpUser
                    FROM
                        utilisateur
                    WHERE
                        idUser = :idUser
                    LIMIT 1";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idUser', $this->idUser);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($this->getMdpUser(), $row['mdpUser'])) {
            return true;
        } else {
            return false;
        }
    }

    public function connectUser(): bool
    {
        $myQuery = "SELECT
                        `idUser`, `mailUser`, `mdpUser`
                    FROM
                        `$this->table`
                    WHERE
                        mailUser = :mailUser";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':mailUser', $this->mailUser);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($this->getMdpUser(), $row['mdpUser'])) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUser(): bool
    {
        $myQuery = "UPDATE
                        utilisateur
                    SET
                        mailUser = :mailUser,
                        adresseUser = :adresseUser,
                        nomUser = :nomUser,
                        prenomUser = :prenomUser
                    WHERE
                        idUser = :idUser";

        $stmt = $this->connect->prepare($myQuery);

        $stmt->bindParam(':mailUser', $this->mailUser);
        $stmt->bindParam(':adresseUser', $this->adresseUser);
        $stmt->bindParam(':nomUser', $this->nomUser);
        $stmt->bindParam(':prenomUser', $this->prenomUser);
        $stmt->bindParam(':idUser', $this->idUser);

        return $stmt->execute();
    }

    public function updatePassword(): bool
    {
        $myQuery = "UPDATE
                        utilisateur
                    SET
                        mdpUser = :mdpUser
                    WHERE
                        idUser = :idUser";

        $stmt = $this->connect->prepare($myQuery);

        $password = password_hash($this->mdpUser, PASSWORD_BCRYPT);
        $stmt->bindParam(':mdpUser', $password);
        $stmt->bindParam(':idUser', $this->idUser);

        return $stmt->execute();
    }

    public function confirmDelete(): bool
    {
        $myQuery = "SELECT
                        mdpUser
                    FROM
                        $this->table
                    WHERE
                        idUser = :idUser";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idUser', $this->idUser);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($this->getMdpUser(), $row['mdpUser']) === true) {
            return true;
        }
        return false;
    }

    public function deleteUser(): bool
    {
        $myQuery = "DELETE FROM
                        utilisateur
                    WHERE
                        idUser = :idUser";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idUser', $this->idUser);

        return $stmt->execute();
    }
}
