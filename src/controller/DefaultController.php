<?php

namespace App\controller;

use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;
use \App\model\DataAccess;

abstract class DefaultController
{
    protected $twig;
    protected $dataBase;

    public function __construct()
    {
        $loader = new FilesystemLoader('src/view/templates');
        $this->twig = new Environment($loader, [
        'cache' => false, '/tmp',
        ]);
        $this->dataBase = DataAccess::getInstance();
    }
}