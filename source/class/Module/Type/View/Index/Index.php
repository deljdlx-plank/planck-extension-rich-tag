<?php

namespace Planck\Extension\RichTag\Module\Type\View;


use Planck\View\Component;

class Index extends Component
{



    public function render()
    {

        $this->dom->html(
            $this->obInclude(__DIR__.'/template.php', $this->getVariables())
        );

        return parent::render();
    }


}


