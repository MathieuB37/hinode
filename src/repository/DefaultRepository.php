<?php

namespace App\Repository;

use \App\Entity\EntityManager;

class DefaultRepository
{
    protected $dataBase;

    public function __construct()
    {
        $this->dataBase = EntityManager::getInstance();
    }

}
