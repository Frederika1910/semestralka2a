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
                        <ul>
                            <li class="sidebar-item"><a href="?c=product&a=filterProduct" class="px-2">Zavrieť</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <form id="order_form" name="reg" method="post"  novalidate>
        <div class="row justify-content-center">

            <div class="col-lg-5 col-sm-12">
                    <h2 class="text-center bold">Doručovacie údaje</h2>
                    <div class="form-outline mb-4">
                        <label class="form-label">Meno</label>
                        <input type="text" name="name" id="meno" class="form-control form-control" onkeyup="validateText('meno')" placeholder="Meno..." autocomplete="off" required>
                        <div class="valid"></div>
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label">Priezvisko</label>
                        <input type="text" name="surname" id="priezvisko" class="form-control" onkeyup="validateText('priezvisko')" placeholder="Priezvisko..." autocomplete="off" required>
                        <div class="valid"></div>
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label">Ulica</label>
                        <input type="text" name="street" id="street" class="form-control" value="" onkeyup="validateText('street')" placeholder="Ulica..." autocomplete="off" required>
                        <div class="valid"></div>
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label">Číslo domu</label>
                        <input type="text" name="houseNumber" id="houseNumber" class="form-control" onkeyup="validateHouseNumber()" placeholder="Číslo domu..." autocomplete="off" required>
                        <div class="valid"></div>
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label">PSČ</label>
                        <input type="text" name="psc" id="psc" class="form-control" onkeyup="validateNumber('psc',5)" placeholder="PSČ..." autocomplete="off"  required>
                        <div class="valid"></div>
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label">Obec</label>
                        <input type="text" name="city" id="city" class="form-control" onkeyup="validateText('city')" placeholder="Obec..." autocomplete="off" required/>
                        <div class="valid"></div>
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label">Štát</label>
                        <input type="text" name="country" id="country" class="form-control" onkeyup="validateText('country')" placeholder="Štát..." autocomplete="off" required/>
                        <div class="valid"></div>
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label">Mobil</label>
                        <input type="text" name="mobile" id="mobileNumber" class="form-control" onkeyup="validateMobileNumber()" placeholder="Mobil..." autocomplete="off" required/>
                        <span>Zadávajte v tvare +421...</span>
                        <div class="valid"></div>
                    </div>


                <div class="d-flex" style="justify-content: flex-end">
                    <button type="submit" id="payment_but" class="btn btn-success">Potvrdiť</button>
                </div>
            </div>

        </div>
    </form>
</div>