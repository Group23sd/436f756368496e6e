function showCities() {
    var idciudad = document.getElementById('userCountry').value;
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("userCity").innerHTML = xmlhttp.responseText;
        }
    }
    var url = "cityOptions.php?id=" + idciudad;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function showCities2() {
    var idciudad = document.getElementById('userCountry').value;
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("userCity").innerHTML = xmlhttp.responseText;
        }
    }
    var url = "cityOptionsUpdate.php?id=" + idciudad;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
