<?php

/**
 * Created by PhpStorm.
 * User: ROYAL
 * Date: 09-Sep-16
 * Time: 2:23 AM
 */

class Product
{
    const SHOW_BY_DEFAULT = 6;

    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);

        $db = Db::getConnection();

        $productsList = array();

        $result = $db->query('SELECT id, name, price, image, is_new FROM product '
            . 'WHERE status = "1" '
            . 'ORDER BY id DESC '
            . 'LIMIT ' . $count);

        if (isset($result) && !empty($result)) {
            $i = 0;
            while ($row = $result->fetch()) {
                $productsList[$i]['id'] = $row['id'];
                $productsList[$i]['name'] = $row['name'];
                $productsList[$i]['price'] = $row['price'];
                $productsList[$i]['image'] = $row['image'];
                $productsList[$i]['is_new'] = $row['is_new'];
                $i++;
            }
        }

        return $productsList;
    }

    public static function getProductListByCategory($categoryId = false, $page = 1)
    {
        if ($categoryId) {
            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            $db = Db::getConnection();
            $query = "SELECT id, name, image, price, is_new FROM product "
                . "WHERE status = '1' AND category_id = '$categoryId' "
                . "ORDER BY id DESC "
                . "LIMIT " . self::SHOW_BY_DEFAULT
                . " OFFSET " . $offset;

            $result = $db->query($query);

            $products = array();
            $i = 0;
            while($row = $result->fetch())
            {
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['image'] = $row['image'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['is_new'] = $row['is_new'];
                $i++;
            }

            return $products;
        }
    }

    public static function getProductById($productId)
    {
        $productId = intval($productId);

        if ($productId) {
            $db = Db::getConnection();
            $query = "SELECT * FROM product WHERE id = '$productId'";

            $result = $db->query($query);

            $productData = $result->fetchAll(PDO::FETCH_ASSOC);

            return $productData;
        }
    }

    public static function getProductsByIds($productsIds)
    {
        $statement = "SELECT * FROM product WHERE status = 1 AND id = :id";
        $products = array();

        $db = Db::getConnection();
        foreach ($productsIds as $pid) {
            $result = $db->prepare($statement);
            $result->bindParam(":id", $pid, PDO::PARAM_INT);
            $result->execute();

            $products[] = $result->fetch(PDO::FETCH_ASSOC);
        }

        return $products;
    }

    public static function getTotalProductsInCategory($categoryId)
    {
        $query = "SELECT count($categoryId) AS count FROM product WHERE status = 1 AND category_id = '$categoryId'";

        $db = Db::getConnection();
        $result = $db->query($query);

        $row = $result->fetch(PDO::FETCH_ASSOC);

        return $row['count'];
    }

    public static function getImage($id)
    {
        $statement = "SELECT image FROM product WHERE id = :id";

        $db = Db::getConnection();

        $result = $db->prepare($statement);
        $result->bindParam(":id", $id);
        $result->execute();

        $image = $result->fetch(PDO::FETCH_ASSOC);

        return $image['image'];
    }

    public static function getRecommendedProducts()
    {
        $statement = "SELECT * FROM product WHERE is_recommended = 1 AND status = 1";

        $db = Db::getConnection();

        $result = $db->query($statement);
        $recProds = false;
        $i = 0;
        while ($row = $result->fetch()) {
            $recProds[$i]['name'] = $row['name'];
            $recProds[$i]['price'] = $row['price'];
            $recProds[$i]['id'] = $row['id'];
            $recProds[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $recProds;
    }

    public static function getProductsList()
    {
        $statement = "SELECT id, name, code, price FROM product ORDER BY id ASC";

        $db = Db::getConnection();

        $result = $db->query($statement);

        $prodList = array();
        for ($i = 0; $row = $result->fetch(); $i++) {
            $prodList[$i]['id'] = $row['id'];
            $prodList[$i]['name'] = $row['name'];
            $prodList[$i]['code'] = $row['code'];
            $prodList[$i]['price'] = $row['price'];
        }

        return $prodList;
    }

    public static function deleteProductById($id)
    {
        $statement = "DELETE FROM product WHERE id = :id";
        $db = Db::getConnection();
        $result = $db->prepare($statement);
        $result->bindParam(":id", $id, PDO::PARAM_INT);

        return $result->execute(PDO::FETCH_ASSOC);
    }
}