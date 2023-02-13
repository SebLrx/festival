<?php

/**
 * Permet de charger les classes sans utiliser explicitement require(), require_once()
 * include()ou include_once()
 * Vous devez nommer vos fichiers PHP du même nom que la classe
 * Exemples : Classe Utilisateur dans fichier Utilisateur.php
 *            Classe UtilisateurDAO dans fichier UtilisateurDAO.php
 */
define('BASE_PATH', realpath(dirname(__FILE__)));

class Autoloader {
    static public function loader($className) {
        $filename = BASE_PATH.DIRECTORY_SEPARATOR.str_replace("\\", DIRECTORY_SEPARATOR, $className) . ".php";
        
        if (file_exists($filename)) {
            //echo $filename.PHP_EOL;
            include($filename);
            if (class_exists($className)) {
                return TRUE;
            }
        }
        return FALSE;
    }
}
spl_autoload_register('Autoloader::loader');
