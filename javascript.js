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

function getOrderForm() {
    location.href = '?c=order&a=orderForm';
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


let paymentPartOne = null;
let paymentPartTwo = null;
let returnValueCategoryId = "null";
let returnValueProductName = "null";


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

}

function displayInputInColor(string, element) {
    let elementId = document.getElementById(element.id);
    let elementParent = elementId.parentElement;
    let divErrorText = elementParent.querySelector(".valid")
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
}

function validateName() {
    console.log("sdsd");
    let input = document.getElementById('meno');
    let inputValue = input.value;
    let char = /^[a-zA-Z\u00C0-\u017F\ ]+$/;

    if (!inputValue || inputValue.length === 0) {
        return displayInputInColor("Meno nesmie byť prázdne.", input);
    } else if (!char.test(inputValue)){
        return displayInputInColor("Meno smie obsahovať len platné znaky v slovenskej abecede.", input);
    }

    return displayInputInColor(null, input);
}

function validateSurname() {
    let input = document.getElementById('priezvisko');
    let inputValue = input.value;
    let char = /^[a-zA-Z\u00C0-\u017F\ ]+$/;

    if (!inputValue || inputValue.length === 0) {
        return displayInputInColor("Priezvisko nesmie byť prázdne.", input);
    } else if (!char.test(inputValue)){
        return displayInputInColor("Priezvisko smie obsahovať len platné znaky v slovenskej abecede.", input);
    }

    return displayInputInColor(null, input);
}

function validateStreet() {
    let input = document.getElementById('street');
    let inputValue = input.value;
    let char = /^[a-zA-Z\u00C0-\u017F\ ]+$/;

    if (!inputValue || inputValue.length === 0) {
        return displayInputInColor("Ulica nesmie byť prázdna.", input);
    } else if (!char.test(inputValue)){
        return displayInputInColor("Ulica smie obsahovať len platné znaky v slovenskej abecede.", input);
    }

    return displayInputInColor(null, input);
}

function validateCity() {
    let input = document.getElementById('city');
    let inputValue = input.value;
    let char = /^[a-zA-Z\u00C0-\u017F\ ]+$/;

    if (!inputValue || inputValue.length === 0) {
        return displayInputInColor("Obec nesmie byť prázdne.", input);
    } else if (!char.test(inputValue)){
        return displayInputInColor("Obec smie obsahovať len platné znaky v slovenskej abecede.", input);
    }

    return displayInputInColor(null, input);
}

function validateCountry() {
    let input = document.getElementById('country');
    let inputValue = input.value;
    let char = /^[a-zA-Z\u00C0-\u017F\ ]+$/;

    if (!inputValue || inputValue.length === 0) {
        return displayInputInColor("Štát nesmie byť prázdny.", input);
    } else if (!char.test(inputValue)){
        return displayInputInColor("Zadali ste neplatný znak.", input);
    }

    return displayInputInColor(null, input);
}

