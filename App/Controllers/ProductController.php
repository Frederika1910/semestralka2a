<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\ProductCategory;

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
        $products = Product::getAll();
        return $this->html(
            [
                'product_category' => $categories,
                'products' => $products
            ]);
    }

    public function aboutProduct() {
        $products = Product::getAll();

        return $this->html(
            [
                //tu posielame data
                'products' => $products
            ]);
    }

    public function showProductDetail() {

        $clickedProduct = null;
        $products = Product::getAll();
        foreach ($products as $product) {
            if ($product->getId() == intval($this->request()->getValue('id'))) {
                $clickedProduct = '
   
                <div class="row">
                    <div class="col">
                        <div class="images p-3">
                            <div class="text-center p-4">
                                <img id="main-image" src="/semestralka2/' . \App\Config\Configuration::UPLOAD_DIR . $product->getImage() .'" width="250" alt="obrazok">
                            </div>                         
                   </div>
                    <div class="col">
                        <div class="product p-4">
                            <div class="mt-4 mb-3" style="text-align: center">
                                <span class="text-uppercase text-muted brand">Second Hand U Inky</span>
                                <h5 class="text-uppercase">'. $product->getName() .'</h5>                               
                            </div>
                            <p class="about">Shop from a wide range of t-shirt from orianz. Pefect for your everyday use, you could pair it with a stylish pair of jeans or trousers complete the look.</p>
                            <div class="sizes mt-5" style="text-align: center">
                                <h6 class="text-uppercase">Veľkosť: </h6> 
                                <span class="act-price">'. $product->getPrice() .'€</span>
                            </div>
                            <div class="cart mt-4" style="text-align: center"> 
                            ';
                if (\App\Auth::isLogged()) {
                    $clickedProduct .= '<button type="submit" class="btn btn-danger flex-fill ms-1" id="edit_order_item" dataId='. $product->getId() .' style="background-color:  #8B0000">Pridať do košíka</button>';
                } else {
                    $clickedProduct .= '<button type="submit" class="btn btn-danger flex-fill ms-1" id="edit_order_item" dataId='. $product->getId() .' style="background-color:  #8B0000" disabled="true">Pridať do košíka</button>';
                }
                $clickedProduct .= '<button type="button" id="cancel_but" class="btn btn-secondary" data-dismiss="modal" style="background-color: #E6E6FA; color: #8B0000">Zavrieť</button>
                            </div>
                        </div>
                    </div>
                </div        
                ';
                break;

            }
        }

        echo $clickedProduct;
        exit();
    }

    public function showFilteredProducts() {
        $category = $this->request()->getValue('category');
        $gender = $this->request()->getValue('gender');
        $minPrice = $this->request()->getValue('minPrice');
        $maxPrice = $this->request()->getValue('maxPrice');

        if ($category == null && $gender == null && $minPrice == null && $maxPrice == null) {
            $noFilter = "Neboli zvolené žiadne filtre.";
            echo json_encode($noFilter);
            exit();
        }

        $products = Product::getAll();
        $array = array();

        foreach ($products as $product) {
            $isCorrect = false;
            /**
            if (strcmp($product->getGender(), $gender) == 0 && $product->getPrice() >= $minPrice && $product->getPrice() <= $maxPrice) {
                $isCorrect = true;
            } else if (intval($category) == $product->getCategoryId()) {
                $isCorrect = true;
            } else if (strcmp($product->getGender(), $gender) == 0) {
                $isCorrect = true;
            } else if ($product->getPrice() >= $minPrice && $product->getPrice() <= $maxPrice) {
                $isCorrect = true;
            }
             **/

            if ($category != null && $gender != null && $minPrice != null) {
                if ($product->getCategoryId() == intval($category) && strcmp($product->getGender(), $gender) == 0 && $product->getPrice() >= $minPrice && $product->getPrice() <= $maxPrice) {
                    $isCorrect = true;
                }
            } else if ($category != null && $gender != null) {
                if ($product->getCategoryId() == intval($category) && strcmp($product->getGender(), $gender) == 0) {
                    $isCorrect = true;
                }
            } else if ($category != null && $minPrice != null) {
                if ($product->getCategoryId() == intval($category) && $product->getPrice() >= $minPrice && $product->getPrice() <= $maxPrice) {
                    $isCorrect = true;
                }
            } else if ($gender != null && $minPrice != null) {
                if (strcmp($product->getGender(), $gender) == 0 && $product->getPrice() >= $minPrice && $product->getPrice() <= $maxPrice) {
                    $isCorrect = true;
                }
            } else if ($category != null) {
                if ($product->getCategoryId() == intval($category)) {
                    $isCorrect = true;
                }
            } else if ($gender != null) {
                if (strcmp($product->getGender(), $gender) == 0) {
                    $isCorrect = true;
                }
            }else if ($minPrice != null) {
                if ($product->getPrice() >= $minPrice && $product->getPrice() <= $maxPrice) {
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
                                <a style="width: 100%">
                                    <button type="submit" id="more_but" class="btn btn-primary flex-fill" style="background-color: #E6E6FA; color: #8B0000" dataId='. $product->getId() .' >Viac</button>
                                </a>
                            </div>
                    </div>

                </div>';
                array_push($array, $filteredProduct);
            }
        }

        if (sizeof($array) == 0) {
            echo json_encode("Neboli nájdené žiadne zhody.");
            exit();
        }

        echo json_encode($array);
        exit();
    }

    public function addProductToCart() {

        $product = Product::getOne($this->request()->getValue('id'));

        $items = Cart::getAll();
        foreach ($items as $item) {
            if ($item->getProductId() == $product->getId()) {
                echo "uzVKosiku";
                exit();
            }
        }

        $cartItem = new Cart();
        $cartItem->setOrderId(1);
        $cartItem->setQuantity(1);
        $cartItem->setProductId($product->getId());
        $cartItem->setProductName($product->getName());
        $cartItem->setItemPrice($product->getPrice());
        $cartItem->setQuantityPrice($product->getPrice());

        $cartItem->save();
    }


}