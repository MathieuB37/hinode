<?php

namespace App\Controller;

use App\Service\LanguageService;

class LanguageController
{
    private $langList;
    private $service;

    public function __construct()
    {
        $this->service = new LanguageService;
        $this->getLangList();
    }

    public function getLangList()
    {
        $this->langList = $this->service->getLangList();
    }

    public function setSessionLang(string $requestedLang)
    {
        $this->service->setSessionLang($requestedLang);
        header("Location: ../../home");
    }
}
