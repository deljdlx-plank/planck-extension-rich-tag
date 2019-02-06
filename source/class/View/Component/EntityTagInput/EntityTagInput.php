<?php


namespace Planck\Extension\RichTag\View\Component;



use Planck\View\Component;

class EntityTagInput extends Component
{

    public function loadEntityByFingerPrint($fingerPrint)
    {
        $entity = $this->getApplication()->getModelInstanceByFingerPrint($fingerPrint);
        $this->setVariable('entity', $entity);
    }

    public function loadEntityById($entityClassName, $entityId)
    {
        $entity = $this->getApplication()->getModelEntity($entityClassName);
        $entity->loadById($entityId);
        $this->setVariable('entity', $entity);
    }

    public function render()
    {
        $tagInput = new \Planck\Extension\RichTag\View\Element\TagInput();
        $tagInput->dom->setAttribute('data-name', 'entity_tags[]');

        $tagManager = $this->getApplication()->getModelRepository(\Planck\Extension\RichTag\Model\Repository\Tag::class);
        $tags = $tagManager->getTagsForEntity(
            $this->getVariable('entity')
        );

        $tagIdList = [];
        foreach ($tags as $tag) {
            $tagIdList[] = $tag->getId();
        }
        $tagInput->values($tagIdList);


        return $tagInput->render();
    }

}

