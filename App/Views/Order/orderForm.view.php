<?php /** @var Array $data */ ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-5 col-sm-6">

            <form id="my_form_id" name="reg" method="post" action="?c=order&a=daco" novalidate>
                <h2 class="text-center bold">Objednávka</h2>
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example1cg">Meno</label>
                    <input type="name" name="name" id="meno" class="form-control form-control" onkeyup="validateName()" placeholder="Meno..." required/>
                    <div id="valid"></div>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example1cg">Priezvisko</label>
                    <input type="name" name="surname" id="priezvisko" class="form-control" onkeyup="validateSurname()" placeholder="Priezvisko..." required/>
                    <div id="valid"></div>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example1cg">Ulica</label>
                    <input type="name" name="street" id="street" class="form-control" onkeyup="validateName()" placeholder="Ulica..." required/>
                    <div id="valid"></div>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example1cg">Číslo domu</label>
                    <input type="name" name="houseNumber" id="priezvisko" class="form-control" placeholder="Číslo domu..." required/>
                    <div id="valid"></div>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example1cg">PSČ</label>
                    <input type="name" name="psc" id="priezvisko" class="form-control"  placeholder="PSČ..." required/>
                    <div id="valid"></div>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example1cg">Obec</label>
                    <input type="name" name="city" id="priezvisko" class="form-control"  placeholder="Obec..." required/>
                    <div id="valid"></div>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example4cg">Štát</label>
                    <input type="name" name="country" id="priezvisko" class="form-control"  placeholder="Štát..." required/>
                    <div id="valid"></div>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example4cg">Mobil</label>
                    <input type="name" name="mobile" id="priezvisko" class="form-control" placeholder="Mobil..." required/>
                    <div id="valid"></div>
                </div>


                <div class="d-flex justify-content-center">
                    <input type="submit" name="formular" class="btn btn-success">
                </div>

            </form>
        </div>
    </div>
</div>