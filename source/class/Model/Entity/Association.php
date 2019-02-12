<?php

namespace Planck\Extension\RichTag\Model\Entity;



use Planck\Model\Entity;
use Planck\Model\Traits\HasProperties;
use Planck\Model\Traits\IsTreeEntity;

class Association extends Entity
{
    use HasProperties;


    /**
     * @var Tag
     */
    protected $tag;



    public function setEntity(Entity $entity)
    {
        $this->target = $entity;
        $this->setValue('target_fingerprint', $entity->getFingerPrint());
        $this->setValue('target_id', $entity->getId());
        $this->setValue('target_type', get_class($entity));
        return $this;
    }

    public function setTag(Tag $tag)
    {
        $this->tag = $tag;
        $this->setValue('tag_id', $tag->getId());

        return $this;
    }






}
