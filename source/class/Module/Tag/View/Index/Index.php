<?php

namespace Planck\Extension\RichTag\Module\Tag\View;


use Planck\View\Component;

class Index extends Component
{



    public function render()
    {
        $this->addJavascriptFile('vendor/quill/dist/quill.js', self::RESOURCE_PRIORITY_REQUIRE);
        $this->addCSSFile('vendor/quill/dist/snow.css');


        $this->dom->html(
            $this->obInclude(__DIR__.'/template.php', $this->getVariables())
        );

        return parent::render();
    }


}


