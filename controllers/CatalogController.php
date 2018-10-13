<?php

/**
 * Created by PhpStorm.
 * User: ROYAL
 * Date: 09-Sep-16
 * Time: 3:24 AM
 */

class CatalogController
{
    public static function actionIndex()
    {
        $categories = Category::getCategoryList();

        $prodLastList = array();
        $prodLastList = Product::getLatestProducts(3);

        include_once ROOT . '/views/catalog/index.php';

        return true;
    }

    public static function actionCategory($categoryId, $page = 1)
    {

        $categories = Category::getCategoryList();

        $productsFromCategory = Product::getProductListByCategory($categoryId, $page);
        $totalProducts = Product::getTotalProductsInCategory($categoryId);

        // paginating
        $pagination = new Pagination($totalProducts, $page, Product::SHOW_BY_DEFAULT, 'page-');


        include_once ROOT . '/views/catalog/category.php';

        return true;
    }
}