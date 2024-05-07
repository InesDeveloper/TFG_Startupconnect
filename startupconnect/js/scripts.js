// funcion de cambiar idioma
function changeLanguage(lang) {
    console.log(lang);
    var newLanguage = lang == 'es' ? 'en' : "es";

    var xhr = new XMLHttpRequest();
    xhr.open('GET', '?lang=' + newLanguage, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Recargar la página para reflejar el cambio de idioma
            location.reload();
        }
    };
    xhr.send();
}