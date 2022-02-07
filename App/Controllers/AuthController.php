<?php

namespace App\Controllers;

use App\Auth;
use App\Core\Model;
use App\Core\Responses\Response;
use App\Models\Cart;
use App\Models\Order;
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

        $er = "";
        $nameVal = User::validateName($name);
        $surnameVal = User::validateSurname($surname);
        $loginVal = User::validateEmail($login);
        $passwordVal = User::validatePassword($password, $passwordControl);

        if ($nameVal != null) {
            $er .= $nameVal . '<br>';
        }
        if ($surnameVal != null) {
            $er .= ($surnameVal) . '<br>';
        }
        if ($loginVal != null) {
            $er .=  ($loginVal) . '<br>';
        }
        if ($passwordVal != null) {
            $er .= ($passwordVal) . '<br>';
        }

        if (strlen($er) != 0) {
            $this->redirect('auth', 'registerForm', ['error' => $er]);
            return;
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
        $id = Auth::getId();
        $deleteUser = User::getOne($id);
        $carts = Cart::getAll('user_id=?',[$deleteUser->getId()]);
        $orders = Order::getAll('user_id=?',[$deleteUser->getId()]);

        foreach ($carts as $cart) {
            $cart->delete();
        }

        foreach ($orders as $order) {
            $order->delete();
        }

        Auth::logout();
        $deleteUser->delete();
        $this->redirect('home');
    }

    public function changePass() {
        $login = Auth::getName();
        $oldP = $this->request()->getValue('oldPass');
        $newP = $this->request()->getValue('newPass');
        $newPControl = $this->request()->getValue('newPassControl');

        $er = "";
        $passwordVal = User::validatePassword($newP, $newPControl);
        if ($passwordVal != null) {
            $er .= ($passwordVal);
        }

        if (strlen($er) != 0) {
            $this->redirect('auth', 'changePassword', ['error' => $er]);
            return;
        }

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