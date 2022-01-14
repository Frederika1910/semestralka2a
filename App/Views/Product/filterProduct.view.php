<?php /** @var Array $data */ ?>
<div class="container">

    <div class="modal" id="productDetail" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" id="productDetailMsg">

                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="productResponse" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" id="modelMsg">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cancel_but" class="btn btn-secondary" data-dismiss="modal">Zavrieť</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <button type="submit" id="clear_but" class="btn btn-primary" style="background-color: #E6E6FA; color: #8B0000">Vymaž filter</button>
            <div class="list-group">
                <h3>Cena</h3>
                <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                    <div class="list-group-item checkbox">
                        <label><input type="radio" name="radiobuttonPrice" class="common_selector price" min="0" max="4" autocomplete="off"> pod 5€</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="radio" name="radiobuttonPrice" class="common_selector price" min="5" max="10" autocomplete="off"> 5€ - 10€</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="radio" name="radiobuttonPrice" class="common_selector price" min="11" max="20" autocomplete="off"> 11€ - 20€</label>
                    </div>
                </div>
            </div>
            <div class="list-group">
                <h3>Kategórie</h3>
                <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                    <?php foreach ($data['product_category'] as $category) { ?>
                    <div class="list-group-item checkbox">
                            <label><input type="radio" name="radiobuttonCat" class="common_selector category" value="<?php echo $category->getId() ?>" autocomplete="off" > <?php echo $category->getName() ?></label>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="list-group">
                <h3>Pre koho</h3>
                <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                    <div class="list-group-item checkbox">
                        <label><input type="radio" name="radiobuttonGen" class="common_selector gender" value="z" autocomplete="off"> Pre ženy</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="radio" name="radiobuttonGen" class="common_selector gender" value="m" autocomplete="off"> Pre mužov</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="radio" name="radiobuttonGen" class="common_selector gender" value="d" autocomplete="off"> Pre deti</label>
                    </div>
                </div>
            </div>
            <button type="submit" id="filter_but" class="btn btn-primary" style="background-color:  #8B0000">Vyfiltruj</button>
        </div>
        <div class="col-md-9">
            <div class="row filter_data">
                <?php foreach ($data['products'] as $product) { ?>
                    <div class="col-lg-4 col-md-6 mt-2">

                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="/semestralka2/<?php echo \App\Config\Configuration::UPLOAD_DIR . $product->getImage() ?>"  alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product->getName() ?></h5>
                                <p class="card-text" id="xyz<?php echo $product->getId() ?> ">Cena: <?php echo $product->getPrice() ?>€</p>
                            </div>

                            <div class="card-body d-flex flex-row">
                                <a style="width: 100%">
                                    <button type="submit" id="more_but" class="btn btn-primary flex-fill" style="background-color: #E6E6FA; color: #8B0000" dataId="<?php echo $product->getId() ?>" >Viac</button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

