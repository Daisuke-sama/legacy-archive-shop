<?php

/**
 * Created by PhpStorm.
 * User: ROYAL
 * Date: 10-Sep-16
 * Time: 1:38 AM
 */
class Cart
{
    public static function getProducts()
    {
        if (isset($_SESSION['products']) && !empty($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return [];
    }

    public static function addProduct($id)
    {
        $id = intval($id);

        $productsInCart = array();

        if (isset($_SESSION['products'])) {
            $productsInCart = $_SESSION['products'];
        }

        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id]++;
        } else {
            $productsInCart[$id] = 1;
        }

        $_SESSION['products'] = $productsInCart;
    }

    public static function addProductA($id)
    {
        self::addProduct($id);

        return self::countItems();
    }

    public static function countItems()
    {
        if (isset($_SESSION['products'])) {
            $count = 0;

            foreach ($_SESSION['products'] as $id => $quantity) {
                $count += $quantity;
            }

            return $count;
        }

        return 0;
    }

    public static function getTotalPrice($products)
    {
        $countProds = count($products);
        if (!empty($products) && !isset($_SESSION['products']) && (count($_SESSION['products']) != $countProds) ) {
            return 0;
        }

        $total = 0;
        for ($i = 0; $i < $countProds; $i++) {
            $id = $products[$i]['id'];
            $total += $products[$i]['price'] * $_SESSION['products'][$id];
        }

        return $total;
    }

    public static function clear()
    {
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
    }

    public static function deleteProduct($id)
    {
        $prodlist = self::getProducts();

        unset($prodlist[$id]);

        $_SESSION['products'] = $prodlist;
    }
}