<?php

// require_once 'classes/Authentication.class.php';
// require_once 'classes/DataAccess.class.php';
// require_once 'classes/NavMenu.class.php';


class PageWeb
{
    private $TopNavLinks = ["Accueil" => "index.php",
                            "L'Association" => "asso.php",
                            "Cours" => "cours.php",
                            "Espace Membres" => "membre.php",                            
    ];
    private $BottomNavLinks = ["Contact" => "",
                                "Mentions légales" => "",
    ];

    private $head = "";
    private $topNav = "";
    private $carousel = "";
    private $header = "";
    public $content = "";
    private $form = "";
    private $footer = "";
    private $end = "";
    // Data access :
    private $dataBase;

    // Methods :

    public function __construct(string $title = "Titre de page par défault", bool $lock = FALSE)
    {
        // For every page, generates a basic template
        // $this->dataBase = DataAccess::getInstance();
        $this->pageLock($lock);
        $this->generateHead($title);
        $this->generateTopNav();
        $this->generateCarousel();
        $this->generateHeader();
        $this->generateContent();
        $this->generateFooter();
        $this->generateEnd();
    }
    // Check if this is a private page (need to be logged in) :
    private function pageLock($lock):void
    {
        if ($lock === TRUE && !isset($_SESSION["login"])){
            header("Location: connection.php");
            exit;
        }
    } 
    // Generate Html Head :
    private function generateHead(string $title = "Titre par défault"):void
    {
        $this->head = "<!DOCTYPE html>";
        $this->head .= "<html lang='en'>";
        $this->head .="<head>";
        $this->head .="<meta charset='UTF-8'>";
        $this->head .="<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        $this->head .="<meta http-equiv='X-UA-Compatible' content='ie=edge'>";
        $this->head .="<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'
                        integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>";
        $this->head .="<link rel='stylesheet' href='public/css/styles.css'>";
        $this->head .="<title>" . $title . "</title>";
        $this->head .="</head>";
        $this->head .="<body>";;
    }

    public function generateHeader()
    {
        $this->header = '<header>';
        $this->header .= $this->topNav;
        $this->header .= $this->carousel;
        $this->header .= '</header>';

    }

    public function generateTopNav() 
    {
        $this->topNav = '<nav id="topNav" class="navbar navbar-expand-md navbar-dark" role="navigation">';
        $this->topNav .= '<a class="navbar-brand" href="#"><img src="http://hinode-tours.fr/image/design/hinode.jpg" height="90px"></a>';
        $this->topNav .= '<ul class="navbar-nav">';
        $this->topNav .= '<li class="nav-item active">';
        $this->topNav .= '<a class="nav-link" href="#">Accueil</a>';
        $this->topNav .= '</li>';
        $this->topNav .= '<li class="nav-item">';
        $this->topNav .= '<a class="nav-link" href="#">L&apos;association</a>';
        $this->topNav .= '</li>';
        $this->topNav .= '<li class="nav-item">';
        $this->topNav .= '<a class="nav-link" href="#">Cours</a>';
        $this->topNav .= '</li>';
        $this->topNav .= '</ul>';
        $this->topNav .= '<ul class="navbar-nav ml-auto">';
        $this->topNav .= '<li class="nav-item">';
        $this->topNav .= '<a class="nav-link" href="#">Espace Membre</a>';
        $this->topNav .= '</li>';
        $this->topNav .= '<li class="nav-item dropdown ml-auto">';
        $this->topNav .= '<a class="nav-link dropdown-toggle" id="languageSelector" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Language</a>';
        $this->topNav .= '<div class="dropdown-menu" aria-labelledby="navbarDropdown languageSelector">';
        $this->topNav .= '<a class="dropdown-item" href="#"><img src="public/images/icons/french_flag_x24.png">Français</a>';
        $this->topNav .= '<a class="dropdown-item" href="#"><img src="public/images/icons/japanese_flag_x24.png">日本語</a>';
        $this->topNav .= '<a class="dropdown-item" href="#"><img src="public/images/icons/english_flag_x24.png">English</a>';
        $this->topNav .= '</div>';
        $this->topNav .= '</li> ';
        $this->topNav .= '</ul>';
        $this->topNav .= '</nav>';  
    }
    
