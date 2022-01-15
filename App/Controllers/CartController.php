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
        $delCartItem = intval($this->request()->getValue('deleteItem'));

        foreach ($orders as $item) {
            if ($item->getId() === $delCartItem) {
                $item->delete();
            }
        }

    }

    public function editOrderItem()
    {
        $oldItem = Cart::getOne($this->request()->getValue('oldItem'));

        $newQuantity = $this->request()->getValue('text');
        $oldItem->setQuantity($newQuantity);

        $oldItem->setQuantityPrice($oldItem->getItemPrice()*$newQuantity);
        $oldItem->save();
    }

}