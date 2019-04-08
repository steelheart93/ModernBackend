/**
 * Script utilizado en mi vídeo de YouTube, Introducción al Backend Moderno.
 *
 * @author Stiven Muñoz Murillo
 * @version 06/04/2019
 */
$(function () {
    $("#consultarJQuery").click(function () {
        // JQuery utiliza XMLHttpRequest un estandar antiguo para la comunicación con el Backend.
        var promesaJQuery = $.get("php/ControlMySQL.php", { "ranking": 1 });

        promesaJQuery.done(function (respuesta) {
            var json = JSON.parse(respuesta);
            console.log(json);

            var html = `&#8594; ${json["TOP_ID"]}) ${json["EDITOR_NAME"]}`;
            $("#primer").html(html);
        });

        promesaJQuery.fail(function (respuesta) {
            alert("¡Error en promesaJQuery!");
            console.log(respuesta);
        });
    });

    // API REST
    rest();
});

// Formato de Consultas con JavaScript Nativo
function consultarFetch() {
    // Fetch proporciona una mejor alternativa que puede ser empleada por Service Workers.
    var ajustesJSON = {
        method: 'POST',
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ "ranking": "2" })
    };

    var promesaFetch1 = fetch('php/ControlOraclePLSQL.php', ajustesJSON);

    promesaFetch1.catch(function (error) {
        alert("¡Error en promesaFetch1!");
        console.error(error);
    });

    var promesaFetch2 = promesaFetch1.then(function (respuesta) {
        console.log(respuesta);
        console.log(respuesta.statusText);

        return respuesta.text();
    })

    promesaFetch2.then(function (cadenaJSON) {
        var json = JSON.parse(cadenaJSON);
        console.log(json);

        var html = `&#8594; ${json["ID"]}) ${json["NAME"]}`;
        document.getElementById("segundo").innerHTML = html;
    });
}

/**
 * Cliente del servicio de Bing Images consumido por el Backend de la Aplicación.
 */
function rest() {
    // idx = 0, Imagen del Día de Hoy
    var promesa = $.get("php/API.php", { idx: 0 });

    promesa.done(function (callback) {
        var json = JSON.parse(callback);
        var urlbase = json.images[0].urlbase;

        var size = (window.innerWidth <= 800) ? "_800x600.jpg" : "_1366x768.jpg";

        var url = "https://www.bing.com" + urlbase + size;
        $("body").css("background-image", `url(${url})`);
    });
}