    // Generating nav : 
    // private function generateNavMenu(array $pagesList, int $nbLeftLinks, bool $hasLogo = FALSE):void
    // {

    //     // Récupération de la liste des fichiers .php
    //     $this->topNav = "<nav class='navbar navbar-expand-md navbar-dark'role='navigation'>";
    //     // Logo ?
    //     if ($hasLogo = TRUE){
    //         $this->topNav .= '<a class="navbar-brand" href="#"><img src="http://hinode-tours.fr/image/design/hinode.jpg" height="90px"></a>';
    //     }
    //     $this->topNav .= '<ul class="navbar-nav">';
    //     for ($i=0; $i < count($pagesList); $i++){

    //     }

    //     foreach ($pagesList as $page => $link) {
    //         $this->topNav .= "<li class='nav-item'><a class='nav-link' href=" . $link . ">$page</a></li>";
    //     }
    //     $this->topNav .= "</ul></nav>";
    //     if ($position === "left") {
    //         $this->topNav .= "<ul class='' >";
    //     }
    // }
    
    public function generateCarousel()
    {
        $this->carousel = '<!-- Carousel -->';
        $this->carousel .= '<div class="container col-md-8 col-xs-10">';
        $this->carousel .= '<div id="topCarousel" class="carousel slide" data-ride="carousel">';
        $this->carousel .= '<!-- Indicators -->';
        $this->carousel .= '<ol class="carousel-indicators">';
        $this->carousel .= '<li data-target="#topCarousel" data-slide-to="0" class="active"></li>';
        $this->carousel .= '<li data-target="#topCarousel" data-slide-to="1"></li>';
        $this->carousel .= '<li data-target="#topCarousel" data-slide-to="2"></li>';
        $this->carousel .= '</ol>';
        $this->carousel .= '<!-- Wrapper for slides -->';
        $this->carousel .= '<div class="carousel-inner">';
        $this->carousel .= '<div class="carousel-item active">';
        $this->carousel .= '<img src="http://hinode-tours.fr/image/design/partieGauche/image25.jpg" alt="">';
        $this->carousel .= '</div>';
        $this->carousel .= '<div class="carousel-item">';
        $this->carousel .= '<img src="http://hinode-tours.fr/image/design/partieGauche/image24.jpg" alt="">';
        $this->carousel .= '</div>';
        $this->carousel .= '<div class="carousel-item">';
        $this->carousel .= '<img src="http://hinode-tours.fr/image/design/partieGauche/image26.jpg" alt="">';
        $this->carousel .= '</div>';
        $this->carousel .= '</div>';
        $this->carousel .= '<!-- Left and right controls-->';
        $this->carousel .= '<a class="left carousel-control-prev" href="#topCarousel" role="button" data-slide="prev">';
        $this->carousel .= '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
        $this->carousel .= '<span class="sr-only">Previous</span>';
        $this->carousel .= '</a>';
        $this->carousel .= '<a class="right carousel-control-next" href="#topCarousel" role="button" data-slide="next">';
        $this->carousel .= '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
        $this->carousel .= '<span class="sr-only">Next</span>';
        $this->carousel .= '</a>';
        $this->carousel .= '</div>';
        $this->carousel .= '</div>';
    }
    
