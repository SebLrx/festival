<?php
    require_once(__DIR__ . '.\..\utilitaires\BDD.php');
    
    class Represente {
        //attributs
        public $connect;
        private $table ='represente';
        
        private $idArtiste;
        private $idGenre;

        public function __construct(){
            $this->connect = new Bdd();
            $this->connect = $this->connect->getConnexion();
        }

        public function getTable(){
            return $this->table;
        }
    
        public function setTable($table){
            $this->table = $table;
        }
    
        public function getIdArtiste(){
            return $this->idArtiste;
        }
    
        public function setIdArtiste($idArtiste){
            $this->idArtiste = $idArtiste;
        }
    
        public function getIdGenre(){
            return $this->idGenre;
        }
    
        public function setIdGenre($idGenre){
            $this->idGenre = $idGenre;
        }

        public function createRepresente(){
            $myQuery = "INSERT INTO
                            $this->table
                        SET
                            idArtiste = :idArtiste,
                            idGenre = :idGenre";
            
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':idArtiste', $this->idArtiste);
            $stmt->bindParam(':idGenre', $this->idGenre);
            return $stmt->execute();
        }

        // Recupere les genres en fonction d'un artiste
        public function getArtistGenres(){
            $myQuery = "SELECT
                            nomGenre
                        FROM
                            genreMusical
                        INNER JOIN
                            $this->table 
                        ON
                            genreMusical.idGenre = $this->table.idGenre
                        WHERE
                            idArtiste = :idArtiste";
                        
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':idArtiste', $this->idArtiste);
            $stmt->execute();

            $result = $stmt->fetchAll();
            return $result;
        }

        // Recupere les artistes en fonction d'un genre
        public function getGenreArtists(){
            $myQuery = "SELECT
                            nomArtist
                        FROM
                            artist
                        INNER JOIN
                            $this->table.
                        ON
                        artist.idArtiste = '.$this->table.'.idArtiste
                        WHERE
                        idGenre = :idGenre";
                        
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':idGenre', $this->idGenre);
            return $stmt->execute();
        }

        public function readArtistes($varTri){
            $myQuery = "SELECT
                            nomArtiste,
                            nomGenre
                        FROM
                            $this->table
                        INNER JOIN
                            genremusical
                        ON
                            $this->table.idGenre = genremusical.idGenre
                        INNER JOIN
                            artiste
                        ON
                        $this->table.idArtiste = artiste.idArtiste
                        ORDER BY
                            $varTri";
                        
            $stmt = $this->connect->prepare($myQuery);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }

        // public function updateRepresente(){
        //     $myQuery = "UPDATE
        //                     '.$this->table.'
        //                 SET
        //                     idArtiste = :idArtiste,
        //                 WHERE
        //                     idArtiste = :idArtiste";
            
        //     $stmt = $this->connect->prepare($myQuery);
        //     $stmt->bindParam(':idArtiste', $this->idArtiste);
        //     return $stmt->execute();
        // }

        public function deleteRepresente(){
            $myQuery = "DELETE FROM
                            $this->table
                        WHERE
                            idArtiste = :idArtiste
                        AND
                            idGenre = :idGenre";

            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':idArtiste', $this->idArtiste);
            $stmt->bindParam(':idGenre', $this->idGenre);
            return $stmt->execute();
        }
    }
?>