function validateEmail() {
    let input = document.getElementById("mail");
    let mailValue = input.value;
    let disabledChar = /[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/;

    if (!mailValue || mailValue.length == 0) {
        return displayInputInColor("Pole nesmie byť prázdne.", input);
    } else if (!disabledChar.test(mailValue)) {
        return displayInputInColor("E-mail musí mať tvar: inka@priklad.sk", input);
    }

    return displayInputInColor(null, input);
}

function validateHouseNumber() {
    let input = document.getElementById('houseNumber');
    let inputValue = input.value;
    let disabledChar = /[0-9\/]$/;
    console.log(inputValue);
    if (!inputValue || inputValue.length === 0) {
        return displayInputInColor("Číslo domu nesmie byť prázdne.", input);
    } else if (!disabledChar.test(inputValue)){
        return displayInputInColor("Číslo domu nesmie obsahovať znaky.", input);
    }

    return displayInputInColor(null, input);
}

function validatePsc() {
    let input = document.getElementById('psc');
    let inputValue = input.value;
    let disabledChar = /^[0-9\b]+$/;
    console.log(inputValue);
    if (!inputValue || inputValue.length === 0) {
        return displayInputInColor("PSČ nesmie byť prázdne.", input);
    } else if (!disabledChar.test(inputValue)){
        return displayInputInColor("PSČ nesmie obsahovať znaky.", input);
    } if (inputValue.length < 5 || inputValue.length > 5) {
        return displayInputInColor("PSČ musí mať presne 5 znakov.", input);
    }

    return displayInputInColor(null, input);
}

function validateCardNumber() {
    let input = document.getElementById('cardNumber');
    let inputValue = input.value;
    let disabledChar = /[0-9]$/;
    console.log(inputValue);
    if (!inputValue || inputValue.length === 0) {
        return displayInputInColor("Číslo karty nesmie byť prázdne.", input);
    } else if (!disabledChar.test(inputValue)){
        return displayInputInColor("Číslo karty nesmie obsahovať znaky.", input);
    } if (inputValue.length < 16 || inputValue.length > 16) {
        return displayInputInColor("Číslo karty musí mať presne 16 znakov.", input);
    }

    return displayInputInColor(null, input);
}

function validateMobileNumber() {
    let input = document.getElementById('mobileNumber');
    let inputValue = input.value;
    let disabledChar = /[0-9\+]$/;
    console.log(inputValue);
    if (!inputValue || inputValue.length === 0) {
        return displayInputInColor("Telefónne číslo nesmie byť prázdne.", input);
    } else if (!disabledChar.test(inputValue)){
        return displayInputInColor("Telefónne číslo nesmie obsahovať znaky.", input);
    } else if ((inputValue.substr(0,4) !== '+421')) {
        return displayInputInColor("Telefónne číslo musí začínať +421.", input);
    } else if (inputValue.length < 13 || inputValue.length > 13) {
        return displayInputInColor("Telefónne číslo musí mať presne 13 znakov.", input);
    }

    return displayInputInColor(null, input);
}

function validatePassword() {
    let input = document.getElementById("heslo");
    let passwordValue = input.value;
    let disabledChar = /[a-z]/;
    let disabledCharCapitalLetter = /[A-Z]/;
    let disabledCharNumber = /[0-9]/;

    if (!passwordValue) {
        return displayInputInColor("Pole nesmie byť prázdne.", input);
    } else if (!disabledChar.test(passwordValue)) {
        return displayInputInColor("Heslo nesmie obsahovať špeciálne znaky.", input);
    } else if (passwordValue.length <= 5) {
        return displayInputInColor("Heslo musí mať minimálne 5 znakov.", input);
    } else if (!disabledCharCapitalLetter.test(passwordValue)) {
        return displayInputInColor("Heslo musí obsahovať aspoň 1 veľké písmeno.", input);
    } else if (!disabledCharNumber.test(passwordValue)) {
        return displayInputInColor("Heslo musí obsahovať aspoň 1 číslicu.", input);
    }

    return displayInputInColor(null, input);
}

function validatePasswordControl() {
    let password = document.getElementById("heslo");
    let passwordControl = document.getElementById("hesloKontrola");
    if (passwordControl.value != password.value) {
        return displayInputInColor("Heslá sa nezhodujú.", passwordControl);
    }

    return displayInputInColor(null, passwordControl);
}

function validatePrice(id) {
    let input = document.getElementById('productPriceInput'+id);
    let inputValue = input.value;
    let disabledChar = /^[0-9]\d*(,\d+)?$/;
    console.log(inputValue);
    if (!inputValue || inputValue.length === 0) {
        return displayInputInColor("Cena nesmie byť prázdna.", input);
    } else if (!disabledChar.test(inputValue)){
        return displayInputInColor("Cena smie obsahovať len číslice.", input);
    } else if (inputValue <= 0){
        return displayInputInColor("Cena musí byť kladné číslo.", input);
    }

    return displayInputInColor(null, input);
}

function validateSize(id) {
    let input = document.getElementById('productSizeInput'+id);
    let inputValue = input.value;
    let disabledChar = /[0-9\a-zA-Z]$/;
    console.log(inputValue);
    if (!inputValue || inputValue.length === 0) {
        return displayInputInColor("Veľkosť nesmie byť prázdna.", input);
    } else if (!disabledChar.test(inputValue)){
        return displayInputInColor("Veľkosť smie obsahovať len znaky.", input);
    }

    return displayInputInColor(null, input);
}

function validateGender() {
    let input = document.getElementById('gender');
    let inputValue = input.value;
    let disabledChar = /[a-zA-Z]$/;
    console.log(inputValue);
    if (!inputValue || inputValue.length === 0) {
        return displayInputInColor("Pre koho nesmie byť prázdne.", input);
    } else if (!disabledChar.test(inputValue)){
        return displayInputInColor("Pre koho nesmie obsahovať číslice.", input);
    }

    return displayInputInColor(null, input);
}

function validateCategoryName() {
    let input = document.getElementById('categoryName');
    let inputValue = input.value;
    let char = /^[a-zA-Z\u00C0-\u017F\ ]+$/;

    if (!inputValue || inputValue.length === 0) {
        return displayInputInColor("Názov nesmie byť prázdny.", input);
    } else if (!char.test(inputValue)){
        return displayInputInColor("Názov smie obsahovať len platné znaky v slovenskej abecede.", input);
    }

    return displayInputInColor(null, input);
}

function validateCategory() {
    let cat = document.getElementById('categoryProductForm');

    let error = false;

    if (cat.options[cat.selectedIndex].value === "false") {
        console.log(cat.options[cat.selectedIndex].value);
        error = true;
    }

    if (!error) {
        returnValueCategoryId = null;
    }
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
        //let radio_first =  $("input[type=radio][name=paymentMethod]:checked").attr('id');

        let rb1 = document.getElementById('radioButtonOne').checked;
        let rb2 = document.getElementById('radioButtonTwo').checked;

        let c = document.getElementById('cards');
        let cardsValue = c.options[c.selectedIndex].value;

        let cardNumber = $('#cardNumber').val();

        let m = document.getElementById('months');
        let monthValue = m.options[m.selectedIndex].value;

        let y = document.getElementById('years');
        let yearValue = y.options[y.selectedIndex].value;
        console.log(rb1 + " " + rb2);
        $.ajax({
            method: 'POST',
            url: 'http://localhost/semestralka2?c=order&a=addNewOrder',
            data: {
                nameA: name,
                surnameA: surname,
                streetA: street,
                houseNumberA: house_number,
                pscA: psc,
                countryA: country,
                cityA: city,
                mobileNumberA: mobile_number,
                rbOne: rb1,
                rbTwo: rb2,
                cardNo: cardNumber,
                sOne: cardsValue,
                sTwo: monthValue,
                sTree: yearValue
            },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                //console.log("rB " + radio_first);
                $('#modelMsg').html(data);
                $('#productResponse').show();
            }
        })
    })
});