    public function generateContent()
    {
        $this->content = '<div class="row">';
        $this->content .= '<!-- Main content of the page -->';
        $this->content .= '<main class="col-md-9" role="main">';
        $this->content .= '<!-- Last News section -->';
        $this->content .= '<section id="lastNews" class="col-md-11">';
        $this->content .= '<h2>Dernières Actualités :</h2>';
        $this->content .= '<article class="news">';
        $this->content .= '<h3 class="news-title">News Title</h3>';
        $this->content .= '<p class="news-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. ';
        $this->content .= 'Ab rerum reprehenderit odio fugit beatae, cumque repellat sed? Obcaecati, delectus ex!</p>';
        $this->content .= '<a href="#">> Read more</a>';
        $this->content .= '</article>';
        $this->content .= '<article class="news">';
        $this->content .= '<h3 class="news-title">News Title 2</h3>';
        $this->content .= '<p class="news-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. ';
        $this->content .= 'Ab rerum reprehenderit odio fugit beatae, cumque repellat sed? Obcaecati, delectus ex!</p>';
        $this->content .= '<a href="#">> Read more</a>';
        $this->content .= '</article>';
        $this->content .= '</section>';
        $this->content .= '</main>';
        $this->content .= '<section id="right-rail" class="col-md-3 sidebar">';
        $this->content .= '<div id="facebookFeed">';
        $this->content .= '<h2>Fil Facebook :</h2>';
        $this->content .= '<!-- ';
        $this->content .= 'TODO : Include Facebook feed with API';
        $this->content .= '-->';
        $this->content .= '</div>';
        $this->content .= '<div id="schedule">';
        $this->content .= '<h2>Planning :</h2>';
        $this->content .= '<!-- ';
        $this->content .= '- Include only the next 5 events/classes ? ';
        $this->content .= '- Compact or not ?';
        $this->content .= '-->';
        $this->content .= '<div class="scheduled-event">';
        $this->content .= '<p class="event-date"><a href="#">14/03/2019</a></p>';
        $this->content .= '<p class="event-name"><a href="#">- Nom event ></a></p>';
        $this->content .= '</div>';
        $this->content .= '<div class="scheduled-event">';
        $this->content .= '<p class="event-date"><a href="#">02/04/2019</a></p>';
        $this->content .= '<p class="event-name"><a href="#">- Nom event différent></a></p>';
        $this->content .= '</div>';
        $this->content .= '<div class="scheduled-event">';
        $this->content .= '<p class="event-date"><a href="#">11/04/2019</a></p>';
        $this->content .= '<p class="event-name"><a href="#">- Encore un autre nom d&apos;event ></a></p>';
        $this->content .= '</div>';
        $this->content .= '</div>';
        $this->content .= '</section>';
        $this->content .= '</div>';

    }

    public function generateFooter()
    {
        $this->footer .= '<footer>';
        $this->footer .= '<div id=bottomNav class="navbar navbar-expand-md navbar-dark" role="navigation">';
        $this->footer .= '<ul class="navbar-nav">';
        $this->footer .= '<li class="nav-item">';
        $this->footer .= '<a class="nav-link" href="#">Contact</a>';
        $this->footer .= '</li>';
        $this->footer .= '<li class="nav-item">';
        $this->footer .= '<a class="nav-link" href="#">Mentions Légales</a>';
        $this->footer .= '</li>';
        $this->footer .= '<li>';
        $this->footer .= '<p class="nav-link copyright">© Hinodé Tours 2019</p>';
        $this->footer .= '</li>';
        $this->footer .= '</ul>';
        $this->footer .= '</div>';
        $this->footer .= '</footer>';
    }

    // Closing Html :
    private function generateEnd():void
    {
        $this->end = '<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>';
        $this->end .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>';
        $this->end .= '<script src="public/js/bootstrap.min.js"></script>';
        $this->end .= '</body>';
        $this->end .= '</html>';
    }

    

    // public function generateForm(string $formType):void
    // {
    //     $this->form .="<form method='POST' action='$formType.php'>";
    //     $this->form .="<input type='text' name='login' placeholder='login'>";
    //     $this->form .="<input type='password' name='password' placeholder='password'>";
    //     $this->form .="<input type='submit'>";
    //     $this->form .="</form>";
    // }

    // public function addArticle(Article $article)
    // {
    //     $this->content.=$article->displayArticle();
    // }

    // public function pageCheck():void{
    //     if ($this->head == ""){
    //         generatePageHead();
    //     }
    //     if ($this->content == ""){
    //         generatePageContent();
    //     }
    //     if ($this->end == ""){
    //         generatePageEnd();
    //     }
    // }


    // Fonction d'affichage de la page web
    private function displayPageWeb():void
    {
        // pageCheck();
        echo $this->head;
        if (isset($_SESSION["login"])){
            echo $_SESSION["login"];
        }
        echo $this->head;
        echo $this->header;
        echo $this->content;
        echo $this->footer;
        echo $this->end;
    }

    public function __destruct()
    {
        $this->displayPageWeb();
    }

    
}