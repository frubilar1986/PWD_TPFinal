"use strict";
let notificacion = document.getElementById("toastNotif");
let botonCerrarNotif = document.getElementById("toastNotifClose");

botonCerrarNotif.addEventListener("click", function(e){
    e.target.notificacion.classList.add("hide");
});