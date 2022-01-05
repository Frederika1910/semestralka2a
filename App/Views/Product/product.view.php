<?php /** @var Array $data */ ?>
<div class="container" xmlns="http://www.w3.org/1999/html">
    <div class="row">
        <?php foreach ($data['products'] as $product) { ?>
            <div class="col-lg-4 col-md-6 mt-2">
                <form method="post" action="?c=product&a=addmmm">
                    <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="/semestralka2/<?php echo \App\Config\Configuration::UPLOAD_DIR . $product->getImage() ?>"  alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product->getName() ?></h5>
                                <p class="card-text" id="xyz<?php echo $product->getId() ?> ">Cena: <?php echo $product->getPrice() ?>€</p>
                            </div>

                            <div class="card-body">
                                <a href="#" class="btn btn-success mt-2">Viac</a>
                                <button type="submit" name="sub">Pridať do košíka</button>
                                <input name="p_id" type="hidden" value="<?php echo $product->getId() ?>">
                                <input name="p_name" type="hidden" value="<?php echo $product->getName() ?>">
                                <input name="p_price" type="hidden" value="<?php echo $product->getPrice() ?>">
                            </div>
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>
</div>


