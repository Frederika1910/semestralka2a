<?php

namespace App\Controllers;

use App\Auth;
use App\Core\Responses\Response;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\State;
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


    public function orde()
    {
        $orders = Order::getAll();
        $states = State::getAll();

        return $this->html(
            [
                'orders' => $orders,
                'states' => $states
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

        $rb1 = $this->request()->getValue('rbOne');
        $rb2 = $this->request()->getValue('rbTwo');
        $cardNumber = $this->request()->getValue('cardNo');
        $s1 = $this->request()->getValue('sOne');
        $cardDate = $this->request()->getValue('cardD');

        $nameVal = User::validateName($name);
        $surnameVal = User::validateSurname($surname);
        $streetVal = Order::validateStreet($street);
        $pscVal = Order::validatePsc($psc);
        $cityVal = Order::validateCity($city);
        $countryVal = Order::validateCountry($country);
        $houseNumberVal = Order::validateHouseNumber($houseNumber);
        $mobileNumberVal = Order::validateMobileNumber($mobileNumber);
        $cardNumberVal = Order::validateCardNumber($cardNumber);
        $cardDateVal = Order::validateCardNumber($cardDate);

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
        } else if ($pscVal != null) {
            echo ($pscVal);
            exit();
        } else if ($cityVal != null) {
            echo ($cityVal);
            exit();
        } else if ($countryVal != null) {
            echo ($countryVal);
            exit();
        } else if ($mobileNumberVal != null) {
            echo ($mobileNumberVal);
            exit();
        } else if ($rb1 == "false" && $rb2 == "false") {
            echo ("Nevybrali ste si spôsob platby.");
            exit();
        } else if ($rb2 == "true") {
            if ($s1 == "false") {
                echo ("Nevybrali ste si druh karty.");
                exit();
            } else if ($cardNumberVal != null) {
                echo ($cardNumberVal);
                exit();
            } else if ($cardDateVal != null) {
                echo($cardDateVal);
                exit();
            }
        }

        $newOrder = new Order();

        $currentUser = Auth::getId();
        $newOrder->setUserId($currentUser);

        $shoppingCartItems = Cart::getAll('user_id=?', [$currentUser]);
        $numberOfItem = 0;
        $totalPrice = 0;
        foreach ($shoppingCartItems as $item) {
            $numberOfItem += $item->getQuantity();
            $totalPrice += $item->getQuantityPrice();
            $item->delete();
        }

        if ($totalPrice <= 0 || $numberOfItem <= 0) {
            echo ("V košíku nič nemáš.");
            exit();
        }

        $newOrder->setNumberOfProducts($numberOfItem);

        if ($rb1 == "true" && $rb2 == "false") {
            $totalPrice += 2;
        }

        $newOrder->setDate(date("Y/m/d"));
        $newOrder->setTotalPrice($totalPrice);
        $newOrder->setStreet($street);
        $newOrder->setHouseNumber(intval($houseNumber));
        $newOrder->setPsc($psc);
        $newOrder->setCity($city);
        $newOrder->setCountry($country);
        $newOrder->setMobileNumber(($mobileNumber));
        $newOrder->setState(1);
        $newOrder->save();

        echo ("Objednávka prebehla úspešne.");
        exit();
    }

    public function stornoOrder() {
        $stornoOrder = Order::getOne($this->request()->getValue('id'));
        $stornoOrder->setState(3);
        $stornoOrder->save();
        $state = State::getOne($stornoOrder->getState());

        echo $state->getNameState();
        exit();
    }

    public function showFilteredOrders() {
        $state = intval($this->request()->getValue('state'));
        $orders = Order::getAll('state=?',[$state]);
        $array = array();

        $pocet = 0;
        foreach ($orders as $order) {
                $nameState = State::getOne($order->getState())->getNameState();
                $pocet++;
                $correctOrder = '
                <tr class="sendItem'. $order->getId() .'">
                <td>'. $order->getUserId() .'</td>
                <td class="colNUmberProducts">'. $order->getNumberOfProducts() .'</td>
                <td class="colDate">'. $order->getDate() .'</td>
                <td>'. $nameState .'</td>
                <td>'. $order->getTotalPrice() .'€</td>
                <td>';
                if ($state == 3) {
                    $correctOrder .= '<button type = "submit" id = "confirmStonoBut'. $order->getId() .'" class="btn btn-danger confirmStornoOrderBut" dataId = "'. $order->getId() .'"><i class="bi bi - check"></i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                            <path d = "M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                        </svg >
                    </button >';
                } else if ($state == 1) {
                    $correctOrder .= '<button type = "submit" id = "sendBut'. $order->getId() .'" class="btn btn-success sendOrderBut" dataId = "'.$order->getId() .'"><i class="bi bi - check"></i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                        </svg>
                    </button >';
                }
                $correctOrder .= '</td>
            </tr>
                ';
                array_push($array, $correctOrder);

        }

        echo json_encode($array);
        exit();
    }

    public function setOrderState() {
        $sendOrder = intval($this->request()->getValue('sendItem'));
        $state = ($this->request()->getValue('state'));
        $order = Order::getOne($sendOrder);
        $order->setState($state);
        $order->save();
    }

}