<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UsersRepository;


class UserAuthenticator
{   
    private $repository;

    // Request verifying Login & Password
    public function checkLogin(string $login, string $password): array
    {
        // Getting the user with this login
        $this->repository = new UsersRepository;
        $user = $this->repository->getUserByLogin($login);
        // Checking if the 2 passwords match
        if (password_verify($password, $user->getPassword())) {
            // Passwords did matche = Granting access
            $_SESSION["user_id"] = $user->getId();
            $_SESSION["user_login"] = $user->getLogin();
            return ["error" => false];
        } else {
            // Error, passwords did not match 
            //TODO: HOWTO: Redirect to the login page (with error message)
            echo "Identifiant ou mot de passe non reconnu";
            return [
                "error" => true, 
                "errorMessage" => "message"
            ]; 
        }
        // Login and password didn't match
        // throw new AuthException(AuthException::INFORMATIONS_NOT_VALID);
    }
    public function logout()
    {
        session_destroy();
        header("Location: home");
    }
}
