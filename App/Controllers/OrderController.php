<?php

namespace App\Controllers;

use App\Core\Responses\Response;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;

class OrderController extends AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index()
    {

    }

    public function orderForm()
    {
        $orders = Cart::getAll();

        return $this->html(
            [
                'shopping_cart' => $orders
            ]);
    }

    public function paymentForm() {

        $orders = Cart::getAll();

        return $this->html(
            [
                'shopping_cart' => $orders
            ]);
    }

    public function orde()
    {
        $orders = Order::getAll();

        return $this->html(
            [
                'orders' => $orders
            ]);
    }

    public function addNewOrder()
    {
        $name = $this->request()->getValue('nameA');
        $surname = $this->request()->getValue('surnameA');
        $street = $this->request()->getValue('streetA');
        $houseNumber = $this->request()->getValue('houseNumberA');
        $psc = $this->request()->getValue('pscA');
        $country = $this->request()->getValue('countryA');
        $city = $this->request()->getValue('cityA');
        $mobileNumber = $this->request()->getValue('mobileNumberA');
        $radioBut = $this->request()->getValue('rbOne');

        $nameVal = User::validateName($name);
        $surnameVal = User::validateSurname($surname);
        $streetVal = Order::validateStreet($street);
        $cityVal = Order::validateCity($city);
        $countryVal = Order::validateCountry($country);
        $houseNumberVal = Order::validateHouseNumber($houseNumber);
        $mobileNumberVal = Order::validateMobileNumber($mobileNumber);
        $pscVal = Order::validatePsc($psc);
        $radioButVal = Order::validateRadioBut($radioBut);
        if ($nameVal != null) {
            echo ($nameVal);
            exit();
        } else if ($surnameVal != null) {
            echo ($surnameVal);
            exit();
        } else if ($streetVal != null) {
            echo ($streetVal);
            exit();
        } else if ($houseNumberVal != null) {
            echo ($houseNumberVal);
            exit();
        } else if ($cityVal != null) {
            echo ($cityVal);
            exit();
        } else if ($countryVal != null) {
            echo ($countryVal);
            exit();
        } else if ($pscVal != null) {
            echo ($pscVal);
            exit();
        } else if ($mobileNumberVal != null) {
            echo ($mobileNumberVal);
            exit();
        } else if ($radioButVal != null) {
            echo ($radioButVal);
            exit();
        }

        $newOrder = new Order();

        $users = User::getAll();
        foreach ($users as $user) {
            if ($user->getName() == $name && $user->getSurname() == $surname) {
                $newOrder->setUserId($user->getId());
                break;
            }
        }

        $shoppingCartItems = Cart::getAll();
        $numberOfItem = 0;
        $totalPrice = 0;
        foreach ($shoppingCartItems as $item) {
            $numberOfItem++;
            $totalPrice += $item->getItemPrice();
        }

        $newOrder->setNumberOfProducts($numberOfItem);

        if ($radioBut == "radioButtonOne") {
            $totalPrice += 2;
        }

        $newOrder->setDate(date("Y/m/d"));
        $newOrder->setTotalPrice($totalPrice);
        $newOrder->setStreet($street);
        $newOrder->setHouseNumber(intval($houseNumber));
        $newOrder->setPsc($psc);
        $newOrder->setCity($city);
        $newOrder->setCountry($country);
        $newOrder->setMobileNumber(intval($mobileNumber));
        $newOrder->save();

        echo "Objednávka prebehla úspešne.";
        exit();
    }
}