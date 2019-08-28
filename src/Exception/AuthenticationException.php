<?php

namespace App\Exception;

use App\Entity\User;

class AuthenticationException extends \Exception
{
    const LOGIN_LENGTH_NOT_VALID = 1;
    const PASSWORD_LENGTH_NOT_VALID = 2;
    const EMAIL_LENGTH_NOT_VALID = 3;
    const FIRST_NAME_LENGTH_NOT_VALID = 4;
    const LAST_NAME_LENGTH_NOT_VALID = 5;
    const LOGIN_NOT_VALID = 6;
    const INFORMATIONS_NOT_VALID = 7;
    const LOGIN_OR_EMAIL_ALREADY_USED = 8;
    const REGISTER_ERROR = 9;
    const LOGIN_ERROR = 10;
    const LOGIN_NOT_FOUND = 11;

    public function __construct(int $code)
    {
        switch ($code) {
            case self::LOGIN_LENGTH_NOT_VALID:
                //TODO: Repair the min & max values of the login (conf file ?)
                parent::__construct("Le login doit être compris entre "
                    . USER::DB_TABLE_LOGIN["minlength"]
                    . " et "
                    . USER::DB_TABLE_LOGIN["maxlength"]
                    . " caractères.", $code
                );
                break;
            case self::PASSWORD_LENGTH_NOT_VALID:
                //TODO: Repair the min & max values of the login (conf file ?)
                parent::__construct("Le mot de passe doit être compris entre "
                    . USER::DB_TABLE_PASSWORD["minlength"]
                    . " et "
                    . USER::DB_TABLE_PASSWORD["maxlength"]
                    . " caractères.", $code
                );
                break;
            case self::EMAIL_LENGTH_NOT_VALID:
                //TODO: Repair the min & max values of the login (conf file ?)
                parent::__construct("L'email doit être compris entre "
                    . USER::DB_TABLE_EMAIL["minlength"]
                    . " et "
                    . USER::DB_TABLE_EMAIL["maxlength"]
                    . " caractères.", $code
                );
                break;
            case self::FIRST_NAME_LENGTH_NOT_VALID:
                //TODO: Repair the min & max values of the login (conf file ?)
                parent::__construct("Le prénom doit être compris entre "
                    . USER::DB_TABLE_FIRST_NAME["minlength"]
                    . " et "
                    . USER::DB_TABLE_FIRST_NAME["maxlength"]
                    . " caractères.", $code
                );
                break;
            case self::LAST_NAME_LENGTH_NOT_VALID:
                //TODO: Repair the min & max values of the login (conf file ?)
                parent::__construct("Le nom de famille doit être compris entre "
                    . USER::DB_TABLE_LAST_NAME["minlength"]
                    . " et "
                    . USER::DB_TABLE_LAST_NAME["maxlength"]
                    . " caractères.", $code
                );
                break;
            case self::LOGIN_NOT_VALID:
                parent::__construct(
                    "Le login ne doit contenir que des caractères alphanumériques",
                    $code
                );
                break;
            case self::INFORMATIONS_NOT_VALID:
                parent::__construct("Les informations saisies sont invalides", $code);
                break;
            case self::LOGIN_OR_EMAIL_ALREADY_USED:
                parent::__construct("Le login ou l'email saisi est déjà utilisé", $code);
                break;
            case self::REGISTER_ERROR:
                parent::__construct("Problème lors de votre inscription, veuillez ré-essayer.", $code);
                break;
            case self::LOGIN_ERROR:
                parent::__construct("Problème lors de votre connexion, veuillez ré-essayer.", $code);
                break;
            case self::LOGIN_NOT_FOUND:
                parent::__construct("Identifiant ou mot de passe non reconnu", $code);
                break;
            default:
                parent::__construct("Erreur inattendue", $code);
                break;
        }
    }
}
