<?php /** @var Array $data */ ?>

<h1 class="text-center">Vítame, Vás vo Vašom účte.</h1>
<div class="row">
    <div class="col-lg-6 col-md-12 mt-2">
        <div class="info">
            <div class="card user" style="width: 20rem;">
                <div class="card-body text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>

                    <h5 class="card-title">Zmena hesla</h5>
                    <p class="card-text">Tu si môžete upraviť Vaše heslo.</p>
                    <a href="?c=auth&a=changePassword" class="btn btn-success mt-2">Upraviť moje heslo</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-12 mt-2">
        <div class="info">
            <div class="card user" style="width: 20rem;">
                <div class="card-body text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    <h5 class="card-title">Objednávky</h5>
                    <p class="card-text">Tu si môžete prezrieť Vaše objednávky.</p>
                    <a href="?c=order&a=orde" class="btn btn-success mt-2">Prehľad objednávok</a>
                </div>
            </div>
        </div>
    </div>

    <?php if (\App\Auth::isLogged() && \App\Auth::isAdmin()) { ?>
        <div class="col-lg-6 col-md-12 mt-2">
            <div class="info">
                <div class="card user" style="width: 20rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kategórie produktov</h5>
                        <a href="?c=product&a=addProductCategoryForm" class="btn btn-success mt-2">Pridať novú kategóriu</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 mt-2">
            <div class="info">
                <div class="card user" style="width: 20rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kategórie produktov</h5>
                        <a href="?c=product&a=removeProductCategory" class="btn btn-success mt-2">Zmazať kategóriu</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

</div>