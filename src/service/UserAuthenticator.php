<?php

namespace App\Service;


class UserAuthenticator
{
// Request verifying Login & Password
    public function checkLogin(string $login, string $password) :bool
    {
        $request =  "SELECT password, login, id FROM user WHERE login=:login";
        try {
            $preparedRequest = $this->dataBase->prepare($request);
        } catch(PDOException $error)
        {
            echo "Error when preparing the request";
            exit;
        }
        if (!$preparedRequest->bindValue(":login", $login, \PDO::PARAM_STR)) {
            // Request Failed
            echo "Request failed";
            exit;
        }
        if (!$preparedRequest->execute()) {
            // Request Failed
            echo "Request failed";
            exit;
        }
        $result = $preparedRequest->fetch(PDO::FETCH_ASSOC);
        if (!isset($result["login"])) {
            return false;
        }
        if (!password_verify($password, $result["password"])) {
            return false;
        }
//////////
        // Si OK, l'utilisateur devient connecté
        // if ($result === $_POST["password"]){
        //     $_SESSION["login"] = $_POST["login"];
        // }
//////////
        if ($preparedRequest->closeCursor() === false) {
            echo "Error when closing the request";
            exit;
        }
        return $result["login"];
    }
}
