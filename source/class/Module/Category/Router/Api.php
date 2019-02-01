<?php


namespace Planck\Extension\RichTag\Module\Category\Router;



use Planck\Extension\RichTag\Model\Entity\Category;
use Planck\Extension\ViewComponent\TreeFormater;
use Planck\Route;
use Planck\Router;





class Api extends Router
{




    public function registerRoutes()
    {


        $this->delete('delete-branch', '`/tag/api/category/delete-branch`', function () {
            $data = $this->request->getBodyData();

            $category = $this->application->getModelEntity(Category::class);
            $category->loadById($data['id']);

            $category->deleteBranch(true);

            echo json_encode($category);

        })->json();



        $this->delete('delete', '`/tag/api/category/delete`', function () {
            $data = $this->request->getBodyData();

            $category = $this->application->getModelEntity(Category::class);
            $category->loadById($data['id']);
            $category->delete();
            echo json_encode($category);
        })->json();


        $this->post('save', '`/tag/api/category/save`', function() {

            $data = $this->post();

            $parentCategory = $this->application->getModelEntity(Category::class);
            $parentCategory->loadById($data['parent_id']);

            $newCategory = $this->application->getModelEntity(Category::class);
            $newCategory->setValues($data);
            $newCategory->setParent($parentCategory);

            $newCategory->store();

            $formater = new TreeFormater();

            echo json_encode($formater->getNodeFromEntity(
                $newCategory
            ));

        })->json();


        $this->post('move', '`/tag/api/category/move`', function() {

            /**
             * @var Route $route
             */
            $route = $this->getRouter()->getRouteByName('save');
            $route->setRequest($this->request);
            $route->execute();
            echo $route->getOutput();

        })->json()
        ;



        $this->get('get-tree', '`/tag/api/category/get-tree`', function() {

            $repository = $this->application->getModelRepository(\Planck\Extension\RichTag\Model\Repository\Category::class);
            $tree = $repository->getTree(null, 0);
            $formater = new TreeFormater();
            echo json_encode(
                $formater->getTreeFromNodeList($tree)
            );
        })->json()
        ;

        $this->get('initialize', '`/tag/api/category/initialize`', function() {



            $category = $this->application->getModelEntity(Category::class);

            $root = $category->getRoot(true);
            if(!$root) {
                $root = $this->application->getModelEntity(Category::class);
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