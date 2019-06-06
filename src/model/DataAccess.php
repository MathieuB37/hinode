<?php
namespace App\model;

use App\exception\AuthenticationException;

class DataAccess 
{   
    // Constants
    // Database access
    const DRIVER = "mysql";
    const HOST = "localhost";
    const PORT = "3306";
    const BASE = "site_hinode";
    const LOGIN = "hinode";
    const PASSWORD = "kJMg7uBfg6ZZ2QPx";
    // Table of users
    const USERS_TABLE = "user";
    const LOGIN_FIELD = "login";
    const PASSWORD_FIELD = "password";
    // Class attributes
    private static $instance = null;
    // Attributes
    private $dataBase;

    // Class methods :
    public static function getInstance() : self
    {   // Avoiding 2 simultaneous connection to the DB
        if (self::$instance === null) {
            self::$instance = new DataAccess();
        }
        return self::$instance; 
    }
    
    private function __construct()
    {   // Tries to establish a connection with the database 
        try {
            $this->dataBase = new \PDO(self::DRIVER . ':host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::BASE . ';charset=UTF8', 
                                    self::LOGIN, self::PASSWORD);
        } catch(PDOException $error) {
            echo "Connexion echouée : " . $error->getMessage();
            exit;
        }
    }
    
    // Request verifying Login & Password
    public function checkLogin(string $login, string $password) :bool
    {
        $request =  "SELECT password FROM user WHERE login=:login";
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
        $result = $preparedRequest->fetch();
        if ($result === false) {
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
        return true;
    }

    public function createUser(string $login, string $password)
    {
        try {
            $request = $this->dataBase->prepare("INSERT INTO user (login, password, email, first_name, last_name) 
                        VALUES (:login, :password, :email, :first_name, :last_name)");
        } catch (PDOException $erreur) {
            echo "Request Failed";
            exit;
        }
        if (!$request->bindValue(":login",$login, \PDO::PARAM_STR) ||
            !$request->bindValue(":password",password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR)) {
            echo "Request Failed";
            exit();
        }
        if (!$request->execute()) {
            // Si le login est déjà dans la base
            if ($request->errorInfo()[0] === '23000') {
                throw new AuthenticationException(AuthenticationException::LOGIN_ALREADY_USED);
            } else {
                echo "Request Failed";
                exit;
            }
        }
        if ($request->closeCursor() === false) {
            echo "Error while closing the request";
        }
    }
    
    public function getArticle(int $id) : array
    {
        // Trying to prepare the request in order to avoid SQL injection
        $lang = strtoupper($_SESSION["language"]);
        try {
            $request = $this->dataBase->prepare(
                'SELECT title, content from article_translations WHERE language_id
                IN (SELECT id FROM languages WHERE languages.name = :lang)
                AND article_translations.article_id = :id;'
            );
        } catch (PDOException $erreur) {
            echo "Request Failed";
            exit;
        }
        // Binding value 
        if (!$request->bindValue(":id", $id, \PDO::PARAM_INT) || !$request->bindValue(":lang", $lang, \PDO::PARAM_STR)) {
            echo "Request Failed";
            exit;
        }
        // Executing the request to the server
        if (!$request->execute()) {
            // Request Failed
            echo "Could not get article";
            exit;
        }
        // Fetching the article
        $response = $request->fetch();
        // Making sure we close the fetch
        if ($request->closeCursor() === false) {
            echo "Could not get article";
            exit;
        }
        $article = ['title' => $response[0], 'content' => $response[1]];
        var_dump($article);
        return($article);
        // $article =  ["title" => $response]
    }

    // public function createArticle(string $title, string $content, string $language)
    // {
    //     try {
    //         $request = $this->dataBase->prepare("INSERT INTO articles (")
    //     }






    //     try {
    //         $request = $this->dataBase->prepare("INSERT INTO article_translations (login, password, email, first_name, last_name) 
    //                     VALUES (:login, :password, :email, :first_name, :last_name)");
    //     } catch (PDOException $erreur) {
    //         echo "Request Failed";
    //         exit;
    //     }
    //     if (!$request->bindValue(":login",$login, \PDO::PARAM_STR) ||
    //         !$request->bindValue(":password",password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR)) {
    //         echo "Request Failed";
    //         exit();
    //     }
    //     if (!$request->execute()) {
    //         // Si le login est déjà dans la base
    //         if ($request->errorInfo()[0] === '23000') {
    //             throw new AuthenticationException(AuthenticationException::LOGIN_ALREADY_USED);
    //         } else {
    //             echo "Request Failed";
    //             exit;
    //         }
    //     }
    //     if ($request->closeCursor() === false) {
    //         echo "Error while closing the request";
    //     }
    // }
}
