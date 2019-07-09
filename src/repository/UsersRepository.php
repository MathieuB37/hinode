<?php

namespace App\Repository;

use App\Repository\DefaultRepository;
use App\Controller\exception\AuthenticationException as AuthException;

class UsersRepository extends DefaultRepository
{
    public function createUser(string $login, string $password)
    {
        try {
            $request = $this->dataBase->prepare("INSERT INTO user (login, 
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
}