let numberOfRows = $('#tableShoppingCart tbody tr').length;
$(document).ready(function() {
    $(document).on('click', '.delBut', function () {
        let del_id = $(this).attr('dataId');

        console.log("riadky " + numberOfRows);
        $.ajax({
            method: 'POST',
            url: 'http://localhost/semestralka2?c=cart&a=removeOrderItem',
            data: {
                deleteItem: del_id,
            },
            success: function () {
                $('.deleteItem' + del_id).fadeOut('slow');
                numberOfRows--;
                if (numberOfRows < 1) {
                    $('#order_but').fadeOut('slow');
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
            url: 'http://localhost/semestralka2?c=cart&a=addToCart',
            data: {
                id: product_id
            },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('#modelMsg').html(data);
                $('#productResponse').show();
            }
        })
    })
})

$(document).ready(function() {
    $(document).on('click', '#cancel_but', function(){
        $('.modal').hide();
        $('#productDetail').hide();
    })
})

$(document).ready(function() {
    $(document).on('click', '.saveBut', function(e){
            e.preventDefault();
            let edit_id = $(this).attr('dataId');
            let quantity_price = $(this).attr('dataPrice'); //8
            let quantity_input = ($('#quantityInput'+edit_id).val());

            $.ajax({
                type: 'POST',
                url: 'http://localhost/semestralka2?c=cart&a=editOrderItem',
                data: {text: quantity_input,
                    oldItem: edit_id,
                    },
                success: function () {
                    $('#quantityInput'+edit_id).hide();
                    $('#quantity'+edit_id).show();

                    $('#save_but'+edit_id).hide();
                    $('#edit_but'+edit_id).show();

                    let aString = quantity_input.toString();

                    if (isNaN(quantity_input) || parseInt(quantity_input) <= 0) {
                       $('#modelMsg').html("Zadal si neplatnú hodnotu.");
                        $('#productResponse').show();
                    } else {
                        let totalPrice = quantity_price * parseInt(quantity_input);
                        let totalPriceString = totalPrice.toString();

                        $('#quantity' + edit_id).html(aString);
                        $('#price' + edit_id).html(totalPriceString + '€');
                    }
                }
            })
        })
})

$(document).ready(function() {
    $(document).on('click', '.filter_but', function () {
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
                console.log("ss " + data);
                $('.filter_data').html(data);
            }
        })
    })
})


