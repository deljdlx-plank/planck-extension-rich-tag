<?php

namespace Planck\Extension\RichTag\Module\Tag\View;


use Planck\Extension\FrontVendor\Package\Quill;
use Planck\Extension\FrontVendor\Package\Tree;
use Planck\View\Component;

class Index extends Component
{


    public function __construct($tagName = '')
    {
        parent::__construct($tagName);
        $this->addFrontPackage(
            new Tree()
        );
        $this->addFrontPackage(
           new Quill()
        );
    }


    public function render()
    {

        $this->dom->html(
            $this->obInclude(__DIR__.'/template.php', $this->getVariables())
        );

        return parent::render();
    }


}


