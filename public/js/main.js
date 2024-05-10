var navbar = document.getElementsByClassName('nav-link');



navbar.addEventListener('click',function(){

    navbar.classList.add('active');

});



function handleCardClick(card) {

    var checkbox = card.querySelector('input[type="checkbox"]');



    if (card.classList.contains('card-clicked')) {

        card.classList.remove('card-clicked');

        checkbox.checked = false;

    } else {

        var allCards = document.querySelectorAll('.card');

        allCards.forEach(function (otherCard) {

            if (otherCard !== card) {

                otherCard.classList.remove('card-clicked');

            }

            var otherCheckbox = otherCard.querySelector('input[type="checkbox"]');

            otherCheckbox.checked = false;

        });



        card.classList.add('card-clicked');

        checkbox.checked = true;

        console.log("sudah di tambah card-clicked");

    }

}

function validateform() {
    let user_id = document.getElementById("inputfield1").value;
    let zone_id = document.getElementById("inputfield2").value;
    let selectproduct = document.getElementById("selectproduct");
    if (user_id == "" || user_id == "" && zone_id == "") {
        alert('Masukan data game yang valid!');
        return false;
    } else if (user_id.length >= 11 || zone_id.length >= 11){
        alert('user_ id maupun server_id tidak lebih dari 11 karakter!');
        return false;
    }else if (!selectproduct.classList.contains("card-clicked") ) {
        alert('Silahkan pilih nominal topup!');
        return false;
    }
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
    xhttp.open("GET","api/cek-username/"+game_id+"?user_id="+user_id+"&zone_id="+zone_id);
    xhttp.send();
    xhttp.onload = function() {
        loading();
        let result = xhttp.responseText;
        let data = JSON.parse(result);
        console.log(data);
        if (checkedId.classList.contains('text-primary')) {
            checkedId.classList.remove('text-primary');
        }else if(checkedId.classList.contains('text-danger')) {
            checkedId.classList.remove('text-danger');
        }
        if (data.status >= 200 && data.status < 300) {
            checkedId.classList.add('text-primary');
            checkedId.textContent = data.nickname;
        } else {
            checkedId.classList.add('text-danger');
            checkedId.textContent = "tidak ditemukan!";
        }
    }
}

