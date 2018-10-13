<?php

/**
 * Created by PhpStorm.
 * User: ROYAL
 * Date: 09-Sep-16
 * Time: 1:14 PM
 */
class UserController
{
    public static function actionRegister()
    {
        $name = '';
        $email = '';
        $password = '';

        if(isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkName($name)) {
                $errors[] = "Fault on name";
            }
            if (!User::checkPassword($password)) {
                $errors[] = "Short pwd";
            }
            if (!User::checkEmail($email)) {
                $errors[] = 'Email is bad.';
            }
            if (!User::checkEmailExists($email)) {
                $errors[] = 'Email exists';
            }

            if ($errors == false) {
                $result = User::register($name, $email, $password);
            }
        }

        require_once ROOT . '/views/user/register.php';

        return true;
    }

    public static function actionLogin()
    {
        $email = '';
        $password = '';

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkEmail($email)) {
                $errors[] = 'Bad email.';
            }
            if (User::checkPassword($password)) {
                $errors[] = 'Too small password.';
            }

            // Check user existing
            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                $errors[] = 'Incorrect input or user doesn\'t exist';
            } else {
                // write into session
                User::auth($userId);

                // send user to the private area
                header("Location: /cabinet/");
            }
        }

        require_once ROOT . '/views/user/login.php';

        return true;
    }

    public static function actionLogout()
    {
        unset($_SESSION['user']);
        header("Location: /");
    }
}