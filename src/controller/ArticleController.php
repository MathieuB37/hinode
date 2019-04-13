<?php
namespace App\controller;

require_once 'vendor/autoload.php';

class ArticleController
{
    private $loader;
    private $twig;
    private $template;
    private $newsTitle;
    private $newsContent;

    public function construct()
    {
        $this->loader = new Twig_Loader_Filesystem(__DIR__ . '/src/view/templates');
        $this->twig = new Twig_Environment($this->loader, [
            'cache' => false, __DIR__ . '/tmp',
        ]);
        $this->newsTitle = 'Exemple titre article';
        $this->newsContent = 'Exemple contenu article okjspfspofkps sodfp os jsjkj';
    }

    // TODO: Link all of this to the DB in order to get the correct article
    public function show($id)
    {
        $this->template = $this->twig->load('article.twig');
        $this->twig->display('template.twig', ['id' => $id, 'newsTitle' => $this->newsTitle, 'newsContent' => $this->newsTitle]);
        echo "Je suis l'article id $id";

    }
}  
  