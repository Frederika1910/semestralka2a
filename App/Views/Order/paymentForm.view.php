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

    <div class="row">
        <div class="col"><h5>Spôsoby platby</h5>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-sm-12">
                    <?php
                    $sumaSpolu = 0;
                    foreach ($data['shopping_cart'] as $product) {
                        $sumaSpolu += $product->getItemPrice();
                    } ?>
                    <div>Zaplatiť: <?php echo $sumaSpolu ?>€</div>
                    <div class="meth">Poštovné: 0€</div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="sidebar">
                        <li class="sidebar-item">
                            <a onclick="myFunction('paymentMethodOne')" href="#" class="px-2">Dobierka</a></li>

                        <div id="paymentMethodOne" style="display: none">
                            <input type="radio" id="radioButtonOne" name="paymentMethod" autocomplete="off">Cena dobierky: 2€
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="sidebar">
                        <li class="sidebar-item"><a onclick="myFunction('paymentMethodTwo')" href="#" class="px-2">Online platba kartou</a></li>

                        <div id="paymentMethodTwo" style="display: none">
                            <input type="radio" id="radioButtonTwo" name="paymentMethod" autocomplete="off">Platba kartou: zadarmo
                            <form method="post">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Druh karty:</label>
                                    <select id="cards">
                                        <option value="Maestro">Maestro</option>
                                        <option value="MasterCard">MasterCard</option>
                                        <option value="Visa">Visa</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Číslo karty:</label>
                                    <input type="text" class="form-control" name="cardNumber" id="exampleInputEmail1" placeholder="Číslo karty..." required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Dátum splatnosti:</label>
                                    <select id="months">
                                        <option value="1">01</option>
                                        <option value="2">02</option>
                                        <option value="3">03</option>
                                        <option value="4">04</option>
                                        <option value="5">05</option>
                                        <option value="6">06</option>
                                        <option value="7">07</option>
                                        <option value="8">08</option>
                                        <option value="9">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                    /
                                    <select id="years">
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                    </select>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex" style="justify-content: flex-end">
            <a href="?c=order&a=paymentForm"><button type="button" id="payment_but" class="btn btn-success validate">Potvrdiť</button></a>
        </div>
    </div>
</div>