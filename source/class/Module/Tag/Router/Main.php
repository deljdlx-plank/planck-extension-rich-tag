<?php


namespace Planck\Extension\RichTag\Module\Tag\Router;


use Phi\HTML\CSSFile;
use Phi\HTML\JavascriptFile;
use Planck\Extension\RichTag\Module\Tag\View\Index;
use Planck\Router;



class Main extends Router
{




    public function registerRoutes()
    {


        $this->get('list', '`/tags`', function() {

            $assets = $this->router->getAssets();


            $this->response->addExtraData('resources', $assets);

            $view = new Index();
            echo $view->render();





        })->html()
        ->setBuilder('/images')
        ;







        return parent::registerRoutes();
    }

}