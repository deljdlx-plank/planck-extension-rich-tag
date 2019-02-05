<?php


namespace Planck\Extension\RichTag\Module\Tag\Router;


use Planck\Extension\RichTag\Module\Tag\View\Index;
use Planck\Router;



class Main extends Router
{




    public function registerRoutes()
    {


        $this->get('list', '`/tags`', function() {

            $assets = $this->router->getAssets();

            //$assets[] = new JavascriptFile('vendor/jstree/dist/jstree.js');
            //$assets[] = new CSSFile('vendor/jstree/dist/themes/default/style.css');


            $this->response->addExtraData('resources', $assets);

            $view = new Index();
            echo $view->render();





        })->html()
        ->setBuilder('/images')
        ;







        return parent::registerRoutes();
    }

}