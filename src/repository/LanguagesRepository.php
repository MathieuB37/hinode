<?php

namespace App\Repository;

use App\Repository\DefaultRepository;

class LanguagesRepository extends DefaultRepository
{

    public function getLangList()
    {
        // Preparing the request
        try {
            $preparedRequest = $this->dataBase->getPDO()->prepare("SELECT * FROM languages");
        } catch (PDOException $error) {
            $errorMessage = 'Problème lors de votre connexion, veuillez ré-essayer.';
        }
        // Executing the request
        if (!$preparedRequest->execute()) {
            // Request Failed
            throw new PDOException("Could not get language list");
        }
        // Fetching the article
        try {
            $langList = $preparedRequest->fetchall(\PDO::FETCH_ASSOC);

            if ($preparedRequest->closeCursor() === false) {
                throw new PDOException("Could not get language list");
            }
        } catch (PDOException $error) {
            echo "Request Failed : " . $error;
            exit;
        }
        return ($langList);
    }
}
