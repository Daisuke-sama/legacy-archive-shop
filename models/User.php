<?php

/**
 * Created by PhpStorm.
 * User: ROYAL
 * Date: 09-Sep-16
 * Time: 1:22 PM
 */
class User
{
    public static function register($name, $email, $password)
    {
        $db = Db::getConnection();

        $query = "INSERT INTO user (name, email, password) VALUES (:name, :email, :password)";
        $result = $db->prepare($query);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function checkUserData($email, $password)
    {
        $db = Db::getConnection();

        $query = "SELECT * FROM user WHERE email = :email AND password = :password";
        $result = $db->prepare($query);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);
        $result->execute();

        $user = $result->fetch();
        if (isset($user) && $user) {
            return $user['id'];
        }

        return false;
    }

    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /user/login");
    }

    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    public static function getUserById($id)
    {
        $id = intval($id);

        $db = Db::getConnection();

        $statement = "SELECT * FROM user WHERE id = :id";

        $result = $db->prepare($statement);
        $result->bindParam(":id", $id);
        $result->execute();

        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function edit($userId, $userName, $userPassword)
    {
        $userId = intval($userId);

        $db = Db::getConnection();

        $statement = "UPDATE user SET name = :uname, password = :upassword WHERE id = :id";

        $result = $db->prepare($statement);
        $result->bindParam(":uname", $userName, PDO::PARAM_STR);
        $result->bindParam(":upassword", $userPassword, PDO::PARAM_STR);
        $result->bindParam(":id", $userId, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function checkName($string)
    {
        if(mb_strlen($string) >= 2) {
            return true;
        }

        return false;
    }

    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }

    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }

        return false;
    }

    public static function checkEmailExists($email)
    {
        $db = Db::getConnection();
        $query = 'SELECT count(*) FROM user WHERE email = :email';

        $result = $db->prepare($query);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn()){
            return false;
        }
        return true;
    }

    public static function checkPhone($phone)
    {
        if(!is_integer($phone)) {
            return false;
        }
    }
}