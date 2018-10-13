<?php

/**
 * Created by PhpStorm.
 * User: ROYAL
 * Date: 08-Sep-16
 * Time: 7:50 PM
 */


class ProductController
{
    public function actionView($productId)
    {
        $categories = Category::getCategoryList();

        $productData = Product::getProductById($productId)[0];

        require_once ROOT . '/views/product/view.php';

        return true;
    }
}