<?php
class Role
{
    //attributs
    public $connect;
    private string $table = 'role';

    private int $idRole;
    private string $nomRole;

    public function __construct()
    {
        $this->connect = BDD::getConnexion();
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function setTable(string $table)
    {
        $this->table = $table;
    }

    public function getIdRole(): int
    {
        return $this->idRole;
    }

    public function setIdRole(int $idRole)
    {
        $this->idRole = $idRole;
    }

    public function getNomRole(): string
    {
        return $this->nomRole;
    }

    public function setNomRole(string $nomRole)
    {
        $this->nomRole = $nomRole;
    }
}
