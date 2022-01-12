<?php /** @var Array $data */ ?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <button type="submit" id="clear_but" class="btn btn-primary" style="background-color: #E6E6FA; color: #8B0000">Vymaž filter</button>
            <div class="list-group">
                <h3>Cena</h3>
                <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                    <div class="list-group-item checkbox">
                        <label><input type="radio" name="radiobuttonPrice" class="common_selector price" min="0" max="5" autocomplete="off"> pod 5€</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="radio" name="radiobuttonPrice" class="common_selector price" min="5" max="10" autocomplete="off"> 5€ - 10€</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="radio" name="radiobuttonPrice" class="common_selector price" min="10" max="20" autocomplete="off"> 10€ - 20€</label>
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

            </div>
        </div>
    </div>
</div>

