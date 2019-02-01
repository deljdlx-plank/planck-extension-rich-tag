<?php


namespace Planck\Extension\RichTag\Module\Type\Router;


use Phi\HTML\CSSFile;
use Phi\HTML\JavascriptFile;
use Planck\Extension\RichTag\Module\Type\View\Index;
use Planck\Router;



class Main extends Router
{




    public function registerRoutes()
    {


        $this->get('list', '`/tag/types`', function() {

            $assets = $this->router->getAssets();
            $assets[] = new JavascriptFile('vendor/jstree/dist/jstree.js');
            $assets[] = new CSSFile('vendor/jstree/dist/themes/default/style.css');


            $this->response->addExtraData('resources', $assets);

            $view = new Index();
            echo $view->render();





        })->html()
        ->setBuilder('/images')
        ;







        return parent::registerRoutes();
    }

}