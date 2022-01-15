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

function addProductToBasket() {
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
let paymentPartOne = null;
let paymentPartTwo = null;

function setSubmitButton() {
    console.log("uspech");

    if (paymentPartOne != null) {
        document.querySelector(".validate").disabled = false;
    } else if (paymentPartTwo != null) {
        if (navhood2 == null && navhood6 == null && navhood7 == null && navhood8 == null && navhood9 == null && paymentPartTwo === true) {
            console.log("if3");
            document.querySelector(".validate").disabled = false;
        }
    } else if (navhood2 == null && navhood3 == null && navhood4 == null && navhood5 == null) {
            console.log("if1");
            document.querySelector(".validate").disabled = false;

    } else if (navhood4 == null && navhood5 == null) {
        console.log("if2");
        document.querySelector(".validate").disabled = false;
    }
}

function check(id) {
    let rB = document.getElementById(id);
    console.log("id " + id);
    console.log(rB);
    if (id === "radioButtonOne" && rB.checked) {
        console.log("prvyif");
        paymentPartOne = true;
    } else if (id === "radioButtonTwo" && rB.checked) {
        paymentPartOne = null;
        console.log("druhyif");

        let mon = document.getElementById('months');
        let year = document.getElementById('years');
        let card = document.getElementById('cards');

        let error = false;


        if (mon.options[mon.selectedIndex].value === "false" || year.options[year.selectedIndex].value === "false" || card.options[card.selectedIndex].value === "false") {
            console.log(mon.options[mon.selectedIndex].value);
            error = true;
        }

        if (error) {
            paymentPartTwo = null;
            document.querySelector(".validate").disabled = true;
        } else {
            paymentPartTwo = true;
        }

    }
    setSubmitButton();
    //for (let i=0; i<2; i++) {
    //    if (rB[i].checked) {
    //        paymentPart = true;
    //    }
    //}
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

function validateText(id) {
    let input = document.getElementById(id);
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

let navhood6 = "";
function validateNumbers(id) {
    let input = document.getElementById(id);
    let inputValue = input.value;
    let disabledChar = /^\d*\.?\d*$/;

    if (!inputValue) {
        navhood6 = "Pole nesmie byť prázdne.";
        return displayInputInColor(navhood6, input);
    } else if (!disabledChar.test(inputValue)) {
        navhood6 = "Pole nesmie obsahovať znaky.";                                      //pozor lomka
        return displayInputInColor(navhood6, input);
    }

    navhood6 = null;
    return displayInputInColor(navhood6, input);
}


let navhood9 = "";
function validateCardNumber() {
    let input = document.getElementById('cardNumber');
    let cardValue = input.value;
    let disabledChar = /^\d*\.?\d*$/;

    if (!cardValue) {
        navhood9 = "Pole nesmie byť prázdne.";
        return displayInputInColor(navhood9, input);
    } else if (!disabledChar.test(cardValue)) {
        navhood9 = "Pole nesmie obsahovať znaky.";                                      //pozor lomka
        return displayInputInColor(navhood9, input);
    }

    navhood9 = null;
    return displayInputInColor(navhood9, input);
}

let navhood8 = "";
function validateMobileNumber() {
    let mobile = document.getElementById("mobileNumber");
    let mobileValue = mobile.value;
    let disabledChar = /^\d*\.?\d*$/;

    if (!mobileValue) {
        navhood8 = "Pole nesmie byť prázdne.";
        return displayInputInColor(navhood8, mobile);
    } else if (!disabledChar.test(mobileValue)) {
        navhood8 = "Pole nesmie obsahovať znaky.";                                      //pozor lomka
        return displayInputInColor(navhood8, mobile);
    }

    navhood8 = null;
    return displayInputInColor(navhood8, mobile);
}

let navhood7 = "";
function validatePSC() {
    let input = document.getElementById("psc");
    let inputValue = input.value;
    let disabledChar = /[a-zA-Z]/;

    if (!inputValue) {
        navhood7 = "Pole nesmie byť prázdne.";
        return displayInputInColor(navhood7, input);
    }

    if (inputValue.length < 5 || inputValue.length > 5 || disabledChar.test(inputValue)) {
        navhood7 = "PSČ musí mať 5 znakov.";
        return displayInputInColor(navhood7, input);
    }


    navhood7 = null;
    return displayInputInColor(navhood7, input);
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

        let name = $('#meno').val();
        let surname = $('#priezvisko').val();
        let street = $('#street').val();
        let house_number = $('#houseNumber').val();
        let psc = $('#psc').val();
        let country = $('#country').val();
        let city = $('#city').val();
        let mobile_number = $('#mobileNumber').val();
        let radio_first =  $('#radioButtonOne').checked;
        console.log(radio_first);
        $.ajax({
            method: 'POST',
            url: 'http://localhost/semestralka2?c=order&a=daco',
            data: {
                nameA: name,
                surnameA: surname,
                streetA: street,
                houseNumberA: house_number,
                pscA: psc,
                countryA: country,
                cityA: city,
                mobileNumberA: mobile_number,
                rbOne: radio_first
            },
            success: function () {
                console.log(radio_first);
                $('#modelMsg').html("Objednávka prebehla úspešne.");
                $('#productResponse').show();
            }
        })
    })
});

