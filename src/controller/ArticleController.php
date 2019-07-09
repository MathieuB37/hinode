<?php

namespace App\Controller;

use \App\Controller\DefaultController;
use \App\Repository\ArticlesRepository;
use \App\Repository\ArticleTranslationsRepository;
use \App\Entity\Article;
use \App\Entity\ArticleTranslation;


class ArticleController extends DefaultController
{
    private $id;
    private $articleRepository;
    private $translationRepository;
    private $article;
    private $articleTranslation;
    private $language;

    public function __construct()
    {
        parent::__construct();
        $this->articleRepository = new ArticlesRepository;
        $this->translationRepository = new ArticleTranslationsRepository;
        $this->article = new Article;
        $this->language = "FR";
    }

    public function show(int $id)
    {
        $this->article = $this->articleRepository->getArticleById($id);
        $this->articleTranslation = $this->translationRepository->getArticleByLang($id, $this->language);
        echo $this->twig->render('article/article.html.twig', 
                                ['article' => $this->article,
                                 'articleTranslation' => $this->articleTranslation]
        );
    }

    public function create()
    {
        // Detect if a form has been filled
        if (isset($_POST["articleTitle"]) && 
            isset($_POST["articleContent"]) && 
            isset($_POST["articleLanguage"])) 
        {
            $this->article = $this->ArticleRepository->createArticle(
                $_POST["articleTitle"], 
                $_POST["articleContent"], 
                $_POST["articleLanguage"]
            );
        } else {
            // Display the article creation form
            echo $this->twig->render('article/create.html.twig');
        }
    }
}  
  