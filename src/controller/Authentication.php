<?php

namespace App\controller;

use App\model\DataAccess;
use App\exception\AuthenticationException;

class Authentication
{   
    // The instance of the class
    private static $instance = null;
    // Class constants
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
        // Checking if there is a from to validate
        if (isset($_POST["login"]) && isset($_POST["password"])) {
            // Validating input length
            // Using multibyte function (mb) since we are working with UTF-8
            if (mb_strlen($_POST["login"]) < LOGIN_MIN_LENGTH || mb_strlen($_POST["login"]) > LOGIN_MAX_LENGTH) {
                throw new AuthenticationException(AuthenticationException::LOGIN_LENGTH_NOT_VALID);
            }
            if (mb_strlen($_POST["password"]) < PASSWORD_MIN_LENGTH || mb_strlen($_POST["password"]) > PASSWORD_MAX_LENGTH) {
                throw new AuthenticationException(AuthenticationException::PASSWORD_LENGTH_NOT_VALID);
            }
            // Checking if the login contains only alphanumeric characters
            if (!preg_match("[a-zA-Z0-9]+", [$_POST["login"]])) {
                throw new AuthenticationException(AuthenticationException::LOGIN_NOT_VALID);
            }
            // Checking if the couple login & password is valid
            if (!DataAccess::getInstance()->checkLogin($_POST["login"], $_POST["password"])) {
                throw new AuthenticationException(AuthenticationException::INFORMATIONS_NOT_VALID);
            }
            // Validating the connection
            $_SESSION["login"] = $_POST["login"];
            // Redirecting to the homepage //?TODO: Redirecting to the private page the person attempted go to
            header("Location: index.php/home");
        }
        // Doing nothin if there is no form
    }

    public function processRegisterForm() : void
    {
        // Checking if there is a form to validate
        if (isset($_POST["login"]) && isset($_POST["password"])) {
            // Validating input length
            // Using multibyte function (mb) since we are working with UTF-8
            if (mb_strlen($_POST["login"]) < LOGIN_MIN_LENGTH || mb_strlen($_POST["login"]) > LOGIN_MAX_LENGTH) {
                throw new AuthenticationException(AuthenticationException::LOGIN_LENGTH_NOT_VALID);
            }
            if (mb_strlen($_POST["password"]) < PASSWORD_MIN_LENGTH || mb_strlen($_POST["password"]) > PASSWORD_MAX_LENGTH) {
                throw new AuthenticationException(AuthenticationException::PASSWORD_LENGTH_NOT_VALID);
            }
            // Checking if the login contains only alphanumeric characters
            if (!preg_match("[a-zA-Z0-9]+", [$_POST["login"]])) {
                throw new AuthenticationException(AuthenticationException::LOGIN_NOT_VALID);
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