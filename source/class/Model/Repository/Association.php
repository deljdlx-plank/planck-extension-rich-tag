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


        $rows = $this->queryAndFetch($query, array(
            ':fingerprint' => $fingerPrint,
        ));




        return $this->queryAndGetDataset($query, array(
            ':fingerprint' => $fingerPrint,
        ),             \Planck\Extension\RichTag\Model\Entity\Tag::class);
    }



}
