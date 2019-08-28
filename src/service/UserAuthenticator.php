<?php

namespace App\Service;

use App\Exception\AuthenticationException as AuthException;
use App\Repository\UsersRepository;

class UserAuthenticator
{
    private $repository;

    // Request verifying Login & Password
    public function login(string $login, string $password): array
    {
        // Getting the user with this login
        $this->repository = new UsersRepository;
        $userFound = $this->repository->getUserByLogin($login);
        // Checking if the user has been found
        if (!$userFound["error"] && isset($userFound["result"])) {
            $user = $userFound["result"];
            // Checking if the 2 passwords match
            if (password_verify($password, $user->getPassword())) {
                // Passwords did matche = Granting access
                $_SESSION["user_id"] = $user->getId();
                $_SESSION["user_login"] = $user->getLogin();
                return ["error" => false];
            } else { // Error, passwords did not match
                $error = [
                    "error" => true,
                    "errorMessage" => AuthException::INFORMATIONS_NOT_VALID,
                ];
            }
        } else {
            // Error, user not found with the provided login
            if ($userFound["error"] && isset($userFound["errorMessage"])) {
                return $userFound;
            }
        }
        // Default error
        return [
            "error" => true,
            "errorMessage" => AuthException::INFORMATIONS_NOT_VALID,
        ];
    }
    public function logout()
    {
        session_destroy();
        header("Location: home");
    }

    public function register(
        string $login,
        string $password,
        string $email,
        string $firstName,
        string $lastName
    ) {
        $this->repository = new UsersRepository;
        $user = $this->repository->createUser(
            $login,
            $password,
            $email,
            $firstName,
            $lastName
        );
        return $user;
    }
}
