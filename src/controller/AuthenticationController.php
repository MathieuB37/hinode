<?php

namespace App\Controller;

use App\Controller\DefaultController;
use App\Exception\AuthenticationException as AuthException;

class AuthenticationController extends DefaultController
{
    // Parameters for login & password min/max length
    const LOGIN_MIN_LENGTH = 6;
    const LOGIN_MAX_LENGTH = 30;
    const PASSWORD_MIN_LENGTH = 8;
    const PASSWORD_MAX_LENGTH = 60;

    // Atributes
    private $errorList = [];

    // Methods
    public function checkLogin() : void
    {
        // Cheking if there is a form to process
        if (isset($_POST["login"]) && isset($_POST["password"])) {
            try {
                // Checking if the couple login & password matches
                if ($this->dataBase->getInstance()->checkLogin($_POST["login"], $_POST["password"])) {
                    // Granting access
                    //TODO: Prendre ID 
                    $_SESSION["login"] = $_POST["login"];
                    header("Location: article/2");
                    exit;
                } else {
                    // Login and password didn't match
                    throw new AuthException(AuthException::INFORMATIONS_NOT_VALID);
                }
            }
            // Catching the error and adding it to the error list
            catch (AuthException $error) {
                array_push($this->errorList, "Erreur: " . $error->getMessage());
                // Stays on the same route and regenerate the page with a display of the error(s)
                echo $this->twig->render(
                    "authentication/connection.html.twig", 
                    ["errorList" => $this->errorList]
                );
            }
        } else {
            // No informations given (or first time on the page), we display the empty form
            unset($this->login);
            echo $this->twig->render("authentication/connection.html.twig");
        }
    }

    public function checkRegister() : void
    {
        // Cheking if there is a form to process
        if (isset($_POST["login"]) && isset($_POST["password"])) {
            // Validating input length
            // Using multibyte function (mb) since we are working with UTF-8
            if (mb_strlen($_POST["login"]) < self::LOGIN_MIN_LENGTH || 
                mb_strlen($_POST["login"]) > self::LOGIN_MAX_LENGTH) 
            {
                throw new AuthException(AuthException::LOGIN_LENGTH_NOT_VALID);
            }
            if (mb_strlen($_POST["password"]) < self::PASSWORD_MIN_LENGTH || 
                mb_strlen($_POST["password"]) > self::PASSWORD_MAX_LENGTH) 
            {
                throw new AuthException(AuthException::PASSWORD_LENGTH_NOT_VALID);
            }
            // Checking if the login contains only alphanumeric characters
            if (!preg_match("[a-zA-Z0-9]+", $_POST["login"])) {
                throw new AuthException(AuthException::LOGIN_NOT_VALID);
            }
            try {
                if ($this->dataBase->createUser($_POST["login"], $_POST["password"])) {
                    // Création OK
                    echo "Création OK";
                    $_SESSION["login"] = $this->login;
                    header("Location: article/1");    
                }
            // Catching the error and adding it to the error list
            } catch (AuthException $error){
                array_push($this->registerError, "Erreur: " . $error->getMessage());
                // Stays on the same route and regenerate the page displaying the error(s)
                echo $this->twig->render(
                    "authentication/connection.html.twig", 
                    ["loginError" => $this->loginError]
                );
            }   
        } else {
            // No informations given (or first time on the page), we display the form
            echo $this->twig->render("authentication/register.html.twig");
        }
    }
    
}