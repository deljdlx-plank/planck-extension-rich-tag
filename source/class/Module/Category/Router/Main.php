<?php


namespace Planck\Extension\RichTag\Module\Category\Router;


use Phi\HTML\CSSFile;
use Phi\HTML\JavascriptFile;
use Planck\Extension\RichTag\Module\Category\View\Index;
use Planck\Routing\Router;



class Main extends Router
{




    public function registerRoutes()
    {


        $this->get('list', '`/tag/categories`', function() {

            $assets = $this->router->getAssets();
            $assets[] = new JavascriptFile('vendor/jstree/dist/jstree.js');
            $assets[] = new CSSFile('vendor/jstree/dist/themes/default/style.css');


            $javascriptBootstrap = $this->getLocalJavascriptFile(
                $this->router->getExtension()->getJavascriptsFilepath().'/bootstrap/category.js'
            );
            $assets[] = $javascriptBootstrap;



            $this->response->addExtraData('resources', $assets);

            $view = new Index();
            echo $view->render();





        })->html()
        ->setBuilder('/tag/categories')
        ;







        return parent::registerRoutes();
    }

}