<?php

namespace Planck\Extension\RichTag\Model\Entity;



use Planck\Model\Entity;
use Planck\Model\Traits\HasProperties;


class Tag extends Entity
{
    use HasProperties;


    public function associateByFingerPrint($fingerPrint)
    {
        $association = $this->application->getModelEntity(Association::class);
        $association->setValue('target_fingerprint', $fingerPrint);
        $association->setValue('tag_id', $this->getId());
        $association->store();
        return $association;
    }

}
