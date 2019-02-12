<?php

namespace Planck\Extension\RichTag\Decorator;


use Planck\Extension\RichTag\Model\Repository\Tag;
use Planck\Model\Decorator\Entity as EntityDecorator;
use \Planck\Model\Entity;


class Taggable extends EntityDecorator
{

    /**
     * @var Tag
     */
    private $tagRepository;


    public function __construct(Entity $object)
    {
        parent::__construct($object);
        $this->tagRepository = $object->getApplication()->getModelRepository(Tag::class);
    }


    public function getTags()
    {
        $tags = $this->tagRepository->getTagsForEntity($this->getDecoratedObject());
        return $tags;
    }



}
