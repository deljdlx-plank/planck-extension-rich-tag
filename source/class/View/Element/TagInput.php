<?php

namespace Planck\Extension\RichTag\View\Element;

use Planck\Extension\RichTag;

class TagInput extends \Planck\Extension\Redactor\View\Component\TagInput
{

    public function __construct($tagName = 'div')
    {
        parent::__construct($tagName);



        $this->setSource(
            $this->getApplication()->getExtension(RichTag::class)->buildURL(
                'Tag',
                    'Api',
                'get-all'
            )
        );
    }

}


