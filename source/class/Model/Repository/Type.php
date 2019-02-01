<?php

namespace Planck\Extension\RichTag\Model\Repository;




use Planck\Model\Repository;
use Planck\Model\Traits\IsTreeRepository;

class Type extends Repository
{

    use IsTreeRepository;

    protected static $tableName = 'tag_type';
}
