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
        $deleteCartItem = Cart::getOne($this->request()->getValue('deleteItem'));
        $deleteProduct = Product::getOne($deleteCartItem->getProductId());
        $delItemPrice = $deleteProduct->getPrice();
        $deleteCartItem->delete();

        echo $delItemPrice;
    }

    public function editOrderItem()
    {
        $oldItem = Cart::getOne($this->request()->getValue('oldItem'));

        $newQuantity = $this->request()->getValue('text');

        if (preg_match('/[a-zA-Z]/', $newQuantity) || $newQuantity <= 0) {
            echo "Zadal si neplatnú hodnotu.";
            exit();
        }

        $oldItem->setQuantity($newQuantity);

        $product = Product::getOne($oldItem->getProductId());
        $oldItem->setQuantityPrice($product->getPrice()*$newQuantity);
        $oldItem->save();
    }

    public function addToCart() {
        $product = Product::getOne($this->request()->getValue('id'));

        $currentUser = Auth::getId();
        $itemsUser = Cart::getAll('user_id=?', [$currentUser]);
        $itemsProduct = Cart::getAll('product_id=?', [$product->getId()]);

        $item = array_uintersect($itemsUser, $itemsProduct, function ($a, $b) {
            if ($a->getId() === $b->getId()) {
                return 0;
            }
            return ($a > $b) ? 1 : -1;
        });

        if (sizeof($item) > 0) {
            echo ("Produkt sa v tvojom košíku už nachádza.");
            exit();
        }

        $cartItem = new Cart();
        $cartItem->setQuantity(1);
        $cartItem->setProductId($product->getId());
        $cartItem->setQuantityPrice($product->getPrice());
        $cartItem->setUserId($currentUser);
        $cartItem->save();

        echo ("Produkt bol úspešne pridaný do tvojho košíka.");
        exit();
    }
}