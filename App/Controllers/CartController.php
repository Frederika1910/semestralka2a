<?php

namespace App\Controllers;

use App\Auth;
use App\Core\Responses\Response;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;

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
        $delItemPrice = 0;
        foreach ($orders as $item) {
            if ($item->getId() === $delCartItem) {
                $product = Product::getOne($item->getProductId());
                $delItemPrice = $product->getPrice();
                $item->delete();
            }
        }
        echo $delItemPrice;
    }

    public function editOrderItem()
    {
        $oldItem = Cart::getOne($this->request()->getValue('oldItem'));

        $newQuantity = $this->request()->getValue('text');

        if (!preg_match("/[0-9]$/", $newQuantity)){
            return;
        }

        $oldItem->setQuantity($newQuantity);

        $product = Product::getOne($oldItem->getProductId());
        $oldItem->setQuantityPrice($product->getPrice()*$newQuantity);
        $oldItem->save();
    }

    public function addToCart() {

        $product = Product::getOne($this->request()->getValue('id'));

        $currentUser = Auth::getId();
        $items = Cart::getAll();
        foreach ($items as $item) {
            if ($item->getProductId() == $product->getId() && $item->getUserId() == $currentUser && $item->getState() == 0) {
                echo "Produkt sa v tvojom košíku už nachádza.";
                exit();
            }
        }

        $cartItem = new Cart();
        $cartItem->setQuantity(1);
        $cartItem->setProductId($product->getId());
        $cartItem->setQuantityPrice($product->getPrice());
        $cartItem->setUserId($currentUser);
        $cartItem->save();

        echo "Produkt bol úspešne pridaný do tvojho košíka.";
        exit();
    }

}