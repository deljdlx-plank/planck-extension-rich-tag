<?php


namespace Planck\Extension\RichTag\Module\Type\Router;



use Planck\Extension\EntityEditor\EntityTreeApiRouter;
use Planck\Extension\RichTag\Model\Entity\Type;



class Api extends EntityTreeApiRouter
{


    public function getEntity()
    {
        return $this->application->getModelEntity(Type::class);
    }

    public function getRepository()
    {
        return $this->application->getModelRepository(\Planck\Extension\RichTag\Model\Repository\Type::class);
    }

    public function getRoutePath()
    {
        return '/tag/type/api';
    }

}