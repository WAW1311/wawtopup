let currentIndex = 0;
function showSlide(index) {
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.slide');
    if (index >= slides.length) {
        currentIndex = 0;
    } else if (index < 0) {
        currentIndex = slides.length - 1;
    } else {
        currentIndex = index;
    }
    slider.style.transform = `translateX(${-currentIndex * 100}%)`;
}
function prevSlide() {
showSlide(currentIndex - 1);
}
function nextSlide() {
showSlide(currentIndex + 1);
}
setInterval(nextSlide, 5000);

async function handleCardClick(card) {
    let price = document.querySelectorAll('#price');
    let code = document.querySelectorAll('#code_payment');
    var checkbox = card.querySelector('input[type="checkbox"]');
    if (card.classList.contains('card-clicked')) {
        card.classList.remove('card-clicked');
        checkbox.checked = false;
        for (let i = 0; i < price.length; i++) {
            let prices = price[i];
            prices.innerText = 0;
        }
    } else {
        var allCards = document.querySelectorAll('.card');
        allCards.forEach(function (otherCard) {
            if (otherCard !== card) {
                otherCard.classList.remove('card-clicked');
            }
            var otherCheckbox = otherCard.querySelector('input[type="checkbox"]');
            otherCheckbox.checked = false;
            for (let i = 0; i < price.length; i++) {
                let prices = price[i];
                prices.innerText = 0;
            }
        });
        card.classList.add('card-clicked');
        checkbox.checked = true;
        for (let i = 0; i < price.length; i++) {
            let prices = price[i];
            let codes = code[i];
            const result = await SumAmount(codes.innerText);
            prices.innerText = result;
        }
    }
}

function validateform() {
    const phoneRegex = /^08\d{8,}$/;
    let user_id = document.getElementById("inputfield1").value;
    let zone_id = document.getElementById("inputfield2").value;
    let nohp = document.getElementById("nohp").value;
    let selectproduct = document.querySelectorAll('.selectproduct');
    let selectpayment = document.querySelectorAll('.selectpayment');
    let ispaymentselect = false
    let isproductselected = false;
    selectpayment.forEach(function(checkbox) {
        if(checkbox.checked) {
            ispaymentselect = true;
        }
    })
    selectproduct.forEach(function(checkbox) {
        if(checkbox.checked)
            isproductselected = true;
    })
    if (user_id == "" || user_id == "" && zone_id == "") {
        alert('Masukan data game yang valid!');
        return false;
    } else if (user_id.length >= 254 || zone_id.length >= 254){
        alert('user_ id maupun server_id tidak lebih dari 255 karakter!');
        return false;
    }else if (!isproductselected) {
        alert('Silahkan pilih nominal topup!');
        return false;
    }else if (!ispaymentselect) {
        alert('Silahkan pilih metode pembayaran terlebih dahulu!');
        return false;
    }else if (!nohp) {
        alert('Masukan Nomor Whatsapp terlebih dahulu!');
        return false;
    }else if(!phoneRegex.test(nohp)) {
        alert('nomor whatsapp tidak valid!\nsilahkan masukan ulang contoh : 08123xxxxx');
        return false;
    }
    return true;
}

function loading() {
    let loading = document.getElementById("loading");
    let checkedId = document.getElementById("checkedId");
    if (loading.classList.contains('hidden')) {
        loading.classList.remove('hidden');
        checkedId.classList.add('hidden');
        loading.classList.add('loading');
    }else {
        loading.classList.remove('loading');
        checkedId.classList.remove('hidden');
        loading.classList.add('hidden');
    }
}

function CheckUsername(game_id) {
    let user_id = document.getElementById("inputfield1").value;
    let zone_id = document.getElementById("inputfield2").value;
    let checkedId = document.getElementById("checkedId");
    xhttp = new XMLHttpRequest();
    if (user_id == "") {
        alert('user id tidak boleh kosong!');
        return false;
    }
    loading();
    xhttp.open("GET",`/api/v2/cek-username?code=${game_id}&user_id=${user_id}&zone_id=${zone_id}`);
    xhttp.send();
    xhttp.onload = function() {
        loading();
        let result = xhttp.responseText;
        let data = JSON.parse(result);
        if (checkedId.classList.contains('text-primary')) {
            checkedId.classList.remove('text-primary');
        }else if(checkedId.classList.contains('text-danger')) {
            checkedId.classList.remove('text-danger');
        }
        if (data.result == true) {
            checkedId.classList.add('text-primary');
            checkedId.textContent = data.data;
        } else {
            checkedId.classList.add('text-danger');
            checkedId.textContent = "tidak ditemukan!";
        }
    }
}
async function SumAmount(code) {
        var checkboxes = document.querySelectorAll('input[name="selectedProduct"]');
    
        let price = 0;
    
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                var parent = checkbox.closest('.card');
    
                var priceElement = parent.querySelector('#product_price').innerText;
                if (priceElement) {
                    price = Math.round(priceElement);
                }
            }
        });
        if (price > 0) {
            const response = await fetch(`/api/fee-calculate?code=${code}&amount=${price}`);
            const result = await response.json();
            return price+result.customer;
        } else {
            return 0;
        }
}

function getpayment(element) {
    let parrentclass = document.querySelector(`.${element}`);
    let navi = parrentclass.querySelector('.navi');
    let mpay = parrentclass.querySelector('.mpay');
    let cpay = parrentclass.querySelector('.cpay');

    if(mpay.classList.contains('d-none')) {
        navi.innerHTML = '&#9650;';
        mpay.classList.remove('d-none');
        mpay.classList.add('d-flex');
        cpay.classList.remove('d-flex');
        cpay.classList.add('d-none');
    } else {
        navi.innerHTML = '&#9660;';
        mpay.classList.remove('d-flex');
        mpay.classList.add('d-none');
        cpay.classList.remove('d-none');
        cpay.classList.add('d-flex');
    }
}

function selectpayment(element) {
    let checkbox = element.querySelector('input[type=checkbox]');
    if(element.classList.contains('card-clicked')) {
        element.classList.remove('card-clicked');
        element.classList.add('bg-white');
        checkbox.checked = false;
    }else {
        var allCards = document.querySelectorAll('.childmpay');
        allCards.forEach(function (otherCard) {
            if (otherCard !== element) {
                otherCard.classList.remove('card-clicked');
                otherCard.classList.add('bg-white');
            }
            var otherCheckbox = otherCard.querySelector('input[type="checkbox"]');
            otherCheckbox.checked = false;
        });
        element.classList.add('card-clicked');
        element.classList.remove('bg-white');
        checkbox.checked = true;
    }

}
