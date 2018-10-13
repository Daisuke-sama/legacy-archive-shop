<?php

/**
 * Created by PhpStorm.
 * User: ROYAL
 * Date: 07-Sep-16
 * Time: 11:43 PM
 */
class Db
{
    public static function getConnection()
    {
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include $paramsPath;

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";

        try {
            $db = new PDO($dsn, 'root', $params['password']);
            $db->exec("set names utf8");

            return $db;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $db;
    }
}