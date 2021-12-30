<?php

namespace App\Controllers;

use App\Core\Responses\Response;
use App\Models\Product;
use App\Models\Cart;

class ProductController extends AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index()
    {

    }

    public function product()
    {
        $products = Product::getAll();

        return $this->html(
            [
                //tu posielame data
                'products' => $products
            ]);
    }

    public function addmmm() {
        if (isset($_POST['sub'])) {
            //print_r(($_POST['p_price']));

            $items = Cart::getAll();
            foreach ($items as $item) {
                if ($item->getProductId() == $_POST['p_id']) {
                    echo "<script>alert('Tento produkt si uz pridal do kosika.')</script>";
                    echo "<script>window.location ='?c=product&a=product'</script>";
                    //$this->redirect('product', 'product', ['error' => 'Zadané staré heslo nebolo správne.']);
                    //$this->redirect('home');
                    return;
                }
            }

            $newO = new Cart();
            //$newO->setId(2);
            $newO->setOrderId(1);
            $newO->setQuantity(1);

            $newO->setProductName(($_POST['p_name']));
            $newO->setProductId(intval($_POST['p_id']));
            $newO->setItemPrice(intval($_POST['p_price']));

            $newO->save();

            //if (isset($_SESSION['card'])) {

            //} else {
            //    $order_array = array('order_id'=>$_POST['order_id']);
            //}
            //$_SESSION['card'][0] = $order_array;
            //$this->redirect('auth', 'registerForm');
            //echo '<script>alert("Welcome to Geeks for Geeks")</script>';
            $this->redirect('product', 'product');
        }
    }


}