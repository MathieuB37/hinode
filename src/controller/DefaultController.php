<?php

namespace App\Controller;

use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

abstract class DefaultController
{
    protected $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader('src/View/Templates');
        $this->twig = new Environment($loader, [
        'cache' => false, '/tmp',
        ]);
    }
}