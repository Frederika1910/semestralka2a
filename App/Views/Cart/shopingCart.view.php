<?php /** @var Array $data */ ?>

    <?php if (empty($data['shopping_cart'])) { ?>
        <h5 align="center">Váš nákupný košík je prázdny.</h5>
    <?php } else { ?>

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col" class="productNo">#</th>
            <th scope="col">Množstvo</th>
            <th scope="col" class="productId">Produkt ID</th>
            <th scope="col">Názov</th>
            <th scope="col" class="productPrice">Cena produktu</th>
            <th scope="col">Cena spolu</th>
        </tr>
        </thead>
        <tbody class="tbody">
        <?php $index = 1 ?>
        <?php foreach ($data['shopping_cart'] as $item) { ?>
                <tr class="deleteItem<?php echo $item->getId() ?>">
                    <td class="productNo"><?php echo $index++ ?></td>
                    <td>
                        <span id="quantity<?php echo $item->getId() ?>"><?php echo $item->getQuantity() ?></span>

                        <input type="name" id="quantityInput<?php echo $item->getId() ?>" class="form-control" placeholder="Mnozstvo..." style="display: none;"/>

                    </td>
                    <td class="productId"><?php echo $item->getProductId() ?></td>
                    <td><?php echo $item->getProductName() ?></td>
                    <td class="productPrice"><?php echo $item->getItemPrice() ?>€</td>
                    <td id="price<?php echo $item->getId() ?>"><?php echo $item->getQuantityPrice() ?>€</td>

                    <td>
                        <button type="submit" id="edit_but<?php echo $item->getId() ?>" class="btn btn-success editBut" dataId="<?php echo $item->getId() ?>" dataPrice="<?php echo $item->getItemPrice() ?>" dataQuantity="<?php echo $item->getQuantity() ?>"><i class="bi bi-pen"></i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                </svg>
                        </button>

                        <button type="submit"  id="save_but<?php echo $item->getId() ?>" class="btn btn-success saveBut" dataId="<?php echo $item->getId() ?>" dataPrice="<?php echo $item->getItemPrice() ?>" dataQuantity="<?php echo $item->getQuantity() ?>" dataQuantityPrice="<?php echo $item->getQuantityPrice() ?>" style="display: none;"><i class="bi bi-check"></i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                </svg>
                        </button>
                    </td>
                    <td>
                        <button type="submit" id="delete_but<?php echo $item->getId() ?>" name="del" class="btn btn-danger delBut" dataId="<?php echo $item->getId() ?>" dataPrice="<?php echo $item->getItemPrice() ?>"><i class="bi bi-trash"></i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </button>
                    </td>
                </tr>

        <?php } ?>


                <?php $spolu = 0;
                foreach ($data['shopping_cart'] as $item) {
                    $spolu += $item->getItemPrice();
                }?>
        </tbody>
    </table>
        <?php if (isset($data['shopping_cart'])) { ?>
            <a href="?c=order&a=orderForm"><button class="btn btn-success p-1" id="order_but" type="button" style="float: right">Objednať</button></a>
        <?php } ?>
    <?php } ?>
