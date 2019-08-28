<?php

namespace App\Controller;

use App\Controller\DefaultController;
use App\Entity\User;
use App\Exception\AuthenticationException as AuthException;
use App\Service\UserAuthenticator;

class AuthenticationController extends DefaultController
{

    // Methods
    public function checkLogin(): void
    {
        // Cheking if there is a form to process
        if (isset($_POST["login"]) && isset($_POST["password"])) {
            $authService = new UserAuthenticator;
            $loginResponse = $authService->login(
                $_POST["login"],
                $_POST["password"]
            );
            // If success, redirect to home page
            if (isset($loginResponse["error"]) && !$loginResponse["error"]) {
                header("Location: home");
            } else {
                echo $this->twig->render(
                    "authentication/connection.html.twig",
                    ["error" => $loginResponse]
                );
            }
        } else { // First time on page or not all informations given
            echo $this->twig->render(
                "authentication/connection.html.twig"
            );
        }
    }

    public function logout(): void
    {
        UserAuthenticator::logout();
    }

    public function checkRegister(): void
    {
        // Cheking if there is a form to process
        if (isset($_POST["login"]) &&
            isset($_POST["password"]) &&
            isset($_POST["email"]) &&
            isset($_POST["first_name"]) &&
            isset($_POST["last_name"])
        ) {
            // Puting the values in variable to heal readability
            $login = $_POST["login"];
            $password = $_POST["password"];
            $email = strtolower($_POST["email"]);
            $firstName = $_POST["first_name"];
            $lastName = $_POST["last_name"];

            var_dump($login);
            try {
                // Validating all inputs length
                // Using multibyte function (mb) since we are working with UTF-8
                if (mb_strlen($login) < User::DB_TABLE_LOGIN["minlength"] ||
                    mb_strlen($login) > User::DB_TABLE_LOGIN["maxlength"]) {
                    throw new AuthException(
                        AuthException::LOGIN_LENGTH_NOT_VALID
                    );
                } elseif (
                    mb_strlen($password) < User::DB_TABLE_PASSWORD["minlength"] ||
                    mb_strlen($password) > User::DB_TABLE_PASSWORD["maxlength"]) {
                    throw new AuthException(
                        AuthException::PASSWORD_LENGTH_NOT_VALID
                    );
                } elseif (
                    mb_strlen($email) < User::DB_TABLE_EMAIL["minlength"] ||
                    mb_strlen($email) > User::DB_TABLE_EMAIL["maxlength"]) {
                    throw new AuthException(
                        AuthException::EMAIL_LENGTH_NOT_VALID
                    );
                } elseif (
                    mb_strlen($firstName) < User::DB_TABLE_FIRST_NAME["minlength"] ||
                    mb_strlen($firstName) > User::DB_TABLE_FIRST_NAME["maxlength"]) {
                    throw new AuthException(
                        AuthException::FIRST_NAME_LENGTH_NOT_VALID
                    );
                } elseif (
                    mb_strlen($lastName) < User::DB_TABLE_LAST_NAME["minlength"] ||
                    mb_strlen($lastName) > User::DB_TABLE_LAST_NAME["maxlength"]) {
                    throw new AuthException(
                        AuthException::LAST_NAME_LENGTH_NOT_VALID
                    );
                }

                // Checking if the inputs contains only alphanumeric characters (Excepted the password for strength reasons)
                if (!preg_match("/^[a-zA-Z0-9]+$/", $login)) {
                    throw new AuthException(AuthException::LOGIN_NOT_VALID);
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Checking if the email respect the Internet Engineering Task Force RFC 822 syntax
                    throw new AuthException(AuthException::EMAIL_NOT_VALID);
                } elseif (!preg_match("/^[a-zA-Z0-9]+$/", $firstName)) {
                    throw new AuthException(AuthException::FIST_NAME_NOT_VALID);
                } elseif (!preg_match("/^[a-zA-Z0-9]+$/", $lastName)) {
                    throw new AuthException(AuthException::LAST_NAME_NOT_VALID);
                }

                // Catching and displaying the errors
            } catch (AuthException $error) {
                $registerError["error"] = true;
                $registerError["errorMessage"] = "Erreur: " . $error->getMessage();
                // Stays on the same route and regenerate the page displaying the error(s)
                echo $this->twig->render(
                    "authentication/register.html.twig",
                    ["error" => $registerError]
                );
                exit;
            }

            // No error caught, can generate a request to the DB
            $authService = new UserAuthenticator;
            $registerResponse = $authService->register(
                $login,
                $password,
                $email,
                $firstName,
                $lastName
            );

            // If request successful, redirect to home page
            if (isset($registerResponse["error"]) && !$registerResponse["error"]) {
                header("Location: home");
            } elseif (isset($registerResponse["error"]) && $registerResponse["error"]) { // Error detected
                echo $this->twig->render(
                    "authentication/register.html.twig",
                    ["error" => $registerResponse]
                );
            }
        } else {
            // First time on page or not all informations given
            echo $this->twig->render(
                "authentication/register.html.twig"
            );
        }
    }
}
