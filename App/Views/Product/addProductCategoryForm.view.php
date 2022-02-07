<?php /** @var Array $data */ ?>

<div class="container-fluid">
    <div class="modal" id="categoryResponse" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" id="categoryMsg">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <div class="sidebar">
                        <ul>
                            <li class="sidebar-item">
                                <a href="?c=home&a=loggedUser" class="px-2">Zavrieť</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-5 col-sm-6">
            <form id = "formAddCategory" name="reg" method="post" novalidate>
                <h2 class="text-center bold">Pridanie novej kategórie produktu</h2>
                <div class="form-outline mb-4">
                    <label class="form-label">Názov</label>
                    <input type="text" id="categoryName" class="form-control form-control" name="username" onkeyup="validateText('categoryName')" autocomplete="off" placeholder="Názov..." required/>
                    <div class="valid"></div>
                </div>
                <div class="d-flex justify-content-center" id="submit-info">
                    <button type="submit" class="btn btn-success">Pridať</button>
                </div>
            </form>
        </div>
    </div>
</div>