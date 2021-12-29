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
        $username = $this->request()->getValue('username');
        $surname = $this->request()->getValue('surname');
        $login = $this->request()->getValue('login');
        $password = $this->request()->getValue('password');
        $passwordControl = $this->request()->getValue('confirmPassword');

        $alreadyExist = Auth::register($login);
        if ($alreadyExist) {
            $this->redirect('auth', 'registerForm', ['error' => 'Užívateľ s danou adresou je už registrovaný.']);
        } else {
            $newUser = new User();
            $newUser->setLogin($login);
            $newUser->setPassword($password);
            $newUser->setName($username);
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

        $userExist = Auth::getUser($login, $oldP);
        if ($userExist != null) {
            if ($newPControl == $newP) {
                $updatedUser = new User();
                $updatedUser->setLogin($login);
                $updatedUser->setPassword($newP);
                $updatedUser->setName($userExist->getName());
                $updatedUser->setSurname($userExist->getSurname());
                $updatedUser->save();
                $userExist->delete();
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