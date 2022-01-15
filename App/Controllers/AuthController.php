<?php

namespace App\Controllers;

use App\Auth;
use App\Core\Model;
use App\Core\Responses\Response;
use App\Models\User;
use http\Message;

class AuthController extends AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index()
    {
    }

    public function loginForm()
    {
        return $this->html(
            [
                'error' => $this->request()->getValue('error')
            ]
        );
    }

    public function registerForm()
    {
        return $this->html(
            [
                'error' => $this->request()->getValue('error')
            ]
        );
    }

    public function cancelAccount()
    {
        return $this->html(
            [
                'error' => $this->request()->getValue('error')
            ]
        );
    }

    public function changePassword()
    {
        return $this->html(
            [
            'error' => $this->request()->getValue('error')
            ]
        );
    }

    public function login()
    {
        $login = $this->request()->getValue('login');
        $password = $this->request()->getValue('password');

        //$loginVal = User::validateEmail($login);
        //$passwordVal = User::validatePassword($password, null);
        //if ($loginVal != null) {
          //  exit($loginVal);
        //} else if ($passwordVal != null) {
        //    exit($passwordVal);
        //}

        //$login = User::getAll("login='{$_POST['login']}'");
        //$user = User::getAll('login=?', [$_POST['login']]);

        $userExist = Auth::login($login, $password);
        if ($userExist) {
            Auth::setSession($login);
            $this->redirect('home','loggedUser');
        } else {
            //loginView lebo chcem aby sa uzivatelovi ukazal formular znova
            $this->redirect('auth', 'loginForm', ['error' => 'Nesprávne prihlasovacie údaje.']);
        }
    }

    public function register()
    {
        $name = $this->request()->getValue('username');
        $surname = $this->request()->getValue('surname');
        $login = $this->request()->getValue('login');
        $password = $this->request()->getValue('password');
        $passwordControl = $this->request()->getValue('confirmPassword');

        $nameVal = User::validateName($name);
        $surnameVal = User::validateSurname($surname);
        $loginVal = User::validateEmail($login);
        $passwordVal = User::validatePassword($password, $passwordControl);
        if ($nameVal != null) {
            exit($nameVal);
        } else if ($surnameVal != null) {
            exit($surnameVal);
        } else if ($loginVal != null) {
            exit($loginVal);
        } else if ($passwordVal != null) {
            exit($passwordVal);
        }

        $alreadyExist = Auth::register($login);
        if ($alreadyExist) {
            $this->redirect('auth', 'registerForm', ['error' => 'Užívateľ s danou adresou je už registrovaný.']);
        } else {
            $newUser = new User();
            $newUser->setLogin($login);

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $newUser->setPassword($hash);
            $newUser->setName($name);
            $newUser->setSurname($surname);
            $newUser->save();

            $this->redirect('auth', 'loginForm');
        }
    }

    public function delete()
    {
        $login = Auth::getName();
        $users = User::getAll();

        foreach ($users as $user) {
            if ($user->getLogin() == $login) {
                Auth::logout();
                $user->delete();
                $this->redirect('home');
            }
        }

        $this->redirect('home');
    }

    public function changePass() {
        $login = Auth::getName();
        $oldP = $this->request()->getValue('oldPass');
        $newP = $this->request()->getValue('newPass');
        $newPControl = $this->request()->getValue('newPassControl');

        $passwordVal = User::validatePassword($oldP, $newP);

        $userExist = Auth::getUser($login, $oldP);
        if ($userExist != null) {
            if ($newPControl == $newP) {
                $hash = password_hash($newP, PASSWORD_DEFAULT);
                $userExist->setPassword($hash);
                $userExist->save();
                Auth::logout();
                $this->redirect('auth', 'loginForm');
            }
        } else {
            $this->redirect('auth', 'changePassword', ['error' => 'Zadané staré heslo nebolo správne.']);
        }
    }

    public function logout()
    {
        Auth::logout();
        $this->redirect('home');
    }


}