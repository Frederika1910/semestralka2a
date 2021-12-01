<?php /** @var Array $data */ ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-5 col-sm-6">

            <?php if ($data['error'] != "") { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <?= $data['error'] ?>
                </div>
            <?php } ?>

            <form method="post" name="chang" action="?c=auth&a=changePass">
                <h2 class="text-center bold">Zmena hesla</h2>
                <div class="form-group mb-2">
                    <label for="exampleInputEmail1">Stare heslo</label>
                    <input type="password"  class="form-control" name="oldPass" id="exampleInputEmail1"  placeholder="Stare heslo..." required>
                    <div id="valid"></div>
                </div>
                <div class="form-group mb-2">
                    <label for="exampleInputEmail1">Nove heslo</label>
                    <input type="password"  id="heslo" class="form-control" name="newPass" id="exampleInputEmail1" onkeyup="validatePassword()" placeholder="Nove heslo..." required>
                    <div id="valid"></div>
                </div>
                <div class="form-group mb-2">
                    <label for="exampleInputEmail1">Stare heslo znova</label>
                    <input type="password" id="hesloKontrola" class="form-control" name="newPassControl" id="exampleInputEmail1" onkeyup="validatePasswordControl()" placeholder="Nove heslo znova..." required>
                    <div id="valid"></div>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" id="registrovat" class="btn btn-success validate">Potvrdiť</button>
                </div>
            </form>
        </div>
    </div>
</div>