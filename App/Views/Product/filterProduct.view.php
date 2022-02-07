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

    <nav class="navbar navbar-light light-blue lighten-4" id="a">
        <a class="navbar-brand" href="#">Filtre</a>
        <button class="navbar-toggler toggler-example" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1"
                aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="dark-blue-text">
                <i class="bi bi-funnel"></i>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
                <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2h-11z"/>
                </svg>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent1">
            <div class="navbar-nav mr-auto">
                <div class="row">
                    <div class="col">
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
                                <div class="list-group-item checkbox">
                                    <label><input type="radio" name="radiobuttonGen" class="common_selector gender" value="z"> Pre ženy</label>
                                </div>
                                <div class="list-group-item checkbox">
                                    <label><input type="radio" name="radiobuttonGen" class="common_selector gender" value="m"> Pre mužov</label>
                                </div>
                                <div class="list-group-item checkbox">
                                    <label><input type="radio" name="radiobuttonGen" class="common_selector gender" value="d"> Pre deti</label>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary filter_but" style="background-color:  #8B0000; width: 100%">Vyfiltruj</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="row">
        <div class="col-md-3">
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
        <div class="col-md-9">
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

