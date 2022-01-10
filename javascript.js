function setMode() {
    let darkModeOn = localStorage.getItem('darkMode');
    if (darkModeOn) {
       localStorage.removeItem('darkMode');
       console.log(true);
    } else {
        localStorage.setItem('darkMode', "black");
    }

    getDarkMode();
}

function getDarkMode() {
    let darkModeOn = localStorage.getItem('darkMode');
    let elements = document.querySelectorAll(".darkMode");
    if (darkModeOn) {
        for (let i=0; i<elements.length; i++) {
            elements[i].style.background = localStorage.getItem("darkMode");
        }
    } else {
        for (let i=0; i<elements.length; i++) {
            elements[i].style.background = "#A6923F";
        }
    }
}

let clickNumber = 0;
let alreadyWon = false;

let popup = document.getElementById("myModal");
let button = document.getElementById("myBtn");
let buttonClose = document.getElementById("myBtnClose");

button.onclick = function() {
    if (clickNumber < 2 && !alreadyWon) {
        let randomValue = Math.floor(Math.random() * 101);
        console.log(clickNumber);

        if (randomValue <= 50) {
            document.getElementById("textInModal").innerHTML = "Gratulujeme! Vyhral si 20% zľavu na nákup.";
            alreadyWon = true;
        } else {
            document.getElementById("textInModal").innerHTML = "Nevadí, nabudúce výjde.";
        }

        popup.style.display = "block";
        clickNumber++;
    } else {
        popup.style.display = "none";
    }
}

buttonClose.onclick = function() {
    popup.style.display = "none";
}

window.onload = function() {
    getDarkMode();

    if(document.querySelector(".validate")) {
        document.querySelector(".validate").disabled = true;
    }

    if (document.querySelector("#vKosiku")) {
        addProductToBasketDisplay();
    }
    let products = document.querySelectorAll(".add-cart");

    for (let i=0; i < products.length; i++) {
        products[i].addEventListener('click', () => {
            addProductToBasket(products[i]);
        })
    }
}

function addProductToBasket(product) {
    let productsInBasket = localStorage.getItem('currentNumberOfProducts');

    let productsInBasketInt = parseInt(productsInBasket);

    if (productsInBasketInt) {
        localStorage.setItem('currentNumberOfProducts', productsInBasketInt + 1);
        document.querySelector('#vKosiku').textContent = productsInBasketInt + 1;
    } else {
        localStorage.setItem('currentNumberOfProducts', 1);
        document.querySelector("#vKosiku").textContent = 1;
    }
}

function addProductToBasketDisplay() {
    let productsInBasket = localStorage.getItem('currentNumberOfProducts');

    if (productsInBasket) {
        document.querySelector('#vKosiku').textContent = productsInBasket;
    }
}

let navhood2 = "";
let navhood3 = "";
let navhood4 = "";
let navhood5 = "";

function setSubmitButton() {
    if (document.forms.namedItem('name') != null) {
        if (navhood2 == null && navhood3 == null && navhood4 == null && navhood5 == null) {
            document.querySelector(".validate").disabled = false;
        }
    } else if (navhood4 == null && navhood5 == null) {
        document.querySelector(".validate").disabled = false;
    }
}

function displayInputInColor(string, element) {
    let elementId = document.getElementById(element.id);
    let elementParent = elementId.parentElement;
    let divErrorText = elementParent.querySelector("#valid")
    let errorText = [];

    if (string != null) {
        element.style.borderColor = "red"
        errorText.push(string);
        divErrorText.style.color = "red";
        divErrorText.innerHTML = errorText.join(', ');
    } else {
        errorText.pop();
        element.style.borderColor = "green"
        divErrorText.innerHTML = "";
    }

    setSubmitButton();
}

function validateName() {

    let input = document.getElementById("meno");
    validateNameOrSurname(input)
}

function validateSurname() {
    let input = document.getElementById("priezvisko");
    validateNameOrSurname(input);
}

function validateNameOrSurname(input) {
    let inputValue = input.value;
    let disabledChar = /[0-9]/;

    if (!inputValue || inputValue.length == 0) {
        navhood2 = "Pole nesmie byť prázdne.";
        return displayInputInColor(navhood2, input);
    } else if (disabledChar.test(inputValue)){
        navhood2 = "Pole nesmie obsahovať číslice.";
        return displayInputInColor(navhood2, input);
    }
    navhood2 = null;
    return displayInputInColor(navhood2, input);
}

