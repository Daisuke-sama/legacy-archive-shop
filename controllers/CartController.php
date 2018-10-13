<?php

/**
 * Created by PhpStorm.
 * User: ROYAL
 * Date: 10-Sep-16
 * Time: 1:34 AM
 */
class CartController
{
    public function actionIndex()
    {
        $categories = Category::getCategoryList();

        $productsInCart = false;

        $productsInCart = Cart::getProducts();

        if (!empty($productsInCart)) {
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductsByIds($productsIds);

            $totalPrice = Cart::getTotalPrice($products);
        }

        require_once ROOT . '/views/cart/index.php';

        return true;
    }

    public function actionAdd($id)
    {
        Cart::addProduct($id);

        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }

    public function actionAddAjax($id)
    {
        echo Cart::addProductA($id);
        return true;
    }

    public function actionCheckout()
    {
        $categories = Category::getCategoryList();

        $result = false;

        $productsInCart = Cart::getProducts();
        $productsIds = array_keys($productsInCart);
        $products = Product::getProductsByIds($productsIds);
        $totalPrice = Cart::getTotalPrice($products);
        $totalQuantity = Cart::countItems();

        if (isset($_POST['submit'])) {
            // form was sent
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $comment = $_POST['comment'];

            $errors = false;
            if (!User::checkName($name)) {
                $errors[] = 'Name is too short.';
            }

            if ($errors == false) {
                $productsInCart = Cart::getProducts();

                if (!User::isGuest()) {
                    $userId = User::checkLogged();
                } else {
                    $userId = false;
                }

                $result = Order::save($name, $phone, $comment, $userId, $productsInCart);

                if ($result) {
                    $adminEmail = 'admin@rpr.by';
                    $message = 'http://oop2.php/admin/orders';
                    $subject = 'New order';
                    mail($adminEmail, $subject, $message);

                    Cart::clear();
                }
            }
        } else {
            // form wasn't sent
            $productsInCart = Cart::getProducts();

            if ($productsInCart == false) {
                header("Location: /");
            } else {
                $name = $phone = $comment = false;

                if (!User::isGuest()) {
                    $userId = User::checkLogged();
                    $user = User::getUserById($userId);

                    $name = $user['name'];
                }
            }
        }

        include_once ROOT . '/views/cart/checkout.php';
    }

    public function actionDelete($id)
    {
        Cart::deleteProduct($id);

        header("Location: /cart");
    }
}