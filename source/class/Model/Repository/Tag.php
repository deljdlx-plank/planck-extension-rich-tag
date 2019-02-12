<?php

namespace Planck\Extension\RichTag\Model\Repository;




use Planck\Exception;
use Planck\Model\Entity;
use Planck\Model\Repository;


use \Planck\Extension\RichTag\Model\Entity\Association as AssociationEntity;

class Tag extends Repository
{


    protected static $tableName = 'tag';




    public function store(\Phi\Model\Entity $object, $dryRun = false)
    {

        if(!$object->getValue('slug')) {
            $object->setSlug();
        }
        return parent::store($object, $dryRun);
    }


    public function createIfNotExists($label)
    {
        $tagDataset = $this->getBy('name', $label);
        if($tagDataset->length()) {
            return $tagDataset[0];
        }
        else {
            $tag = $this->getEntityInstance();
            $tag->setValue('name', $label);
            $tag->store();
            return $tag;
        }
    }



    public function normalizeName($name)
    {
        $name = trim($name);
        if(!strlen($name)) {
            throw new Exception('Invalid tag name');
        }
        return $name;
    }


    public function tagEntity(Entity $entity, \Planck\Extension\RichTag\Model\Entity\Tag $tag)
    {
        /**
         * @var \Planck\Extension\RichTag\Model\Entity\Association $association
         */
        $association = $this->getApplication()->getModelEntity(AssociationEntity::class);
        $association->setTag($tag);
        $association->setEntity($entity);
        $association->store();
        return $association;
    }

    public function getTagsForEntity(Entity $entity)
    {
        $associationRepository = $this->getApplication()->getModelRepository(Association::class);
        return $associationRepository->getTagsByTargetFingerPrint($entity->getFingerPrint());
    }

    public function clearTagsForEntity(Entity $entity)
    {
        $associationRepository = $this->getApplication()->getModelRepository(Association::class);
        $associationRepository->deleteByTargetFingerPrint($entity->getFingerPrint());
        return $this;
    }



}
