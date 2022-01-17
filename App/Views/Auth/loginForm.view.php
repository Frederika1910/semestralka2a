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

            <form method="post" action="?c=auth&a=login">
                <h2 class="text-center bold">Prihlásenie</h2>
                <div class="form-group">
                    <label for="exampleInputEmail1">E-mail</label>
                    <input type="text" class="form-control" name="login" id="exampleInputEmail1" placeholder="E-mail..." required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Heslo</label>
                    <input type="password"  class="form-control" name="password" id="exampleInputPassword1" placeholder="Heslo..." required>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Zapamätať</label>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">Prihlásiť</button>
                </div>
            </form>
        </div>
    </div>
</div>