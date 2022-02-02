<?php

namespace App\Controllers;

use App\Models\Gender;
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
        $products = Product::getAll();
        $genders = Gender::getAll();
        return $this->html(
            [
                'product_category' => $categories,
                'products' => $products,
                'genders' => $genders
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

    public function addProductCategoryForm() {
        $categories = ProductCategory::getAll();

        return $this->html([
            'product_category' => $categories
        ]);
    }

    public function removeProductCategory() {
        $categories = ProductCategory::getAll();

        return $this->html([
            'product_category' => $categories
        ]);
    }

    public function addProductCategory() {
        $name = $this->request()->getValue('nameCategory');
        $nameVal = User::validateName($name);

        if ($nameVal != null) {
            echo ($nameVal);
            exit();
        }

        $categories = ProductCategory::getAll();
        foreach ($categories as $category) {
            if (strcmp(strtolower($category->getName()), strtolower($name)) == 0) {
                echo "Kategória sa v tabuľke už nachádza.";
                exit();
            }
        }
        $newCategory = new ProductCategory();
        $newCategory->setName($name);
        $newCategory->save();

        echo "Kategória bola úspešne pridaná.";
        exit();
    }

    public function removeCategory() {
        $id = intval($this->request()->getValue('id'));
        $categories = ProductCategory::getAll();
        $products = Product::getAll();

        foreach ($products as $product) {
            if ($product->getCategoryId() == $id) {
                $product->delete();
            }
        }

        foreach ($categories as $category) {
            if ($category->getId() == $id) {
                $category->delete();
            }
        }

        echo $id;
        exit();
    }

    public function removeProduct() {
        $id = intval($this->request()->getValue('id'));
        $products = Product::getAll();
        $carts = Cart::getAll();

        foreach ($carts as $cart) {
            if ($cart->getProductId() == $id) {
                $cart->delete();
            }
        }

        foreach ($products as $product) {
            if ($product->getId() == $id) {
                $product->delete();
            }
        }
    }

    public function editProduct() {
        $id = $this->request()->getValue('id');
        $name = $this->request()->getValue('newName');
        $size = $this->request()->getValue('newSize');
        $price = $this->request()->getValue('newPrice');

        $nameVal = User::validateName($name);
        $sizeVal = Product::validateSize($size);
        $priceVal = Product::validatePrice($price);

        if ($nameVal != null) {
            echo ($nameVal);
            exit();
        } else if ($sizeVal != null) {
            echo ($sizeVal);
            exit();
        } else if ($priceVal != null) {
            echo($priceVal);
            exit();
        }
        $product = Product::getOne($id);

        $product->setName($name);
        $product->setSize($size);
        $product->setPrice($price);

        $product->save();
    }

    public function showProductDetail() {

        $clickedProduct = null;
        $products = Product::getAll();
        foreach ($products as $product) {
            if ($product->getId() == intval($this->request()->getValue('id'))) {
                $clickedProduct = '
   
                <div class="row deleteProductModal">
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
                                <h5 class="text-uppercase" id="nameProduct'. $product->getId() .'">'. $product->getName() .'</h5>  
                                <input type="name" id="productNameInput'. $product->getId() .'" class="form-control" onkeyup="validateProductName('. $product->getId() .')" placeholder="Názov..." autocomplete="off" style="display: none;"/>                             
                                <div class="valid"></div>
                            </div>
                            <div class="sizes mt-5" style="text-align: center">
                                <div>
                                    <h6 class="text-uppercase" id="sizeProduct'. $product->getId() .'">Veľkosť: '. $product->getSize() .' </h6> 
                                    <input type="name" id="productSizeInput'. $product->getId() .'" class="form-control mb-2" onkeyup="validateSize('. $product->getId() .')" placeholder="Veľkosť..." autocomplete="off" style="display: none;"/>
                                    <div class="valid"></div>
                                </div>
                                <div>
                                    <span class="act-price" id="priceProduct'. $product->getId() .'">'. $product->getPrice() .'€</span>
                                    <input type="name" id="productPriceInput'. $product->getId() .'" class="form-control" onkeyup="validatePrice('. $product->getId() .')" placeholder="Cena..." autocomplete="off" style="display: none;"/>
                                    <div class="valid"></div>
                                </div>
                            </div>
                            <div class="cart mt-4" style="text-align: center"> 
                            ';
                if (\App\Auth::isLogged() && \App\Auth::isAdmin()) {
                    $clickedProduct .= '<button type="submit" id="delete_order_but" class="btn btn-primary" dataId='. $product->getId() .' style="background-color:  #8B0000">Odstrániť</button>
                                        <button type="submit" id="edit_order_but'. $product->getId() .'" class="btn btn-primary editOrderBut" dataId='. $product->getId() .' style="background-color:  #A6923F">Upraviť</button>
                                        <button type="submit" id="save_order_but'. $product->getId() .'" class="btn btn-primary saveOrderBut validate" dataId='. $product->getId() .' disabled="true" style="color:  white; background-color: black; display: none">Potvrdiť</button>';

                } else if (\App\Auth::isLogged()) {
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

        $products = Product::getAll('category_id=?', [$category]);
        $array = array();
        foreach ($products as $product) {
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

        if (sizeof($array) == 0) {
            echo json_encode("Neboli nájdené žiadne zhody.");
            exit();
        }

        echo json_encode($array);
        exit();

    }
}
