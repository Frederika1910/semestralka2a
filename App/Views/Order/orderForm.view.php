<?php /** @var Array $data */ ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-5 col-sm-6">

            <form id="my_form_id" name="reg" method="post"  novalidate>
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
                    <input type="text" name="street" id="street" class="form-control" onkeyup="validateText('street')" placeholder="Ulica..." autocomplete="off" required/>
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


                <div class="d-flex justify-content-center">
                    <a href="?c=order&a=paymentForm"><button type="button" class="btn btn-success validate">Potvrdiť</button></a>
                </div>

            </form>
        </div>
    </div>
</div>