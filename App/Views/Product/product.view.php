<?php /** @var Array $data */ ?>
<div class="container">

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
                                <a style="width: 100%">
                                    <button type="submit" id="more_but" class="btn btn-primary flex-fill" style="background-color: #E6E6FA; color: #8B0000" dataId="<?php echo $product->getId() ?>" >Viac</button>
                                </a>
                            </div>
                    </div>
            </div>
        <?php } ?>
    </div>
</div>