function validateEmail() {
    let input = document.getElementById("mail");
    let mailValue = input.value;
    let disabledChar = /[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/;

    if (!mailValue || mailValue.length == 0) {
        navhood3 = "Pole nesmie byť prázdne.";
        return displayInputInColor(navhood3, input);
    } else if (!disabledChar.test(mailValue)) {
        navhood3 = "E-mail musí mať tvar: inka@priklad.sk";
        return displayInputInColor(navhood3, input);
    }
    navhood3 = null;
    return displayInputInColor(navhood3, input);
}

function validatePassword() {
    let input = document.getElementById("heslo");
    let passwordValue = input.value;
    let disabledChar = /[a-z]/;
    let disabledCharCapitalLetter = /[A-Z]/;
    let disabledCharNumber = /[0-9]/;

    if (!passwordValue) {
        navhood4 = "Pole nesmie byť prázdne.";
        return displayInputInColor(navhood4, input);
    } else if (!disabledChar.test(passwordValue)) {
        navhood4 = "Heslo nesmie obsahovať špeciálne znaky."
        return displayInputInColor(navhood4, input);
    } else if (passwordValue.length <= 5) {
        navhood4 = "Heslo musí mať minimálne 5 znakov.";
        return displayInputInColor(navhood4, input);
    } else if (!disabledCharCapitalLetter.test(passwordValue)) {
        return displayInputInColor("Heslo musí obsahovať aspoň 1 veľké písmeno.", input);
    } else if (!disabledCharNumber.test(passwordValue)) {
        navhood4 = "Heslo musí obsahovať aspoň 1 číslicu.";
        return displayInputInColor(navhood4, input);
    }
    navhood4 = null;
    return displayInputInColor(navhood4, input);
}

function validatePasswordControl() {
    let password = document.getElementById("heslo");
    let passwordControl = document.getElementById("hesloKontrola");
    if (passwordControl.value != password.value) {
        navhood5 = "Heslá sa nezhodujú.";
        return displayInputInColor(navhood5, passwordControl);
    }

    navhood5 = null;
    return displayInputInColor(navhood5, passwordControl);
}

$(document).ready(function () {
        $('#my_form_id').submit(function (e) {
            e.preventDefault();

            let c = $('#street').value;
            console.log(c);
            $.ajax({
                method: 'POST',
                url: 'http://localhost/semestralka2?c=order&a=daco',
                data: $('#my_form_id').serialize(),
                success: function (data) {
                    console.log(data);
                }
            })
        })
});

$(document).ready(function() {
    $(document).on('click', '#delete_but', function () {
        let del_id = $(this).attr('dataId');
        let del_price = $(this).attr('dataPrice');

        $.ajax({
            method: 'POST',
            url: 'http://localhost/semestralka2?c=cart&a=removeOrderItem',
            data: {
                deleteItem: del_id,
            },
            success: function (html) {
                $(".deleteItem" + del_id).fadeOut('slow');
            }
        })
    })
})

$(document).ready(function() {
    $(document).on('click', '.editBut', function(){
        let edit_id = $(this).attr('dataId');

        $('#quantity'+edit_id).hide();
        $('#quantityInput'+edit_id).show();

        $('#edit_but'+edit_id).hide();
        $('#save_but'+edit_id).show();

    })
})

$(document).ready(function() {
    $(document).on('click', '#edit_order_item', function(){
        let product_id = $(this).attr('dataId');

        $.ajax({
            method: 'POST',
            url: 'http://localhost/semestralka2?c=product&a=addProductToCart',
            data: {
                id: product_id
            },
            success: function (data) {
                if (data === "uzVKosiku") {
                    $('#modelMsg').html("Produkt sa v kosiku uz nachadza.");
                    $('#productResponse').show();
                } else {
                    $('#modelMsg').html("Produkt bol uspesne pridany do kosika.");
                    $('#productResponse').show();
                }
            }
        })

    })
})

$(document).ready(function() {
    $(document).on('click', '#cancel_but', function(){
        $('#productResponse').hide();
    })
})

$(document).ready(function() {
    $(document).on('click', '.saveBut', function(e){
            e.preventDefault();
            let edit_id = $(this).attr('dataId');
            let quantity_price = $(this).attr('dataQuantityPrice');

            let quantity_input = parseInt($('#quantityInput'+edit_id).val());
            let totalPrice = quantity_price * quantity_input;
            let aString = quantity_input.toString();
            let totalPriceString = totalPrice.toString();

            $.ajax({
                type: 'POST',
                url: 'http://localhost/semestralka2?c=cart&a=editOrderItem',
                data: {text: $('#quantityInput'+edit_id).val(),
                    oldItem: edit_id,
                    },
                success: function (html, data) {
                    $('#quantityInput'+edit_id).hide();
                    $('#quantity'+edit_id).show();

                    $('#save_but'+edit_id).hide()
                    $('#edit_but'+edit_id).show();

                    $('#quantity'+edit_id).html(aString);
                    $('#price'+edit_id).html(totalPriceString+'€');
                }
            })
        })
})

