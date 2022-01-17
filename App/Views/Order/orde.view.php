<?php /** @var Array $data */ ?>

<div class="modal" id="orderDetail" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" id="orderDetailMsg">

            </div>
        </div>
    </div>
</div>

<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Počet produktov</th>
        <th scope="col">Dátum objednania</th>
        <th scope="col" class="stateOrder">Stav</th>
        <th scope="col">Cena spolu</th>
    </tr>
    </thead>
    <tbody class="tbody">
    <?php $pocet = 0;
    $currentUser = \App\Auth::getId();
    foreach ($data['orders'] as $order) {
        if ($order->getUserId() == $currentUser) {
            $pocet++?>
            <tr>
                <td><?php echo $pocet ?></td>
                <td><?php echo $order->getNumberOfProducts() ?></td>
                <td><?php echo $order->getDate() ?></td>
                <td class="stateOrder" id="stateValue">
                    <?php foreach ($data['states'] as $state) {
                        if ($state->getId() == $order->getState()) {
                            echo $state->getNameState();
                            break;
                        }
                    }?>
                </td>
                <td><?php echo $order->getTotalPrice() ?>€</td>
                <td>
                    <?php if ($order->getState() == 2) { ?>
                        <button type="submit" disabled="true" id="stornoBut<?php echo $order->getId() ?>" class="btn btn-danger delOrderBut" dataId="<?php echo $order->getId() ?>""><i class="bi bi-trash"></i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                        </button>
                    <?php } else { ?>
                        <button type="submit" id="stornoBut<?php echo $order->getId() ?>" class="btn btn-danger delOrderBut" dataId="<?php echo $order->getId() ?>""><i class="bi bi-trash"></i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </button>
                    <?php } ?>
                </td>
            </tr>
        <?php }
    }?>
    </tbody>
</table>
