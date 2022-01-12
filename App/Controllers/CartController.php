<?php

namespace App\Controllers;

use App\Core\Responses\Response;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;

class CartController extends AControllerRedirect
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

    public function shopingCart()
    {
        $orders = Cart::getAll();

        return $this->html(
            [
                'shopping_cart' => $orders
            ]);
    }

    public function removeOrderItem()
    {
        $orders = Cart::getAll();
        $deleteItem = $_POST['deleteItem'];

        foreach ($orders as $item) {
            if ($item->getId() == $deleteItem) {
                $item->delete();
            }
        }

    }

    public function editOrderItem()
    {
        //if (isset($_POST['edit'])) {
            $items = Cart::getAll();

            //$editItem = $_POST['editItem'];
            $oldItem = Cart::getOne($_POST['oldItem']);

            $newItem = new Cart();
            $newItem->setId($oldItem->getId());
            $newItem->setProductId($oldItem->getProductId());
            $newItem->setProductName($oldItem->getProductName());
            $newQuantity = $_POST['text'];
            $newItem->setQuantity($newQuantity);


            $products = Product::getAll();
            $priceOfOne = 0;
            foreach ($products as $product) {
                if ($product->getId() == $oldItem->getProductId()) {
                    $priceOfOne = $product->getPrice();
                    break;
                }
            }

            $newItem->setItemPrice($priceOfOne);
            $newItem->setQuantityPrice($priceOfOne*$newQuantity);
            $newItem->save();

       // }


    }

    /**
    public function addOrder() {
        if (isset($_POST['sub'])) {
            print_r(intval($_POST['order_id']));

            $newO = new shopingCart();
            $newO->setOrderId(1);
            //$newO->setQuantity(0);
            //$newO->setProductId(intval($_POST['prod_id']));
            //$newO->setProductName("dsdsdsdad");
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
     **/

}