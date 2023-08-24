<?php

namespace Mh\Shop\Controller;
use Mh\Shop\Repository\CategoryProductRepository;
use Mh\Shop\Repository\CategoryRepository;
use Mh\Shop\Repository\LoginRepository;
use Mh\Shop\Repository\ProductRepository;
use Mh\Shop\Utility\View;
use MrStronge\SimpleRouter\Attributes\Get;
use MrStronge\SimpleRouter\Attributes\Post;


class CategoryController extends View {

    protected CategoryRepository $repository;
    protected LoginRepository  $loginRepository;
    protected ProductRepository $productRepository;
    protected CategoryProductRepository $categoryProductRepository;

    public function __construct() {
        $this->repository  = new CategoryRepository();
        $this->loginRepository = new LoginRepository();
        $this->productRepository = new  ProductRepository();
        $this->categoryProductRepository = new CategoryProductRepository();
    }

    #[Get('/categories')]
    public function category(): void {
        $categories = $this->repository->getCategories();
        $this->render('Category/index', ['categories' => $categories]);
    }

    #[Get('/categories/match')]
    public function match(): void {
        $match = $this->repository->getSameCategoryWithIdAndParentId();
        $this->render('Category/test', ['match' => $match]);
    }

    //Die Daten, die aus dem Datenbank kommen löschen.

    /**
     * @param array<mixed> $args
     * @return void
     */
    #[Get('/category/{id}/delete')]
    public function deleteId(array $args): void {
        $categoryId = (int) $args['id'];
        $category = $this->repository->get($categoryId);
        $this->render('Category/delete', ['category' => $category]);
    }

    /**
     * @param array<mixed> $args
     * @return void
     */
    #[Post('/category/{id}/delete')]
    public function remove(array $args): void {
        $this->repository->delete($args['id']);
        $this->render('Category/index', []);
    }

    /**
     * @param array<mixed> $args
     * @return void
     */
    #[Get('/category/{id}/edit')]
    public function edit(array $args): void {
        $edit = $this->repository->get($args['id']);
        $selectCategories = $this->repository->getCategoriesExceptOneById($args['id']);
        $selectProducts = $this->productRepository->getProductsExceptOneById($args['id']);
        $this->render('Category/edit', ['edit' => $edit, 'selectCategories' => $selectCategories, 'selectProducts' => $selectProducts]);
    }

    /**
     * @param array<mixed> $args
     * @return void
     */
    #[Post('/category/{id}/edit')]
    public function editId(array $args): void {
        if(!empty($_POST)) {
            $id = $args['id'];
            $name = $_POST['name'];
            $parent_id = $_POST['parent_id'];
            $product_id = $_POST['products'];

            if(!empty($id)) {
                $this->categoryProductRepository->prepareCategoryProductRelation($id);
            }

            foreach ($product_id as $value) {
                $this->categoryProductRepository->insert($id, $value);
            }

            if (!empty($id) && !empty($name) && !empty($parent_id)) {
                $this->repository->update($id, $name, (int)$parent_id);
                $categories = $this->repository->getCategories();
                $this->render('Category/index', ['categories' => $categories]);
            }
        }
    }
}