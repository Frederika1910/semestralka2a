<?php /** @var Array $data */ ?>
<div class="container-fluid">

    <div class="modal" id="productResponse" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" id="modelMsg">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <div class="sidebar">
                        <li class="sidebar-item">
                            <a href="?c=product&a=filterProduct" class="px-2">Zavrieť</a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <form id="my_form_id" name="reg" method="post"  novalidate>
    <div class="row justify-content-center">

        <div class="col-lg-5 col-sm-12">
                <h2 class="text-center bold">Objednávka</h2>
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example1cg">Meno</label>
                    <input type="text" name="name" id="meno" class="form-control form-control" onkeyup="validateText('meno')" placeholder="Meno..." required autocomplete="off"/>
                    <div id="valid"></div>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example1cg">Priezvisko</label>
                    <input type="text" name="surname" id="priezvisko" class="form-control" onkeyup="validateText('priezvisko')" placeholder="Priezvisko..." autocomplete="off" required/>
                    <div id="valid"></div>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example1cg">Ulica</label>
                    <input type="text" name="street" id="street" class="form-control" value="" onkeyup="validateText('street')" placeholder="Ulica..." autocomplete="off" required/>
                    <div id="valid"></div>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example1cg">Číslo domu</label>
                    <input type="text" name="houseNumber" id="houseNumber" class="form-control" onkeyup="validateNumbers('houseNumber')" placeholder="Číslo domu..." autocomplete="off" required/>
                    <div id="valid"></div>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example1cg">PSČ</label>
                    <input type="text" name="psc" id="psc" class="form-control" onkeyup="validatePSC()" placeholder="PSČ..." autocomplete="off"  required/>
                    <div id="valid"></div>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example1cg">Obec</label>
                    <input type="text" name="city" id="city" class="form-control" onkeyup="validateText('city')" placeholder="Obec..." autocomplete="off" required/>
                    <div id="valid"></div>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example4cg">Štát</label>
                    <input type="text" name="country" id="country" class="form-control" onkeyup="validateText('country')" placeholder="Štát..." autocomplete="off" required/>
                    <div id="valid"></div>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example4cg">Mobil</label>
                    <input type="text" name="mobile" id="mobileNumber" class="form-control" onkeyup="validateMobileNumber()" placeholder="Mobil..." autocomplete="off" required/>
                    <div id="valid"></div>
                </div>



        </div>
        <div class="col-lg-7 col-sm-12">
            <div class="row">
                <div class="col"><h5>Spôsoby platby</h5>
                    <div class="row justify-content-center">
                        <div class="col-lg-12 col-sm-12">
                            <?php
                            $sumaSpolu = 0;
                            foreach ($data['shopping_cart'] as $product) {
                                $sumaSpolu += $product->getItemPrice();
                            } ?>
                            <div>Zaplatiť: <?php echo $sumaSpolu ?>€</div>
                            <div class="meth">Poštovné: 0€</div>
                        </div>
                        <div class="col-lg-5 col-sm-12">
                            <div class="sidebar">
                                <li class="sidebar-item">
                                    <a onclick="myFunction('paymentMethodOne')" href="#" class="px-2">Dobierka</a>
                                </li>
                                <div id="paymentMethodOne" style="display: none">
                                    <input type="radio" id="radioButtonOne" name="paymentMethod" value="1" onclick="check('radioButtonOne')" autocomplete="off">Cena dobierky: 2€
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-sm-12">
                            <div class="sidebar">
                                <li class="sidebar-item"><a onclick="myFunction('paymentMethodTwo')" href="#" class="px-2">Online platba kartou</a></li>

                                <div id="paymentMethodTwo" style="display: none">
                                    <input type="radio" id="radioButtonTwo" name="paymentMethod" value="2" onclick="check('radioButtonTwo')" autocomplete="off">Platba kartou: zadarmo
                                    <form method="post">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Druh karty:</label>
                                            <select id="cards" onclick="check('radioButtonTwo')" autocomplete="off">
                                                <option value="false" selected>-----</option>
                                                <option value="Maestro">Maestro</option>
                                                <option value="MasterCard">MasterCard</option>
                                                <option value="Visa">Visa</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Číslo karty:</label>
                                            <input type="text" class="form-control" name="cardNumber" id="cardNumber" onkeyup="validateCardNumber()" placeholder="Číslo karty..." autocomplete="off" required>
                                            <div id="valid"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Dátum splatnosti:</label>
                                            <select id="months" onclick="check('radioButtonTwo')" autocomplete="off">
                                                <option value="false" selected>--</option>
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
                                            <select id="years" onclick="check('radioButtonTwo')" autocomplete="off">
                                                <option value="false" selected>----</option>
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
                    <a href="#"><button type="submit" id="payment_but" class="btn btn-success validate">Potvrdiť</button></a>
                </div>

            </div>
        </div>

    </div>
    </form>
</div>