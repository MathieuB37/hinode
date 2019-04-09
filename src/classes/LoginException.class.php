<?php

// Traite les erreurs sur les entrées du formulaire de connexion

class LoginException extends Exception
{
    // Codes d'erreur
    const LOGIN_TOO_LONG = 1;
    const LOGIN_TOO_SHORT = 2;
    const PASSWORD_TOO_LONG = 3;
    const PASSWORD_TOO_SHORT = 4;
    const INCORRECT_INFORMATIONS = 5;

    public function __construct(int $code)
    {
        switch ($code) {
            case self::LOGIN_TOO_LONG:
                parent::__construct("Login trop long", $code);
                break;
            case self::LOGIN_TOO_SHORT:
                parent::__construct("Login trop court", $code);
                break;
            case self::PASSWORD_TOO_LONG:
                parent::__construct("Mot de passe trop long",$code);
                break;
            case self::PASSWORD_TOO_SHORT:
                parent::__construct("Mot de passe trop court", $code);
                break;
            case self::INCORRECT_INFORMATIONS:
                parent::__construct("Login ou mot de passe incorrect",$code);
                break;
            default:
                parent::__construct("Erreur inattendue",$code);
                break;
        }      
    }
}