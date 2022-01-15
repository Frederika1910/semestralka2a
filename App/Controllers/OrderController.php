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

    public function addNewOrder() {


        $newOrder = new Order();
        $newOrder->setUserId(1);
        $newOrder->setStreet("ulica");
        $newOrder->setHouseNumber(12);
        $newOrder->setPsc("00000");
        $newOrder->setCity("Zilina");
        $newOrder->setMobileNumber(0000);
        $newOrder->save();

    }

    public function daco()
    {

        $newOrder = new Order();

        if(isset($_POST['nameA']) && isset($_POST['surnameA'])) {
            $users = User::getAll();
            foreach ($users as $user) {
                if ($user->getName() == $_POST['nameA'] && $user->getSurname() == $_POST['surnameA']) {
                    $newOrder->setUserId($user->getId());
                    break;
                }
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

        if(isset($_POST['rbOne']) && ($_POST['rbOne']) == "1") {
            $totalPrice += 2;
        }


        $newOrder->setTotalPrice($totalPrice);

        if(isset($_POST['streetA'])) {
            $newOrder->setStreet($_POST["streetA"]);
        }
        if (isset($_POST['houseNumberA'])) {
            $newOrder->setHouseNumber(intval($_POST['houseNumberA']));
        }
        if (isset($_POST['pscA'])) {
            $newOrder->setPsc($_POST['pscA']);
        }
        if (isset($_POST['cityA'])) {
            $newOrder->setCity($_POST['cityA']);
        }
        if (isset($_POST['countryA'])) {
            $newOrder->setCountry($_POST['countryA']);
        }
        if (isset($_POST['mobileNumberA'])) {
            $newOrder->setMobileNumber(intval($_POST['mobileNumberA']));
        }

        $newOrder->save();

    }
}