<?php

/**
 * Created by PhpStorm.
 * User: ROYAL
 * Date: 09-Sep-16
 * Time: 2:07 AM
 */
class Category
{
        public static function getCategoryList()
        {
            $db = Db::getConnection();

            $categoryList = array();

            $query = "SELECT id, name FROM category ORDER BY sort_order ASC";

            $result = $db->query($query);

            $i = 0;
            while($row = $result->fetch()) {
                $categoryList[$i]['id'] = $row['id'];
                $categoryList[$i]['name'] = $row['name'];
                $i++;
            }

            return $categoryList;
        }
}