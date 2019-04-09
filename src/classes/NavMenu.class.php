<?php
class NavMenu 
{
    private $html = "";

    // Methods :
    public function __constructor ($pagesList)
    {
        $this->html = "<nav class='navbar navbar-expand-md navbar-dark'role='navigation'>";
        foreach ($pagesList as $page => $link) {
            $this->html .= "<li class='nav-item'><a class='nav-link' href=" . $link . ">$page</a></li>";
        }
        $this->html .= "</ul></nav>";

        if ($position === "left") {
            $this->html .= "<ul class='' >";
        }
    }

    public function display ()
    {
        return $this->html;
    }


}
