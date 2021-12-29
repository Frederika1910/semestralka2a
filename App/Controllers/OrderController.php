<?php

namespace App\Controllers;

use App\Core\Responses\Response;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index()
    {
    }

    public function orders()
    {
        $orders = Order::getAll();

        return $this->html(
            [
                'orders' => $orders
            ]);
    }

    public function orderItem()
    {
        $orders = OrderItem::getAll();

        return $this->html(
            [
                'order_item' => $orders
            ]);
    }

    public function addOrder() {
        if (isset($_POST['sub'])) {
            print_r($_POST['product_name']);

            $newO = new OrderItem();
            $newO->setOrderId(1);
            $newO->setQuantity(0);
            $newO->setProductId(intval($_POST['product_id']));
            $newO->setProductName($_POST['product_name']);
            $newO->save();

            //if (isset($_SESSION['card'])) {

            //} else {
            //    $order_array = array('order_id'=>$_POST['order_id']);
            //}
            //$_SESSION['card'][0] = $order_array;
            //$this->redirect('auth', 'registerForm');
            //echo '<script>alert("Welcome to Geeks for Geeks")</script>';
            //$this->redirect('product', 'product');
        } else {

            $this->redirect('auth', 'loginForm');
        }
    }

}