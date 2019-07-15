<?php

namespace App\Repository;

use App\Repository\DefaultRepository;
use App\Controller\exception\AuthenticationException as AuthException;
use App\Entity\User;

class UsersRepository extends DefaultRepository
{
    public function createUser(string $login, string $password)
    {
        try {
            $request = $this->dataBase->getPDO()->prepare("INSERT INTO user (login, 
                                                password, 
                                                email, 
                                                first_name, 
                                                last_name) 
                                                VALUES (:login, 
                                                :password, 
                                                :email, 
                                                :first_name, 
                                                :last_name)"
                                                );
        } catch (PDOException $erreur) {
            echo "Request Failed";
            exit;
        }
        if (!$request->bindValue(":login",$login, \PDO::PARAM_STR) ||
            !$request->bindValue(":password",password_hash($password, 
                                                            PASSWORD_DEFAULT), 
                                                            PDO::PARAM_STR)) 
        {
            echo "Request Failed";
            exit();
        }
        if (!$request->execute()) {
            // Si le login est déjà dans la base
            if ($request->errorInfo()[0] === '23000') {
                throw new AuthException(AuthException::LOGIN_ALREADY_USED);
            } else {
                echo "Request Failed";
                exit;
            }
        }
        if ($request->closeCursor() === false) {
            echo "Error while closing the request";
        }
    }

    public function getUserByLogin(string $login): array
    {
        //TODO: Do something if an error happens for each steps
        $request =  "SELECT id, login, password FROM users WHERE login=:login";
        try {
            $preparedRequest = $this->dataBase->getPDO()->prepare($request);
        } catch(PDOException $error) {
            $errorMessage = 'Problème lors de votre connexion, veuillez ré-essayer.';
        }

        if (!isset($errorMessage)) {
            if (!$preparedRequest->bindValue(":login", $login, \PDO::PARAM_STR)) {
                // Request Failed
                $errorMessage = 'Problème lors de votre connexion, veuillez ré-essayer.';
            } elseif (!$preparedRequest->execute()) {
                // Request Failed
                $errorMessage = 'Problème lors de votre connexion, veuillez ré-essayer.';
            } else {
                $user = $preparedRequest->fetch(\PDO::FETCH_ASSOC);
                if (!$preparedRequest->closeCursor()) {
                    $errorMessage = 'Problème lors de votre connexion, veuillez ré-essayer.';
                }
                if (!$user) {
                    // error, login not found in DB
                    //TODO: Redirect to the login page (with error message)
                    $errorMessage = "Identifiant ou mot de passe non reconnu";
                }
            }
        }
        
        if (isset($errorMessage)) {
            return [
                "error" => true,
                "errorMessage" => $errorMessage,
            ];
        } else {
            return $user;
        }
    }
}