$(document).ready(function() {
    $(document).on('click', '.delBut', function () {
        let del_id = $(this).attr('dataId');
        let numberOfRows = $('.table').length;

        $.ajax({
            method: 'POST',
            url: 'http://localhost/semestralka2?c=cart&a=removeOrderItem',
            data: {
                deleteItem: del_id,
            },
            success: function () {
                $('.deleteItem' + del_id).fadeOut('slow');

                if (numberOfRows <= 1) {
                    $('.tbody').fadeOut('slow');
                }

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
        $('#productDetail').hide();
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
                success: function () {
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

$(document).ready(function() {
    $(document).on('click', '#filter_but', function () {
        let category_id = getFilter('category');
        let min_price = $('.price:checked').attr('min');
        let max_price = $('.price:checked').attr('max');
        let gender = getFilter('gender');
        console.log(min_price);
        console.log(max_price);
        console.log(gender);
        console.log(category_id);

        $.ajax({
            type: 'POST',
            url: 'http://localhost/semestralka2?c=product&a=showFilteredProducts',
            data: {
                category: category_id,
                minPrice: min_price,
                maxPrice: max_price,
                gender: gender
            },
            dataType: 'json',
            success: function (data) {
                $('.filter_data').html(data);
                console.log(data);
            }
        })
    })
})


function getFilter(filter) {
    return $('.' + filter + ':checked').val();
}

$(document).ready(function() {
    $(document).on('click', '#clear_but', function () {
       document.querySelector('.common_selector').checked = false;
    })
})

function myFunction(id) {
    let x = document.getElementById(id);
    console.log(x);
    if (x.style.display === 'none') {
        x.style.display = 'block';
    } else if (x.style.display === 'block') {
        x.style.display = 'none';
    }
}

$(document).ready(function() {
    $(document).on('click', '#more_but', function (e) {
        e.preventDefault();

        let product_id = $(this).attr('dataId');
        console.log(product_id);
        $.ajax({
            method: 'POST',
            url: 'http://localhost/semestralka2?c=product&a=showProductDetail',
            data: {
                id: product_id
            },
            success: function (data) {
                console.log(data);
                    $('#productDetailMsg').html(data);
                    $('#productDetail').show();

            }
        })

    })
})

$('input:radio').change(function() {

    if (document.getElementById('radioButtonOne').checked) {
        $('.meth').html("Poštovné: 2€");
    } else if (document.getElementById('radioButtonTwo').checked) {
        $('.meth').html("Poštovné: 0€");
    }

})

/**
function checkPaymentDetail() {
    if (document.getElementById('radioButtonTwo').checked) {
        let mon = document.getElementById('months');
        let year = document.getElementById('years');
        let card = document.getElementById('cards');
        let rB = document.getElementById('radioButtonTwo').checked;
        console.log(rB);
        let error = false;

        if (navhood6 === "" || mon.options[mon.selectedIndex].value === "false" || year.options[year.selectedIndex].value === "false" || card.options[card.selectedIndex].value === "false") {
            console.log(mon.options[mon.selectedIndex].value);
            error = true;
        }

        if (error) {
            alert("nie nie nie");
        }
    } else if (document.getElementById('radioButtonOne').checked) {
        console.log("dsd");
    }
}


$(document).ready(function() {
    $('#orderForm').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'http://localhost/semestralka2?c=order&a=addNewOrder',
            data: $('#orderForm').serialize(),
            success: function () {
                $('#modelMsg').html("Objednávka prebehla úspešne.");
                $('#productResponse').show();
                console.log(data);
            }
        })
    })
})**/