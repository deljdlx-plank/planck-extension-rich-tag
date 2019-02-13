<?php


namespace Planck\Extension\RichTag\Module\Tag\Router;



use Planck\Extension\RichTag\Model\Repository\Tag;
use Planck\Routing\Router;





class Api extends Router
{




    public function registerRoutes()
    {
        $this->all('get-all', '`/tag/get-all`', function() {

            $tagRepository = $this->getApplication()->getModelRepository(Tag::class);

            $tags = $tagRepository->getAll();

            echo json_encode($tags->getEntities());

        })->json()
        ->setBuilder('/tag/get-all')
        ;
        return parent::registerRoutes();
    }




}