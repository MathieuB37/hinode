<?php

namespace App\controller;

// use vendor\twig\twig\src\Loader\FilesystemLoader as Twig_Loader_Filesystem;
// use vendor\twig\twig\src\Environment as Twig_Environment;


class ArticleController
{
    private $loader;
    private $twig;
    private $template;
    private $newsTitle;
    private $newsContent;
    private $id;

    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem(__DIR__ . '/src/view/templates');
        $this->twig = new Twig_Environment($loader, [
        'cache' => false, __DIR__ . '/tmp',
        ]);

        $this->newsTitle = 'Exemple titre article';
        $this->newsContent = 'Exemple contenu article okjspfspofkps sodfp os jsjkj';
    }

    // TODO: Link all of this to the DB in order to get the correct article
    public function show($id)
    {
        $this->id = $id;
        $this->twig->render('article/article.html.twig', ['id' => $id, 'newsTitle' => $this->newsTitle, 'newsContent' => $this->newsTitle]);
    }
}  
  