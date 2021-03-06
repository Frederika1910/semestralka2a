<?php

namespace App;
use App\Core\DB\Connection;
use App\Models\User;

class Auth
{

    public static function login($login, $password)
    {
        $users = User::getAll();
        foreach ($users as $user) {
            if ($user->getLogin() == $login && password_verify($password, $user->getPassword())) {
                return true;
            }
        }

        return false;
    }

    public static function setSession($login)
    {
        $_SESSION['login'] = $login;
    }

    public static function register($login)
    {
        $users = User::getAll();
        foreach ($users as $user) {
            if ($user->getLogin() === $login) {
                return true;
            }
        }

        return false;
    }

    public static function getUser($login, $password)
    {
        $users = User::getAll();
        foreach ($users as $user) {
            if ($user->getLogin() === $login && password_verify($password, $user->getPassword())) {
                return $user;
            }
        }

        return null;
    }

    public static function getId()
    {
        $currentUser = $_SESSION['login'];
        $users = User::getAll();
        foreach ($users as $user) {
            if (strcmp($currentUser, $user->getLogin()) == 0) {
                return $user->getId();
            }
        }

        return -1;
    }

    public static function isLogged()
    {
        return isset($_SESSION['login']);
    }

    public static function isAdmin() {
        $currentUser = $_SESSION['login'];
        $users = User::getAll();
        foreach ($users as $user) {
            if (strcmp($currentUser, $user->getLogin()) == 0 && strcmp($user->getAdmin(), "true") == 0) {
                return true;
            }
        }

        return false;
    }


    public static function getName()
    {
        return (Auth::isLogged() ? $_SESSION['login']:'');
    }

    public static function logout()
    {
        unset($_SESSION['login']);
        session_destroy();
    }
}