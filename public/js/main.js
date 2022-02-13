"use strict"

var location = document.getElementById("location")

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        location.innerHTML = "Браузер не поддерживает геолокацию.";
    }
}

function showPosition(position) {
    location.innerHTML = "Широта: " + position.coords.latitude +
        "<br>Долгота: " + position.coords.longitude;
}
