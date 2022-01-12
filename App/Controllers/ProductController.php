<?php

namespace App\Controllers;

use App\Core\Responses\Response;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Cart;
use App\Models\ProductCategory;
use App\Models\User;

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

    public function filterProduct()
    {
        $categories = ProductCategory::getAll();

        return $this->html(
            [
                'product_category' => $categories
            ]);
    }

    public function showFilteredProducts() {
        //$category;
        //$minPrice = $_POST['minPrice'];
        //$maxPrice = $_POST['maxPrice'];
        //$gender = $_POST['gender'];
        /**
        if (isset($_POST['category'])) {
            $category = $_POST['category'];
        }

        if (empty($_POST['minPrice'])) {
            $minPrice = intval($_POST['minPrice']);
        }
        if (empty($_POST['maxPrice'])) {
            $maxPrice = intval($_POST['maxPrice']);
        }

        if (empty($_POST['gender'])) {
            $gender = NULL;
        }
        * **/
        $products = Product::getAll();
        $array = array();

        foreach ($products as $product) {
            $isCorrect = false;

            if (isset($_POST['category']) && isset($_POST['gender']) && isset($_POST['minPrice'])) {
                if ($product->getCategoryId() == intval($_POST['category']) && strcmp($product->getGender(), $_POST['gender'] && $product->getPrice() >= $_POST['minPrice'] && $product->getPrice() <= $_POST['maxPrice']) == 0) {
                    $isCorrect = true;
                }
            } else if (isset($_POST['category']) && isset($_POST['gender'])) {
                if ($product->getCategoryId() == intval($_POST['category']) && strcmp($product->getGender(), $_POST['gender']) == 0) {
                    $isCorrect = true;
                }
            } else if (isset($_POST['category']) && isset($_POST['minPrice'])) {
                if ($product->getCategoryId() == intval($_POST['category']) && $product->getPrice() >= $_POST['minPrice'] && $product->getPrice() <= $_POST['maxPrice']) {
                    $isCorrect = true;
                }
            } else if (isset($_POST['gender']) && isset($_POST['minPrice'])) {
                if (strcmp($product->getGender(), $_POST['gender']) == 0 && $product->getPrice() >= $_POST['minPrice'] && $product->getPrice() <= $_POST['maxPrice']) {
                    $isCorrect = true;
                }
            } else if (isset($_POST['category'])) {
                if ($product->getCategoryId() == intval($_POST['category'])) {
                    $isCorrect = true;
                }
            } else if (isset($_POST['gender'])) {
                if (strcmp($product->getGender(), $_POST['gender']) == 0) {
                    $isCorrect = true;
                }
            }else if (isset($_POST['minPrice'])) {
                if ($product->getPrice() >= $_POST['minPrice'] && $product->getPrice() <= $_POST['maxPrice']) {
                    $isCorrect = true;
                }
            }


            if ($isCorrect) {
                $filteredProduct = '
                <div class="col-lg-4 col-md-6 mt-2">
                    <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="/semestralka2/' . \App\Config\Configuration::UPLOAD_DIR . $product->getImage() .'" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">'. $product->getName() .'</h5>
                                <p class="card-text" id="xyz<?php echo $product->getId() ?> ">Cena: ' . $product->getPrice() .' €</p>
                            </div>

                            <div class="card-body d-flex flex-row">
                                <button type="submit" class="btn btn-primary flex-fill me-1" dataId="<?php echo $product->getId() ?>" style="background-color: #E6E6FA; color: #8B0000" >Viac</button>
                            </div>
                    </div>

                </div>';
                array_push($array, $filteredProduct);
            }
        }

        echo json_encode($array);
        exit();
    }

    public function addProductToCart() {

        $product = Product::getOne($_POST['id']);

        $items = Cart::getAll();
        $pocet = 0;
        foreach ($items as $item) {
            if ($item->getProductId() == $product->getId()) {
                echo "uzVKosiku";
                exit();
            }
        }

        //if ($existuje == false) {
            $cartItem = new Cart();
            $cartItem->setOrderId(1);
            $cartItem->setQuantity(1);
            $cartItem->setProductId($product->getId());
            $cartItem->setProductName($product->getName());
            $cartItem->setItemPrice($product->getPrice());
            $cartItem->setQuantityPrice($product->getPrice());

            $cartItem->save();
        //}

        /**
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
            $newO->setQuantityPrice(intval($_POST['p_price']));
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
         * **/
    }


}