<?php


namespace Planck\Extension\RichTag\Module\Type\Router;



use Planck\Extension\RichTag\Model\Entity\Type;
use Planck\Extension\ViewComponent\TreeFormater;
use Planck\Route;
use Planck\Router;





class Api extends Router
{




    public function registerRoutes()
    {


        $this->delete('delete-branch', '`/tag/api/type/delete-branch`', function () {
            $data = $this->request->getBodyData();

            $type = $this->application->getModelEntity(Type::class);
            $type->loadById($data['id']);
            $type->deleteBranch(true);

            echo json_encode($type);

        })->json();



        $this->delete('delete', '`/tag/api/type/delete`', function () {
            $data = $this->request->getBodyData();

            $category = $this->application->getModelEntity(Type::class);
            $category->loadById($data['id']);
            $category->delete();
            echo json_encode($category);
        })->json();


        $this->post('save', '`/tag/api/type/save`', function() {

            $data = $this->post();

            $parentType = $this->application->getModelEntity(Type::class);
            $parentType->loadById($data['parent_id']);

            $newType = $this->application->getModelEntity(Type::class);
            $newType->setValues($data);
            $newType->setParent($parentType);

            $newType->store();

            $formater = new TreeFormater();

            echo json_encode($formater->getNodeFromEntity(
                $newType
            ));

        })->json();


        $this->post('move', '`/tag/api/type/move`', function() {

            /**
             * @var Route $route
             */
            $route = $this->getRouter()->getRouteByName('save');
            $route->setRequest($this->request);
            $route->execute();
            echo $route->getOutput();

        })->json()
        ;



        $this->get('get-tree', '`/tag/api/type/get-tree`', function() {

            $repository = $this->application->getModelRepository(\Planck\Extension\RichTag\Model\Repository\Type::class);
            $tree = $repository->getTree(null, 0);
            $formater = new TreeFormater();
            echo json_encode(
                $formater->getTreeFromNodeList($tree)
            );
        })->json()
        ;

        $this->get('initialize', '`/tag/api/type/initialize`', function() {



            $category = $this->application->getModelEntity(Type::class);

            $root = $category->getRoot(true);
            if(!$root) {
                $root = $this->application->getModelEntity(Type::class);
                $root->setValue('name', 'root');
                $root->store();
            }
            echo json_encode(
                $root->toExtendedArray()
            );


        })->json();







        return parent::registerRoutes();
    }

}