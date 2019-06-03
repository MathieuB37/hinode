<?php 

namespace App\exception;

class RegisterException extends \Exception
{
    const LOGIN_LENGTH_NOT_VALID = 2;
    const PASSWORD_LENGTH_NOT_VALID = 4;
    const LOGIN_NOT_VALID = 3;
    const LOGIN_ALREADY_USED = 4;

    public function __construct(int $code)
    {
        switch ($code) {
            case self::LOGIN_LENGTH_NOT_VALID:
                parent::__construct("Login trop long", $code);
                break;
            case self::PASSWORD_LENGTH_NOT_VALID:
                parent::__construct("Mot de passe trop long",$code);
                break;
            case self::LOGIN_ALREADY_USED:
                parent::__construct("Login déjà utilisé",$code);
                break;
            default:
                parent::__construct("Erreur inattendue",$code);
                break;
        }      
    }
}