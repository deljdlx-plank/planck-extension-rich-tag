<?php

namespace Planck\Extension\RichTag\Model\Traits;

use Planck\Extension\RichTag\Model\Entity\Tag;
use Planck\Extension\RichTag\Model\Repository\Association;

trait HasTags
{
    /**
     * @var Tag[]
     */
    private $tags;

    /**
     * @var Association
     */
    private $tagAssociationRepository;


    protected function _initializeTraitHasTags() {
        $this->tagAssociationRepository = $this->getApplication()->getModelRepository(Association::class);

    }

    public function getTags()
    {
        $tags = $this->tagAssociationRepository->getTagsByTargetFingerPrint(
           $this->getFingerPrint()
        );
        return $tags;
    }

    public function removeAllTags()
    {
        $this->tagAssociationRepository->deleteByTargetFingerPrint(
            $this->getFingerPrint()
        );

        return $this;

    }

    public function addTag($tag)
    {
        if($tag instanceof Tag) {
            $tag->associateByFingerPrint(
                $this->getFingerPrint()
            );
        }
        elseif((int) $tag) {
            $tagEntity = $this->application->getModelEntity(Tag::class);
            $tagEntity->loadById($tag);
            $tagEntity->associateByFingerPrint(
                $this->getFingerPrint()
            );
        }
        elseif((string) $tag) {
            $tagEntity = $this->application->getModelEntity(Tag::class);
            $tagEntity->setValue('name', $tag);
            $tagEntity->store();
            $tagEntity->associateByFingerPrint(
                $this->getFingerPrint()
            );
        }
        return $this;
    }


}


