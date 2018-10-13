<?php

/**
 * Created by PhpStorm.
 * User: ROYAL
 * Date: 12-Sep-16
 * Time: 11:30 AM
 */
class AdminProductController extends AdminBase
{
    public static function actionIndex()
    {
        self::checkAdmin();

        $prodList = Product::getProductsList();

        require_once ROOT . '/views/admin_product/index.php';
        return true;
    }

    public static function actionDelete($id)
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            Product::deleteProductById($id);

            header("location: /admin/product");
        }

        require_once ROOT . '/views/admin_product/delete.php';

        return true;
    }
}