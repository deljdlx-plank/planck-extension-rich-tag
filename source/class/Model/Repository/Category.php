<?php

namespace Planck\Extension\RichTag\Model\Repository;




use Planck\Model\Repository;
use Planck\Model\Traits\IsTreeRepository;

class Category extends Repository
{

    use IsTreeRepository;

    protected static $tableName = 'tag_category';
}
