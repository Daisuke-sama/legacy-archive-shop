<?php

/**
 * Created by PhpStorm.
 * User: ROYAL
 * Date: 12-Sep-16
 * Time: 11:25 AM
 */
class AdminController extends AdminBase
{
    public function actionIndex()
    {
        self::checkAdmin();

        require_once ROOT . '/views/admin/index.php';

        return true;
    }
}