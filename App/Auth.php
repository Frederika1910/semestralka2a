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
            if ($user->getLogin() == $login && $user->getPassword() == $password) {
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
            if ($user->getLogin() === $login && $user->getPassword() === $password) {
                return $user;
            }
        }

        return null;
    }


    public static function isLogged()
    {
        return isset($_SESSION['login']);
    }

    public static function isAdmin() {
        return isset($_SESSION['admin']);
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