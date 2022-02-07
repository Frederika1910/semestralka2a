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
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="filterBigScreen">
                <button type="button" class="btn btn-primary clear_but" style="background-color: #E6E6FA; color: #8B0000; width: 100%">Vymaž filter</button>
                <div class="list-group">
                    <h3>Kategórie</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                        <?php foreach ($data['product_category'] as $category) { ?>
                        <div class="list-group-item checkbox">
                            <label><input type="radio" name="radiobuttonCat" class="common_selector category" value="<?php echo $category->getId() ?>"> <?php echo $category->getName() ?></label>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="list-group">
                    <h3>Pre koho</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                        <?php foreach ($data['genders'] as $gender) { ?>
                            <div class="list-group-item checkbox">
                                <label><input type="radio" name="radiobuttonGen" class="common_selector gender" value="<?php echo $gender->getId() ?>"> <?php echo $gender->getName() ?></label>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <button type="button" class="btn btn-primary filter_but" style="background-color:  #8B0000; width: 100%">Vyfiltruj</button>
            </div>
        </div>
        <div class="col-lg-9 col-md-6 col-sm-12">
            <div class="row filter_data">
                <?php foreach ($data['products'] as $product) { ?>
                    <div class="col">
                        <div class="card mt-2 cardProductDelete<?php echo $product->getId() ?>" style="width: 18rem;">
                            <img class="card-img-top" src="/semestralka2/<?php echo \App\Config\Configuration::UPLOAD_DIR . $product->getImage() ?>"  alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title" id="cardName<?php echo $product->getId() ?>" ><?php echo $product->getName() ?></h5>
                                <p class="card-text" id="cardPrice<?php echo $product->getId() ?>">Cena: <?php echo $product->getPrice() ?>€</p>
                            </div>
                            <div class="card-body d-flex flex-row">
                                <button type="button" id="more_button<?php echo $product->getId() ?>" class="btn btn-primary more_but" style="background-color: #E6E6FA; color: #8B0000" data-id="<?php echo $product->getId() ?>" >Viac</button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

