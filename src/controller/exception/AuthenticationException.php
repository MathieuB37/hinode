<?php 

namespace App\controller\exception;

use App\controller\Authentication;

class AuthenticationException extends \Exception
{
    const LOGIN_LENGTH_NOT_VALID = 1;
    const PASSWORD_LENGTH_NOT_VALID = 2;
    const LOGIN_NOT_VALID = 3;
    const INFORMATIONS_NOT_VALID = 4;
    const LOGIN_ALREADY_USED = 5;

    public function __construct(int $code)
    {
        switch ($code) {
            case self::LOGIN_LENGTH_NOT_VALID:
                parent::__construct("Le login doit être compris entre " . Authentication::LOGIN_MIN_LENGTH . " et " . Authentication::LOGIN_MAX_LENGTH . " caractères.", $code);
                break;
            case self::PASSWORD_LENGTH_NOT_VALID:
                parent::__construct("Le mot de passe doit être compris entre " . "8" . " et " . "60" . " caractères.", $code);
                break;
            case self::LOGIN_NOT_VALID:
                parent::__construct("Le login ne doit contenir que des caractères alphanumériques");
                break;
            case self::INFORMATIONS_NOT_VALID:
                parent::__construct("Les informations saisies sont invalides", $code);
                break;
            case self::LOGIN_ALREADY_USED:
                parent::__construct("Le login saisi est déjà utilisé", $code);
                break;
            default:
                parent::__construct("Erreur inattendue", $code);
                break;
        }      
    }
}