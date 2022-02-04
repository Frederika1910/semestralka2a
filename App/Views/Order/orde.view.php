<?php /** @var Array $data */

use App\Models\State; ?>

<div class="container">

    <nav class="navbar navbar-light light-blue lighten-4">
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
                <?php if (\App\Auth::isLogged() && \App\Auth::isAdmin()) { ?>
                        <div class="list-group">
                            <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                                <div class="row" style="align-content: center">
                                    <div class="list-group-item checkbox">
                                        <label><input type="radio" name="radiobuttonOrder" class="common_selector order" value="1">Na odoslanie</label>
                                    </div>
                                    <div class="list-group-item checkbox">
                                        <label><input type="radio" name="radiobuttonOrder" class="common_selector order" value="3">Na stornovanie</label>
                                    </div>
                                    <button type="button" id="orders_filter_but" class="btn btn-primary" style="background-color:  #8B0000; align-self: flex-end">Potvrdiť</button>
                                </div>
                            </div>
                        </div>
                <?php } ?>
            </div>
        </div>
    </nav>


    <?php if (\App\Auth::isLogged() && \App\Auth::isAdmin()) { ?>
        <div class="row rBBigScreen" style="align-content: center">
            <div class="col-md-3 col-sm-12 checkbox">
                <label><input type="radio" name="radiobuttonOrder" class="common_selector order" value="1">Na odoslanie</label>
            </div>
            <div class="col-md-3 col-sm-12">
                <label><input type="radio" name="radiobuttonOrder" class="common_selector order" value="3">Na stornovanie</label>
            </div>
            <div class="col-md-3 col-sm-12">
                <button type="button" id="orders_filter_but" class="btn btn-primary" style="background-color:  #8B0000; align-self: flex-end">Potvrdiť</button>
            </div>
        </div>
    <?php } ?>

    <div class="modal" id="orderDetail" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" id="orderDetailMsg">

                </div>
            </div>
        </div>
    </div>

    <table class="table table-hover" id="tableOrders">
        <thead>
        <tr>
            <?php if (\App\Auth::isAdmin()) {?>
                <th scope="col">ID používateľa</th>
            <?php } ?>
            <th scope="col">Počet produktov</th>
            <th scope="col">Dátum objednania</th>
            <th scope="col">Stav</th>
            <th scope="col">Cena spolu</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody class="tbody" id="userOrders">
        <?php
        $currentUser = \App\Auth::getId();
        foreach ($data['orders'] as $order) {
            if ($order->getUserId() == $currentUser) { ?>
                <tr class="sendItem<?php echo $order->getId()?>">
                    <td class="colNUmberProducts"><?php echo $order->getNumberOfProducts() ?></td>
                    <td class="colDate"><?php echo $order->getDate() ?></td>
                    <td id="stateValue<?php echo $order->getId()?>"><?php echo State::getOne($order->getState())->getNameState() ?></td>
                    <td><?php echo $order->getTotalPrice() ?>€</td>
                    <td>
                        <?php if ($order->getState() == 1) { ?>
                            <button type="button" id="stornoBut<?php echo $order->getId() ?>" class="btn btn-danger delOrderBut" dataId="<?php echo $order->getId() ?>"><i class="bi bi-trash"></i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                            </button>
                        <?php } else { ?>
                            <button type="button" id="stornoBut<?php echo $order->getId() ?>" class="btn btn-danger delOrderBut" disabled dataId="<?php echo $order->getId() ?>"><i class="bi bi-trash"></i>
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
</div>
