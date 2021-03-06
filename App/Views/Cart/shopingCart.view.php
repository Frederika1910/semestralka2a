<?php /** @var Array $data */ ?>
<div class="container">

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

    <?php $currentUser = \App\Auth::getId();
    $numberOfItems = 0;
    foreach ($data['shopping_cart'] as $item) {
        if ($item->getUserId() == $currentUser) {
            $numberOfItems++;
        }
    }
    if ($numberOfItems <= 0) { ?>
        <h5 style="text-align: center">Váš nákupný košík je prázdny.</h5>
    <?php } else { ?>

    <table class="table table-hover" id="tableShoppingCart">
        <thead>
        <tr>
            <th scope="col">Množstvo</th>
            <th scope="col">Názov</th>
            <th scope="col" class="productPrice">Cena produktu</th>
            <th scope="col">Cena spolu</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody class="tbody">
        <?php foreach ($data['shopping_cart'] as $item) {
           if ($item->getUserId() == $currentUser) { ?>
               <tr class="deleteItem<?php echo $item->getId() ?>">
                    <td>
                        <span id="quantity<?php echo $item->getId() ?>"><?php echo $item->getQuantity() ?></span>
                        <input type="text" id="quantityInput<?php echo $item->getId() ?>" class="form-control" onkeyup="validateQuantity('quantityInput<?php echo $item->getId() ?>')" placeholder="Mnozstvo..." style="display: none;" required>
                        <div class="valid"></div>
                    </td>
                    <?php $product = \App\Models\Product::getOne($item->getProductId()) ?>
                    <td><?php echo $product->getName() ?></td>
                    <td class="colPrice"><?php echo $product->getPrice() ?>€</td>
                    <td id="price<?php echo $item->getId() ?>"><?php echo $item->getQuantityPrice() ?>€</td>

                    <td>
                        <button type="button" id="edit_but<?php echo $item->getId() ?>" class="btn btn-success editBut" data-id="<?php echo $item->getId() ?>"><i class="bi bi-pen"></i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                </svg>
                        </button>

                        <button type="button"  id="save_but<?php echo $item->getId() ?>" class="btn btn-success saveBut" data-id="<?php echo $item->getId() ?>" data-price="<?php echo $product->getPrice() ?>" style="display: none;"><i class="bi bi-check"></i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                </svg>
                        </button>
                    </td>
                    <td>
                        <button type="button" id="delete_but<?php echo $item->getId() ?>" class="btn btn-danger delBut" data-id="<?php echo $item->getId() ?>"><i class="bi bi-trash"></i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </button>
                    </td>
                </tr>

        <?php }
        }?>
        </tbody>
    </table>

        <?php $spolu = 0;
        foreach ($data['shopping_cart'] as $item) {
            $product = \App\Models\Product::getOne($item->getProductId());
            if ($item->getUserId() == $currentUser) {
                $spolu += $product->getPrice();
            }
        } ?>
        <div style="float: right">
            <?php $currentUser = \App\Auth::getId();
            $numberOfItems = 0;
            foreach ($data['shopping_cart'] as $item) {
                if ($item->getUserId() == $currentUser) {
                    $numberOfItems++;
                }
            }
            if ($numberOfItems > 0) { ?>
                <button class="btn btn-success p-1" id="order_but" onclick="getOrderForm()" type="button">Objednať</button>
            <?php } ?>
        </div>
    <?php } ?>
</div>