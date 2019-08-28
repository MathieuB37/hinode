<?php

namespace App\Service;

use App\Repository\LanguagesRepository;

class LanguageService
{
    // Atribiutes
    private $repository;
    private $langList;

    public function __construct()
    {
        $this->langList = $this->getLangList();
    }

    public function getLangList()
    {
        $this->repository = new LanguagesRepository;
        return $this->repository->getLangList();
    }

    public function setSessionLang(string $requestedLang)
    {
        if ($this->isValidLanguage($requestedLang)) {
            $_SESSION["lang"] = $requestedLang;
        } else {
            // If langugae not matching, defaults to English
            $_SESSION["lang"] = "EN";
        }
    }

    public function isValidLanguage(string $langToTest): bool
    {
        // Testing if the languqge is supported
        foreach ($this->langList as $validLang) {
            if ($langToTest === $validLang["name"]) {
                return true;
            }
        }
        // Language didn't match
        return false;
    }

}
