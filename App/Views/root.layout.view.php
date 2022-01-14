<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>Domov</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway+Dots" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="semestralka2/index1.css" type="text/css">
    <script src="semestralka2/javascript.js" async></script>
</head>
<body>

<nav class="py-2 darkMode">
    <div class="container d-flex flex-wrap">
        <ul class="nav me-auto">
            <li class="nav-item"><a href="?c=home" class="px-2">Domov</a></li>
            <li class="nav-item"><a href="?c=product&a=filterProduct" class="px-2">Oblečenie</a></li>
            <li class="nav-item"><a href="?c=home&a=qa" class="px-2">Q&A</a></li>
            <li class="nav-item"><a href="?c=home&a=aboutus" class="px-2">O nás</a></li>
        </ul>
        <?php if (\App\Auth::isLogged()) { ?>
            <ul class="nav">
                <li class="nav-item"><a class="text-decoration-none px-2" href="?c=cart&a=shopingCart">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket" viewBox="0 6 16 10">
                        <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"></path>
                    </svg></a>
                </li>
                <li class="nav-item"><a href="?c=home&a=loggedUser" class="px-2">Môj účet</a></li>
            <li class="nav-item"><a href="?c=auth&a=logout" class="px-2">Logout</a></li>
        </ul>
        <?php } else { ?>
        <ul class="nav">
            <li class="nav-item"><a href="?c=auth&a=loginForm" class="px-2">Prihlás sa</a></li>
            <li class="nav-item"><a href="?c=auth&a=registerForm" class="px-2">Zaregistruj sa</a></li>
        </ul>
        <?php } ?>

    </div>
</nav>
<header class="py-3 mb-4">
    <div class="container d-flex flex-wrap justify-content-center">
        <a href="#"><img src="https://fontmeme.com/permalink/211013/ae661bb1485a4a85200935c040313177.png" class="img-fluid" alt="Second hand u Inky"></a>
    </div>
</header>

<div class="modal" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" id="textInModal">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" id="myBtnClose" class="btn btn-secondary" data-dismiss="modal">Zavrieť</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <?= $contentHTML ?>
        </div>
    </div>
</div>

<footer class="footer mt-4 darkMode">
    <div class="container text-center">
        <div class="row d-flex">
            <div class="col-12">
                <ul id="services">
                    <li>
                        <div class="facebook darkMode">
                            <a href="#">
                                <i class="fa fa-facebook-f" aria-hidden="true"></i>
                            </a>
                        </div>
                        <span>Facebook</span>
                    </li>
                    <li>
                        <div class="youtube">
                            <a href="#">
                                <i class="fa fa-youtube" aria-hidden="true"></i>
                            </a>
                        </div>
                        <span>YouTube</span>
                    </li>
                    <li>
                        <div class="instagram">
                            <a href="#">
                                <i class="bi bi-instagram"></i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                </svg>

                            </a>
                        </div>
                        <span>Instagram</span>
                    </li>
                </ul>
            </div>
        </div>
        <?php if (\App\Auth::isLogged()) { ?>
            <p class="text" style="color: #f1f1f1">
                <a href="?c=auth&a=cancelAccount" class="text-reset">Chcem zrušiť svoj účet.</a>
            </p>
        <?php } ?>

        <div class="col m-2">
            <button type="button" class="btn btn-light" id="myBtn" data-mdb-ripple-color="dark" style="color: #999900">Skús šťastie!</button>
        </div>
        <div class="col m-2">
            <button onclick="setMode()" type="button" class="btn btn-light" data-mdb-ripple-color="dark" style="color: #999900">Tmavý režim</button>
        </div>
        <hr class="solid">
        <span>Second Hand u Inky<br>
          Jedinečné, kvalitné a lacné kúsky pre každého.</span>
    </div>
</footer>
</body>
</html>