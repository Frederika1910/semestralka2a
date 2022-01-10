<?php /** @var Array $data */ ?>
<div class="container" xmlns="http://www.w3.org/1999/html">

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
        <?php foreach ($data['products'] as $product) { ?>
            <div class="col-lg-4 col-md-6 mt-2">

                    <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="/semestralka2/<?php echo \App\Config\Configuration::UPLOAD_DIR . $product->getImage() ?>"  alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product->getName() ?></h5>
                                <p class="card-text" id="xyz<?php echo $product->getId() ?> ">Cena: <?php echo $product->getPrice() ?>€</p>
                            </div>

                            <div class="card-body d-flex flex-row">
                                <button type="submit" class="btn btn-primary flex-fill me-1" dataId="<?php echo $product->getId() ?>" style="background-color: #E6E6FA; color: #8B0000" >Viac</button>
                                <button type="submit" class="btn btn-danger flex-fill ms-1" id="edit_order_item" dataId="<?php echo $product->getId() ?>" style="background-color:  #8B0000">Pridať do košíka</button>
                            </div>
                    </div>

            </div>
        <?php } ?>
    </div>
</div>


