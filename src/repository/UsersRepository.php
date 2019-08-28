<?php

namespace App\Repository;

use App\Entity\User;
use App\Exception\AuthenticationException as AuthException;
use App\Repository\DefaultRepository;

class UsersRepository extends DefaultRepository
{
    // Get the users "essentials" informations from his login (id, login(if it matches) and hashed password)
    public function getUserByLogin(string $login): array
    {
        //TODO: Do something if an error happens for each steps
        $request = "SELECT * FROM users WHERE " .
        USER::DB_TABLE_LOGIN['name'] .
            " = :login"
        ;
        try {
            $preparedRequest = $this->dataBase->getPDO()->prepare($request);
            if (!$preparedRequest->bindValue(":login", $login, \PDO::PARAM_STR)) {
                // Request Failed
                throw new AuthException(AuthException::LOGIN_ERROR);
            }
            var_dump($preparedRequest);
            if (!$preparedRequest->execute()) {
                // Request Failed
                throw new AuthException(AuthException::LOGIN_ERROR);
            } else { // Request worked
                $user = $preparedRequest->fetch(\PDO::FETCH_ASSOC);
                if (!$preparedRequest->closeCursor()) {
                    throw new AuthException(AuthException::LOGIN_ERROR);
                }
                if (!$user) {
                    // Error, login not found in DB
                    throw new AuthException(AuthException::LOGIN_NOT_FOUND);
                }
            }
            // Redirect to the login page (with error message)
        } catch (AuthException $error) {
            return [
                "error" => true,
                "errorMessage" => $error->getMessage(),
            ];
        }
        // Found a valid user, filling a User entity
        $validUser = new User;
        $validUser->setId(intval($user[USER::DB_TABLE_ID['name']]));
        $validUser->setLogin($user[USER::DB_TABLE_LOGIN['name']]);
        $validUser->setPassword($user[USER::DB_TABLE_PASSWORD['name']]);
        $validUser->setEmail($user[USER::DB_TABLE_EMAIL['name']]);
        $validUser->setFirstName($user[USER::DB_TABLE_FIRST_NAME['name']]);
        $validUser->setLastName($user[USER::DB_TABLE_LAST_NAME['name']]);

        var_dump($validUser);
        return [
            "error" => false,
            "result" => $validUser,
        ];
    }

    public function createUser(
        string $login,
        string $password,
        string $email,
        string $firstName,
        string $lastName
    ): array{
        // Attenpting to prepare the request
        try {
            $request = $this->dataBase->getPDO()->prepare(
                "INSERT INTO users (" .
                USER::DB_TABLE_LOGIN['name'] . ", " .
                USER::DB_TABLE_PASSWORD['name'] . ", " .
                USER::DB_TABLE_EMAIL['name'] . ", " .
                USER::DB_TABLE_FIRST_NAME['name'] . ", " .
                USER::DB_TABLE_LAST_NAME['name'] .
                ") VALUES (
                    :login,
                    :password,
                    :email,
                    :first_name,
                    :last_name)"
            );
            // Binding values in order to avoid SQL injection + Hashing the password (current PASSWORD_DEFAULT: Bcrypt)
            if (!$request->bindValue(":login", $login, \PDO::PARAM_STR) ||
                !$request->bindValue(":email", $email, \PDO::PARAM_STR) ||
                !$request->bindValue(":first_name", $firstName, \PDO::PARAM_STR) ||
                !$request->bindValue(":last_name", $lastName, \PDO::PARAM_STR) ||
                !$request->bindValue(":password", password_hash(
                    $password,
                    PASSWORD_DEFAULT),
                    \PDO::PARAM_STR)
            ) {
                throw new AuthException(AuthException::REGISTER_ERROR);
            }
            if (!$request->execute()) {
                var_dump($request);
                throw new AuthException(AuthException::REGISTER_ERROR);
            }
            // Checking if the login / email is already in the database (since they should be unique)
            if ($request->errorInfo()[0] === '23000') {
                throw new AuthException(AuthException::LOGIN_ALREADY_USED);
            } else {
                $user = $request->fetch(\PDO::FETCH_ASSOC);
            }
            if ($request->closeCursor() === false) {
                throw new AuthException(AuthException::REGISTER_ERROR);
            }
        } catch (AuthException $error) {
            return [
                "error" => true,
                "errorMessage" => $error->getMessage(),
            ];
        }

        // Creation successful
        $user = $this->getUserByLogin($login);
        return $user;
    }
}
