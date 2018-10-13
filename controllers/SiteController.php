<?php

/**
 * Created by PhpStorm.
 * User: ROYAL
 * Date: 08-Sep-16
 * Time: 7:38 PM
 */



class SiteController
{
    public function actionIndex()
    {
        $categories = array();
        $categories = Category::getCategoryList();

        $prodLastList = array();
        $prodLastList = Product::getLatestProducts(3);

        $sliderItems = array();
        $sliderItems = Product::getRecommendedProducts();

        require_once ROOT . '/views/site/index.php';

        return true;
    }

    public static function actionContact()
    {
        $userEmail = '';
        $userText = '';
        $result = false;

        if (isset($_POST['submit'])) {
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];

            $errors = false;

            // validate email
            if (!User::checkEmail($userEmail)) {
                $errors[] = "Incorrect Email";
            }

            if ($errors === false) {
                $adminEmail = 'admin@rpr.by';
                $message = "Text: {$userText}. From {$userEmail}";
                $subject = 'Subject';
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }
        }

        require_once ROOT . '/views/site/contact.php';

        return true;
    }
}