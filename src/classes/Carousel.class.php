<?php

class Carousel 
{
    const NB_IMGS_CAROUSEL = 3;
    const MAX_IMG_ID = 26;

    private $html = "";
    public $usedImgs = [0];

    public function generate ()
    {
        for ($i=0; $i < NB_IMGS_CAROUSEL; $i++) {
            $isRepeated = TRUE;
            // Avoid displaying the same image twice
            while ($isRepeated === TRUE) {
                ${"img$i"} = random_int(1, MAX_IMG_ID);
                foreach ($usedImgs as $usedID) {
                    if (${"img$i"} = $usedID) {
                        break 1;
                    }
                    $isRepeated = FALSE;
                    array_push($this->usedImgs, ${"img$i"});
                }
            }
        }

        $this->html = '<div class="container col-md-8 col-xs-10">
                            <div id="topCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                                <ol class="carousel-indicators">';
        // Generates the appropriate number of indicators (TODO?: replace by do - while)
        for ($i=0; $i < NB_IMGS_CAROUSEL; $i++) {
            if ($i === 0) {
                $this->html .= '<li data-target="#topCarousel" data-slide-to="' . $i . '" class="active"></li>';
            }
            else {
                $this->html .= '<li data-target="#topCarousel" data-slide-to="' . $i . '"></li>';
            }
        }
        $this->html .= '</ol>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="carousel-item active">';
        // link the correct number of images (TODO?: replace by do - while)
        for ($i=0; $i < NB_IMGS_CAROUSEL; $i++) {
            if ($i === 0) {
                $this->html .= '<div class="carousel-item active">';
            }
            else {
                $this->html .= '<div class="carousel-item">';
            }
            $this->html .= '<img src="http://hinode-tours.fr/image/design/partieGauche/image' . ${"img$i"} . '.jpg" alt="">
            </div>';
        }
        $this->html .= '</div>
                            <!-- Left and right controls-->
                            <a class="left carousel-control-prev" href="#topCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control-next" href="#topCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>';


    }
}