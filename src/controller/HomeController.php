<?php

namespace App\controller;

use \App\Controller\DefaultController;

class HomeController extends DefaultController
{
    private $newsTitle;
    private $newsContent;
    private $id;

    // TODO: Link all of this to the DB in order to get the correct article
    public function display()
    {
        echo $this->twig->render('home.html.twig');
    }
}
