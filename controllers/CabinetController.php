<?php

/**
 * Created by PhpStorm.
 * User: ROYAL
 * Date: 09-Sep-16
 * Time: 6:10 PM
 */
class CabinetController
{
    public function actionIndex()
    {
        $userId = User::checkLogged();

        $user = User::getUserById($userId);

        require_once ROOT . '/views/cabinet/index.php';

        return true;
    }

    public function actionEdit()
    {
        $userId = User::checkLogged(); // get uID
        $user = User::getUserById($userId); // get user's data

        $userName = $user['name'];
        $userPass = $user['password'];

        if (isset($_POST['submit'])) {
            $userName = $_POST['name'];
            $userPass = $_POST['password'];

            $errors = false;

            if (!User::checkName($userName)) {
                $errors[] = 'Name: at least 2 symbols';
            }
            if (!User::checkPassword($userPass)) {
                $errors[] = 'Password: ar least 6 symbols';
            }

            $result = false;
            if ($errors == false) {
                $result = User::edit($userId, $userName, $userPass);
            }
        }

        require_once ROOT . '/views/cabinet/edit.php';

        return true;
    }
}