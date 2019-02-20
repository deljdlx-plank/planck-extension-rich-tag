<?php


namespace Planck\Extension\RichTag\Module\Category\Router;



use Planck\Extension\EntityEditor\EntityTreeApiRouter;
use Planck\Extension\RichTag\Model\Entity\Category;



class Api extends EntityTreeApiRouter
{



    public function getEntity()
    {
        return $this->application->getModelEntity(Category::class);
    }

    public function getRepository()
    {
        return $this->application->getModelRepository(\Planck\Extension\RichTag\Model\Repository\Category::class);
    }

    public function getRoutePath()
    {
        return '/tag/category/api';
    }


}