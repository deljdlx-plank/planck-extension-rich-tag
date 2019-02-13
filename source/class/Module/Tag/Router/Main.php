<?php


namespace Planck\Extension\RichTag\Module\Tag\Router;


use Phi\HTML\CSSFile;
use Phi\HTML\JavascriptFile;
use Planck\Extension\RichTag\Module\Tag\View\Index;
use Planck\Routing\Router;



class Main extends Router
{




    public function registerRoutes()
    {


        $this->get('list', '`/tags`', function() {


            $view = new Index();
            echo $view->render();





        })->html()
        ->setBuilder('/images')
        ;







        return parent::registerRoutes();
    }

}