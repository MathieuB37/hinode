<?php

namespace App\controller;

use \App\controller\DefaultController;


class ArticleController extends DefaultController
{
    private $newsTitle;
    private $newsContent;
    private $id;

    // TODO: Link all of this to the DB in order to get the correct article
    public function show(int $id)
    {
        $this->article = $this->dataBase->getArticle($id);
        // $blah = DefaultController::__construct();
        echo $this->twig->render('article/article.html.twig', ['article' => $this->article]);
    }

    public function create()
    {
        // Detect if a form has been filled
        if (isset($_POST["articleTitle"]) && isset($_POST["articleContent"]) && isset($_POST["article"])) {

        } else {
            // Display the article creation form
            echo $this->twig->render('article/create.html.twig');
        }
    }
}  
  