<?php

namespace Planck\Extension\RichTag\Model\Repository;




use Planck\Model\Repository;
use Planck\Model\Traits\IsTreeRepository;

class Association extends Repository
{


    protected static $tableName = 'tag_association';



    public function getByTargetFingerPrint($fingerPrint)
    {
        $query = "
            SELECT * FROM ".$this->getTableName()."
            WHERE target_fingerprint = :fingerprint
        ";

        return $this->queryAndGetDataset($query, array(
            ':fingerprint' => $fingerPrint
        ));
    }


    public function getEntitiesByTag(\Planck\Extension\RichTag\Model\Entity\Tag $tag, $targetType)
    {
        $targetEntity = $this->model->getEntity($targetType);
        $targetRepository = $targetEntity->getRepository();

        $query = "
            SELECT ".$targetRepository->getEntityFieldsString('entity.')."
                FROM ".$this->getTableName()." association
                JOIN ".$targetRepository->getTableName()." entity
                    ON association.target_id = entity.".$targetEntity->getPrimaryKeyFieldName()." 
                WHERE
                    association.tag_id = :tag_Id
                    AND association.target_type = :target_type
                ORDER BY
                    entity.creation_date DESC,
                    entity.update_date DESC
        ";


        $dataset = $this->queryAndGetDataset($query, array(
            ':tag_Id' => $tag->getId(),
            ':target_type' => $targetType
        ), $targetType);

        return $dataset;

    }



    public function deleteByTargetFingerPrint($fingerPrint)
    {
        $query = "
            DELETE FROM ".$this->getTableName()."
            WHERE target_fingerprint = :fingerprint;
        ";

        $this->query($query, array(
            ':fingerprint' => $fingerPrint
        ));
        return $this;
    }


    public function getTagsByTargetFingerPrint($fingerPrint)
    {
        $tagRepository = $this->getApplication()->getModelRepository(Tag::class);
        $query = "
            SELECT ".$tagRepository->getEntityFieldsString('tag.')."
                FROM ".$tagRepository->getTableName()." tag
            JOIN ".$this->getTableName()." association
                ON tag.id = association.tag_id
            WHERE association.target_fingerprint = :fingerprint
        ";



        return $this->queryAndGetDataset($query, array(
            ':fingerprint' => $fingerPrint,
        ),             \Planck\Extension\RichTag\Model\Entity\Tag::class);
    }



}
