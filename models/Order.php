<?php

/**
 * Created by PhpStorm.
 * User: ROYAL
 * Date: 11-Sep-16
 * Time: 11:36 PM
 */
class Order
{
    public static function save($userName, $userPhone, $userComment, $userId, $products)
    {
        $db = Db::getConnection();

        $statement = "INSERT INTO product_order(user_name, user_phone, user_comment, user_id, products)"
            . "VALUES (:un, :up, :uc, :ui, :prs)";

        $products = json_encode($products);

        $result = $db->prepare($statement);
        $result->bindParam(":un", $userName);
        $result->bindParam(":up", $userPhone);
        $result->bindParam(":uc", $userComment);
        $result->bindParam(":ui", $userId);
        $result->bindParam(":prs", $products);

        return $result->execute();
    }
}