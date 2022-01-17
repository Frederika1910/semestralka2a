<?php

namespace App\Controllers;

use App\Auth;
use App\Core\Responses\Response;
use App\Models\Cart;
use App\Models\Order;
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
        //$cardNumber = $this->request()->getValue('cardNo');
        $s1 = $this->request()->getValue('sOne');
        $s2 = $this->request()->getValue('sTwo');
        $s3 = $this->request()->getValue('sTree');

        $nameVal = User::validateName($name);
        $surnameVal = User::validateSurname($surname);
        $streetVal = Order::validateStreet($street);
        $pscVal = Order::validatePsc($psc);
        $cityVal = Order::validateCity($city);
        $countryVal = Order::validateCountry($country);
        $houseNumberVal = Order::validateHouseNumber($houseNumber);
        $mobileNumberVal = Order::validateMobileNumber($mobileNumber);
        //$cardNumberVal = Order::validateCardNumber($cardNumber);
        //$radioButVal = Order::validateRadioBut($radioBut);
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
            echo "Nevybrali ste si spôsob platby.";
            exit();
        } if ($rb2 == "true") {
            if ($s1 == "false") {
                echo "Nevybrali ste si druh karty.";
                exit();
            } else if ($s2 == "false") {
                echo "Nevybrali ste si mesiac v dátume splatnosti.";
                exit();
            } else if ($s3 == "false") {
                echo "Nevybrali ste si rok v dátume splatnosti.";
                exit();
            }
        }



        $newOrder = new Order();

        $currentUser = Auth::getId();
        $newOrder->setUserId($currentUser);

        $shoppingCartItems = Cart::getAll();
        $numberOfItem = 0;
        $totalPrice = 0;
        foreach ($shoppingCartItems as $item) {
            if ($item->getUserId() == $currentUser && $item->getState() == 0) {
                $numberOfItem += $item->getQuantity();
                $totalPrice += $item->getQuantityPrice();
                $item->setState(1);
                $item->save();
            }
        }

        if ($totalPrice <= 0 || $numberOfItem <= 0) {
            echo "V košíku nič nemáš.";
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
        $newOrder->setState(1);     //cakajuca objednavka na potvrdenie
        $newOrder->save();

        echo "Objednávka prebehla úspešne.";
        exit();
    }
/**
    public function showOrder() {
        $carts = Cart::getAll();
        $array = array();

        $currentUser = Auth::getId();
        $orderId = $this->request()->getValue('id');
        foreach ($carts as $cart) {
            $addItem = '';
            if ($cart->getUserId() == $currentUser && $cart->getOrderId() == intval($orderId)) {
                $addItem = '
                <tr class="'. $cart->getId().'">
                <td> '. $cart->getProductName() .'</td>
                <td> '. $cart->getQuantity() .'</td>
                <td> '. $cart->getQuantityPrice() .'</td>
                <td>
                <button type="submit" id="delete_order_but'.$cart->getId() .'" name="del" class="btn btn-danger delOrderBut" dataId=" '.$cart->getId() .'"><i class="bi bi-trash"></i>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg>
                </button>
                </td>
                </tr>
                ';

                array_push($array, $addItem);
            }

        }

        echo json_encode($array);
        exit();
    }

**/
    public function stornoOrder() {
        $delItemId = intval($this->request()->getValue('id'));
        $orders = Order::getAll();

        foreach ($orders as $order) {
            if ($order->getId() === $delItemId) {
                $order->setState(3);    //stornovana objednavka cakajuca na spracovanie
                $order->save();

                $state = State::getOne($order->getState());

                echo $state->getNameState();
                break;
            }
        }

        echo null;
    }

    public function showFilteredOrders() {
        $state = intval($this->request()->getValue('state'));
        $orders = Order::getAll();
        $array = array();



        $pocet = 0;
        foreach ($orders as $order) {
            if (($state) == $order->getState() || ($state) == 5) {
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                            <path d = "M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                        </svg >
                    </button >';
                }
                $correctOrder .= '</td>
            </tr>
                ';
                array_push($array, $correctOrder);
            }
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

    public function sendOrder() {
        $sendOrder = intval($this->request()->getValue('sendItem'));
        $order = Order::getOne($sendOrder);
        $order->setState(2);
        $order->save();
    }

    public function confirmStornoOrder() {
        $sendOrder = intval($this->request()->getValue('sendItem'));
        $order = Order::getOne($sendOrder);
        $order->setState(2);
        $order->save();
    }
}