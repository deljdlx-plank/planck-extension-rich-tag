<?php

namespace Planck\Extension\RichTag\Model\Entity;



use Planck\Helper\StringUtil;
use Planck\Model\Entity;
use Planck\Model\Traits\HasProperties;

use Planck\Extension\RichTag\Model\Repository\Association as AssociationRepository;

class Tag extends Entity
{
    use HasProperties;



    public function getAssociatedEntities($entityClassName)
    {
        $repository = $this->getApplication()->getModelRepository(AssociationRepository::class);




        return $repository->getEntitiesByTag($this, $entityClassName);
    }


    public function setName($value)
    {
        $this->setValue('name', $value);
        $this->setValue('slug', StringUtil::slugify($value));
        return $this;
    }


    public function setSlug($slug = null)
    {
        if($slug === null) {
            $slug = StringUtil::slugify($this->getValue('name'));
        }
        $this->setValue('slug', $slug);
        return $this;
    }


    public function associateByFingerPrint($fingerPrint)
    {
        $association = $this->application->getModelEntity(Association::class);
        $association->setValue('target_fingerprint', $fingerPrint);
        $association->setValue('tag_id', $this->getId());
        $association->store();
        return $association;
    }

}
