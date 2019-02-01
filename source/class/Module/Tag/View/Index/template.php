<div>

    <?php

    $tagURLSubmit='?/tool/route/dump';


    $categoryTreeURL ='?/tag/api/category/get-tree';
    $typeTreeURL = '?/tag/api/type/get-tree';


    $form = new Planck\Extension\ViewComponent\View\Component\Form();

    $form->method('post');
    $form->action($tagURLSubmit);

    $form->setFieldWrapper(
        function($element) {
            $wrapper = new \Phi\HTML\Element\Div();
            $wrapper->css('border', 'solid 2px #F00');
            //$label = $element->find('label');
            //$label->css('background-color', '#FAA');
            $wrapper->addChild($element);
            return $wrapper;
        }
    );



    $form->addField('tags[]', array(
        'label' => $this->i18n('tag'),
        'type' => 'tag',
        'value' => array(
          0,4
        ),
        'options' => array(
            'source' => '?/tool/fixture/get',
            'labelField'=>'',
        )
    ));



    $form->addField('category_id', array(
        'label' => $this->i18n('Catégorie'),
        'value' => 'test',
        'type' => 'tree',
        'options' => array(
            'source' => $categoryTreeURL,
        )
    ));

    $form->addField('type_id', array(
        'label' => $this->i18n('Type'),
        'value' => 'test',
        'type' => 'tree',
        'options' => array(
            'source' => $typeTreeURL,
        )
    ));



    $form->addField('name', array(
        'label' => $this->i18n('Libellé'),
        'placeholder' => 'hello world',

    ));


    $form->addField('name2', array(
        'label' => $this->i18n('Libellé'),
        'placeholder' => 'hell world',
        'value' => 'here the value',
    ));


    $form->addField('description', array(
        'label' => $this->i18n('Description'),
        'type' => 'text',
        'value' => 'hello world !'
    ));


    $form->addField('select-test', array(
        'label' => $this->i18n('select'),
        'type' => 'select',
        'options' => array(
            'items' => array(
                0 => 'item1',
                1 => 'item2',
            )
        )
    ));

    $form->addField('radio', array(
        'label' => $this->i18n('radio'),
        'type' => 'radio',
        'options' => array(
            'items' => array(
                0 => 'item1',
                1 => 'item2',
            ),
            'itemWrapper' => function($element) {
                $wrapper = new \Phi\HTML\Element\Li();
                $wrapper->addChild($element);
                return $wrapper;
            }
        )
    ));



    $form->addChild(
        (new \Phi\HTML\Element\Button())->html('hello world')

    );


    echo $form->render();



    ?>







</div>

