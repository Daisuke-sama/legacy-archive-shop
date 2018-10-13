<?php

/**
 * Created by PhpStorm.
 * User: ROYAL
 * Date: 12-Sep-16
 * Time: 11:31 AM
 */
abstract class AdminBase
{
    public static function checkAdmin()
    {
        $userId = User::checkLogged();

        $user = User::getUserById($userId);

        if ($user['role'] == 'admin')
        {
            return true;
        }

        die('Access denied');
    }
}