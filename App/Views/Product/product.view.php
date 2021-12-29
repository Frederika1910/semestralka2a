<?php /** @var Array $data */ ?>
<div class="container" xmlns="http://www.w3.org/1999/html">
    <div class="row">
        <?php foreach ($data['products'] as $product) { ?>
            <div class="col-lg-4 col-md-6 mt-2">
                <div class="card" style="width: 18rem;">
                    <form method="post" action="?c=order&a=addOrder">
                        <img class="card-img-top" src="/semestralka2/<?php echo \App\Config\Configuration::UPLOAD_DIR . $product->getImage() ?>"  alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product->getName() ?></h5>
                            <p class="card-text">Cena: <?php echo $product->getPrice() ?>€</p>
                        </div>
                        <div class="card-body">
                            <a href="#" class="btn btn-success mt-2">Viac</a>
                            <button type="submit" name="sub">Pridať do košíka</button>
                            <input type="hidden" name="product_name" value="<?php $product->getName() ?>">
                            <input type="hidden" name="product_id" value="<?php $product->getId() ?>">
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