function getFilter(filter) {
    return $('.' + filter + ':checked').val();
}

$(document).ready(function() {
    $(document).on('click', '.clear_but', function () {
       let x = document.getElementsByClassName('common_selector');

       let check = 0;
       for (let i = 0; i < x.length; i++) {
           if (x[i].checked === true) {
               x[i].checked = false;
               check++;
           }
       }

       if (check == 0) {
           $('#modelMsg').html("Neboli zvolené žiadne filtre.");
           $('#productResponse').show();
       }
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
    $(document).on('click', '.more_but', function (e) {
        e.preventDefault();
        let product_id = $(this).attr('dataId');
        $.ajax({
            method: 'POST',
            url: 'http://localhost/semestralka2?c=product&a=showProductDetail',
            data: {
                id: product_id
            },
            success: function (data) {
                //console.log(data);
                $('#productDetailMsg').html(data);
                $('#productDetail').show();
            }
        })

    })
})

$('input[type=radio][name=paymentMethod]').change(function() {

    if (document.getElementById('radioButtonOne').checked) {
        $('.meth').html("Poštovné: 2€");
        let y = parseInt($('#radioButtonOne').val()) + 2;
        $('#priceTotal').html("Spolu:"+ y + "€");
    } else if (document.getElementById('radioButtonTwo').checked) {
        $('.meth').html("Poštovné: 0€");
        let y = parseInt($('#radioButtonOne').val());
        $('#priceTotal').html("Spolu: "+ y + "€")
    }

})

$(document).ready(function() {
    $(document).on('click', '.delOrderBut', function (e) {
        e.preventDefault();
        let order_item_id = $(this).attr('dataId');
        //console.log("ss" + order_item_id);

        $.ajax({
            method: 'POST',
            url: 'http://localhost/semestralka2?c=order&a=stornoOrder',
            data: {
                id: order_item_id
            },
            success: function (data) {
                data = data.replace(/[0-9]/g, "");

                //$('#delete_order_but'+order_item_id).style.disabled = true;
                document.getElementById('stornoBut'+order_item_id).disabled = true;
                $('#stateValue'+order_item_id).html(data);
            }
        })
    })
})

$(document).ready(function () {
    $('#formAddCategory').submit(function (e) {
        e.preventDefault();

        let name = $('#categoryName').val();

        $.ajax({
            method: 'POST',
            url: 'http://localhost/semestralka2?c=product&a=addProductCategory',
            data: {
                nameCategory: name,
            },
            success: function (data) {
                $('#categoryMsg').html(data);
                $('#categoryResponse').show();
                document.getElementById('meno').value = '';
            }
        })
    })
});

$(document).ready(function() {
    $(document).on('click', '.delCategoryBut', function (e) {
        e.preventDefault();
        let category_id = $(this).attr('dataId');

        $.ajax({
            method: 'POST',
            url: 'http://localhost/semestralka2?c=product&a=removeCategory',
            data: {
                id: category_id
            },
            success: function () {
                let i = $('#categoryTable').find('productCategoryRow'+category_id).index();
                document.getElementById('categoryTable').deleteRow(i);
            }
        })
    })
})

$(document).ready(function() {
    $(document).on('click', '#delete_order_but', function(){
        let product_id = $(this).attr('dataId');

        $.ajax({
            method: 'POST',
            url: 'http://localhost/semestralka2?c=product&a=removeProduct',
            data: {
                id: product_id
            },
            success: function () {
                $('#productDetail').hide();
                $('.cardProductDelete'+product_id).fadeOut('slow');
            }
        })

    })
})

$(document).ready(function() {
    $(document).on('click', '.editOrderBut', function(){
        let edit_id = $(this).attr('dataId');

        $('#nameProduct'+edit_id).hide();
        $('#productNameInput'+edit_id).show();

        $('#sizeProduct'+edit_id).hide();
        $('#productSizeInput'+edit_id).show();

        $('#priceProduct'+edit_id).hide();
        $('#productPriceInput'+edit_id).show();

        $('#edit_order_but'+edit_id).hide();
        $('#save_order_but'+edit_id).show();

        $('#delete_order_but'+edit_id).hide();
    })
})

$(document).ready(function() {
    $(document).on('click', '.saveOrderBut', function (e) {
        e.preventDefault();
        let save_id = $(this).attr('dataId');

        let new_name = $('#productNameInput'+save_id).val();
        let new_size = $('#productSizeInput'+save_id).val();
        let new_price = $('#productPriceInput'+save_id).val();
        console.log(new_name);
        $.ajax({
            type: 'POST',
            url: 'http://localhost/semestralka2?c=product&a=editProduct',
            data: {
                id: save_id,
                newName: new_name,
                newSize: new_size,
                newPrice: new_price
            },
            success: function() {
                $('#productNameInput'+save_id).hide();
                $('#nameProduct'+save_id).show();

                $('#productSizeInput'+save_id).hide();
                $('#sizeProduct'+save_id).show();

                $('#productPriceInput'+save_id).hide();
                $('#priceProduct'+save_id).show();

                $('#save_order_but'+save_id).hide();
                $('#edit_order_but'+save_id).show();

                $('#nameProduct'+save_id).html(new_name);
                $('#sizeProduct'+save_id).html("Veľkosť: " + new_size);
                $('#priceProduct'+save_id).html(new_price+"€");

            }
        })
    })
})

function validateProductName(id) {
    let input = document.getElementById('productNameInput'+id);
    let inputValue = input.value;
    let disabledChar = /^[a-zA-Z\u00C0-\u017F\ ]+$/;
    console.log(inputValue);
    if (!inputValue || inputValue.length === 0) {
        returnValueProductName = "Meno nesmie byť prázdne.";
        return displayInputInColor(returnValueProductName, input);
    } else if (!disabledChar.test(inputValue)){
        returnValueProductName = "Meno smie obsahovať len znaky.";
        return displayInputInColor(returnValueProductName, input);
    }

    returnValueProductName = null;
    return displayInputInColor(returnValueProductName, input);
}

$(document).ready(function() {
    $(document).on('click', '#orders_filter_but', function () {
        let choice = $('.order:checked').val();
        console.log(choice);

        $.ajax({
            type: 'POST',
            url: 'http://localhost/semestralka2?c=order&a=showFilteredOrders',
            data: {
                state: choice
            },
            dataType: 'json',
            success: function (data) {
                $('#userOrders').html(data)
                //$('#modelMsg').html(data);
                //$('#productResponse').show();
            }
        })
    })
})


$(document).ready(function() {
    $(document).on('click', '.sendOrderBut', function () {
        let send_order_id = $(this).attr('dataId');
        //let numberOfRows = document.getElementById('tableOrders').rows.length;

        $.ajax({
            method: 'POST',
            url: 'http://localhost/semestralka2?c=order&a=setOrderState',
            data: {
                sendItem: send_order_id,
            },
            success: function () {
                $('.sendItem' + send_order_id).fadeOut('slow');
            }
        })
    })
})


$(document).ready(function() {
    $(document).on('click', '.confirmStornoOrderBut', function () {
        let confimr_storno_order_id = $(this).attr('dataId');
        let numberOfRows = document.getElementById('tableOrders').rows.length;
        let x = 4;
        $.ajax({
            method: 'POST',
            url: 'http://localhost/semestralka2?c=order&a=setOrderState',
            data: {
                sendItem: confimr_storno_order_id,
                state: 4
            },
            success: function () {
                //$('.deleteItem' + del_id).fadeOut('slow');
                //console.log(send_order_id);
                let i = $('#tableOrders').find('.sendItem'+confimr_storno_order_id).index();

                document.getElementById('tableOrders').deleteRow(i+1);
                if (numberOfRows <= 2) {
                    $('#order_but').fadeOut('slow');
                }
            }
        })
    })
})

