<?php

require_once "classes/DataAccess.class.php";
require_once "classes/LoginException.class.php";

class Authentication
{   
    private static $instance = null;

    const LOGIN_MIN_LENGTH = 6;
    const LOGIN_MAX_LENGTH = 30;
    const PASSWORD_MIN_LENGTH = 8;
    const PASSWORD_MAX_LENGTH = 60;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Authentication();
        }
        return self::$instance;
    }

    private function __construct()
    {
        session_start();
    }

    public function processConnectionForm()
    {
        // On vérifie s'il y a un formulaire à traiter
        if (isset($_POST["login"]) && isset($_POST["password"])) {
            // On valide la taille des entrées
            // On utilise les fonctions travaillant sur les chaînes multibytes car le charset est fixé à UTF-8
            if(mb_strlen($_POST["login"]) < LOGIN_MIN_LENGTH) {
                throw new LoginException(LoginException::LOGIN_TOO_SHORT);
            }
            if(mb_strlen($_POST["login"]) > LOGIN_MAX_LENGTH) {
                throw new LoginException(LoginException::LOGIN_TOO_LONG);
            }
            if(mb_strlen($_POST["password"]) < PASSWORD_MIN_LENGTH) {
                throw new LoginException(LoginException::PASSWORD_TOO_SHORT);
            }
            if(mb_strlen($_POST["password"]) > PASSWORD_MAX_LENGTH) {
                throw new LoginException(LoginException::PASSWORD_TOO_LONG);
            }
            // On vérifie si les identifiants fournis sont valides
            if (!DataAccess::getInstance()->checkLogin($_POST["login"], $_POST["password"])) {
                throw new LoginException(LoginException::INCORRECT_INFORMATIONS);
            }
            // On valide la connexion
            $_SESSION["login"] = $_POST["login"];
            header("Location: pendu.php");
        }
        // S'il n'y a pas de formulaire à traiter on ne fait rien
    }

    public function processRegisterForm() : void
    {
        // On vérifie s'il y a un formulaire à traiter
        if (isset($_POST["login"]) && isset($_POST["password"])) {
            // On valide la taille des entrées
            // On utilise les fonctions travaillant sur les chaînes multibytes car le charset est fixé à UTF-8
            if(mb_strlen($_POST["login"]) < LOGIN_MIN_LENGTH) {
                throw new RegisterException(RegisterException::LOGIN_TOO_SHORT);
            }
            if(mb_strlen($_POST["login"]) > LOGIN_MAX_LENGTH) {
                throw new RegisterException(RegisterException::LOGIN_TOO_LONG);
            }
            if(mb_strlen($_POST["password"]) < PASSWORD_MIN_LENGTH) {
                throw new RegisterException(RegisterException::PASSWORD_TOO_SHORT);
            }
            if(mb_strlen($_POST["password"]) > PASSWORD_MAX_LENGTH) {
                throw new RegisterException(RegisterException::PASSWOR_TOO_LONG);
            }
            
            
            DataAccess::getInstance()->createUser($_POST["login"], $_POST["password"]);
            // Création OK
            echo "Création OK";
            $_SESSION["login"] = $_POST["login"];
            header("Location: pendu.php");
        }
        // S'il n'y a pas de formulaire à traiter on ne fait rien
        exit();
    }
}