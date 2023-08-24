<?php
namespace Mh\Shop\Controller;
use Mh\Shop\Repository\CategoryProductRepository;
use Mh\Shop\Repository\CategoryRepository;
use Mh\Shop\Repository\ProductRepository;
use Mh\Shop\Utility\View;
use Mh\Shop\DTO\DTO;
use MrStronge\SimpleRouter\Attributes\Get;
use MrStronge\SimpleRouter\Attributes\Post;


class ProductController extends View {

    protected ProductRepository $repository;
    protected CategoryRepository $categoryRepository;
    protected CategoryProductRepository $categoryProductRepository;

    public function __construct()
    {
        $this->repository = new ProductRepository();
        $this->categoryRepository = new CategoryRepository();
        $this->categoryProductRepository = new CategoryProductRepository();
    }

    //Die Daten, die aus dem Datenbank kommen anzeigen.
    #[Get('/products')]
    public function index(): void
    {
        $products = $this->repository->getProducts();
        $this->render('Product/index', ['products' => $products]);
    }

    /**
     * @param array<mixed> $args
     * @return void
     */
    #[Get('/product/{id}')]
    public function show(array $args): void
    {
        $product = $this->repository->get($args['id']);
        $categoryProduct = $this->categoryProductRepository->categoryBelongToProduct($args['id']);
        $this->render('Product/details', ['product' => $product, 'categoryProduct' => $categoryProduct]);
    }

    //Die Daten, die aus dem Datenbank kommen löschen.

    /**
     * @param array<mixed> $args
     * @return void
     */
    #[Get('/product/{id}/delete')]
    public function deleteId(array $args): void
    {
        $product = $this->repository->get($args['id']);
        $this->render('Product/delete', ['product' => $product]);
    }

    /**
     * @param array<mixed> $args
     * @return void
     */
    #[Post('/product/{id}/delete')]
    public function remove(array $args): void
    {
        $this->repository->delete($args['id']);
        $products = $this->repository->getProducts();
        $this->render('Product/index', ['products' => $products]);
    }

    /**
     * @param array<mixed> $args
     * @return void
     */
    #[Get('/product/{id}/edit')]
    public function edit(array $args): void
    {
        $edit = $this->repository->get($args['id']);
        $selectCategories = $this->categoryRepository->getCategoriesExceptOneById($args['id']);
        $this->render('Product/edit', ['edit' => $edit, 'selectCategories' => $selectCategories]);
    }

    /**
     * @param array<mixed> $args
     * @return void
     */
    #[Post('/product/{id}/edit')]
    public function update(array $args): void
    {
        if(!empty($_POST)) {
            $id = $args['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $category_id = $_POST['categories'];

            if(!empty($id)) {
               $this->categoryProductRepository->prepareProductCategoryRelation($id);
            }

            foreach ($category_id as $value) {
                $this->categoryProductRepository->insert($value, $id);
            }

            if(!empty($id) && !empty($name) && !empty($description)) {
                $this->repository->update($id, $name, $description);
                $products = $this->repository->getProducts();
                $this->render('Product/index', ['products' => $products]);
            }
        }

    }
}