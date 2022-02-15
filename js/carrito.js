$(document).on("click", '.removeFromCart', function ($this) {
    removeFromCart($this)
});


$(function () {
    $("#openCarrito").click(function () {
        $('#carrito').show("slow");
    });
    $("#closeCarrito").click(function () {
        $('#carrito').hide("slow");
    });
    // $(".addToCart").click(addToCarrito(1))
    $(".addToCart").click(function ($this) {
        addToCarrito($this)
    });
    // $(".removeFromCart").click(function ($this) {
    //     removeFromCart($this)
    // });
    // $(document).on("click", '.removeFromCart', function ($this) {
    //     removeFromCart($this)
    // });
    let loged = getCookie('loged')
    if (!loged) {
        pintarCarritoCookies();

    }

})


function abrirCarrito() {
    $('#carrito').show("slow");
}

function cerrarCarrito() {
    $('#carrito').hide("slow");

}

function a() {
    alert("a")
}

function addToCarrito($id_libro) {
    let id_libro = $id_libro.target.parentNode.querySelector('input').value;
    $.ajax({
        url: 'index.php',
        type: 'get',
        dataType: 'JSON',
        data: {c: "usuario", a: "addToCart", id: id_libro},
        success: function (response) {
            if (getCookie('loged') != null) {
                console.log("logeado")
                if ($("." + response.libroData.libro_id).find('b').length == 0) {
                    let caja = $('.productos')
                    caja.append("<div class='producto " + response.libroData.libro_id + "'>" +
                        "<img class=' carrito-img' src='img/libro/" + response.libroData.image + "'>" +
                        "<div>" +
                        "<input type='hidden' value='"+response.libroData.libro_id+"' name='"+response.libroData.libro_id+"'> " +
                        "<p>" + response.libroData.nombre + "</p>" +
                        "<p class='cantidad'>Cantidad<b>" + 1 + "</b></p>" +
                        "<button class='removeFromCart'>X</button>" +
                        "</div>" +
                        "</div>")
                } else {
                    $("." + response.libroData.libro_id).find('b').html("<b>" + response.libroData.cantidad + "</b>");
                }

            } else {
                console.log("no logeado")
                console.log(response.libroData.libro_id)
                let a = getCookie('carrito')
                if (a != null) {
                    let b = a.split(',')
                    // b.push(response.libroData.libro_id);
                    let c = b.join(',')
                    // setCookie('carrito', c, 1);
                    a = getCookie('carrito')
                    let libros = a.split(',')
                    const numeroLibros = {};
                    libros.forEach(function (x) {
                        numeroLibros[x] = (numeroLibros[x] || 0) + 1;
                    });
                    const found = libros.find(element => element == response.libroData.libro_id);
                    b = a.split(',')
                    b.push(response.libroData.libro_id);
                    c = b.join(',')
                    setCookie('carrito', c, 1);
                    if (found != undefined) {

                        let cantidad = numeroLibros[response.libroData.libro_id] + 1;
                        let libroASumar = $("." + response.libroData.libro_id).find('b').replaceWith("<b>" + cantidad + "</b>");
                    } else {
                        let caja = $('.productos')
                        caja.append("<div class='producto " + response.libroData.libro_id + "'>" +
                            "<img class=' carrito-img' src='img/libro/" + response.libroData.image + "'>" +
                            "<div>" +
                            "<input type='hidden' value='"+response.libroData.libro_id+"' name='"+response.libroData.libro_id+"'> " +
                            "<p>" + response.libroData.nombre + "</p>" +
                            "<p class='cantidad'>Cantidad<b>1</b></p>" +
                            "<button class='removeFromCart'>X</button>" +
                            "</div>" +
                            "</div>")
                    }


                } else {
                    setCookie('carrito', response.libroData.libro_id, 1);
                    let caja = $('.productos')
                    caja.append("<div class='producto " + response.libroData.libro_id + "'>" +
                        "<img class=' carrito-img' src='img/libro/" + response.libroData.image + "'>" +
                        "<div>" +
                        "<input type='hidden' value='"+response.libroData.libro_id+"' name='"+response.libroData.libro_id+"'> " +
                        "<p>" + response.libroData.nombre + "</p>" +
                        "<p class='cantidad'>Cantidad<b>" + numeroLibros[x] + "</b></p>" +
                        "<button class='removeFromCart'>X</button>" +
                        "</div>" +
                        "</div>")
                }
            }


            abrirCarrito()
        }
    })

}

function pintarCarritoCookies() {
    let a = getCookie('carrito')
    if (a) {
        let libros = a.split(',')
        const numeroLibros = {};
        libros.forEach(function (x) {
            numeroLibros[x] = (numeroLibros[x] || 0) + 1;
        });
        Object.keys(numeroLibros).forEach((x) => {
            $.ajax({
                url: 'index.php',
                type: 'get',
                dataType: 'JSON',
                data: {c: "usuario", a: "addToCart", id: x},
                success: function (response) {


                    let caja = $('.productos');

                    caja.append("<div class='producto " + response.libroData.libro_id + "'>" +
                        "<img class=' carrito-img' src='img/libro/" + response.libroData.image + "'>" +
                        "<div>" +
                        "<input type='hidden' value='"+response.libroData.libro_id+"' name='" + response.libroData.libro_id + "'> " +
                        "<p>" + response.libroData.nombre + "</p>" +
                        "<p>Cantidad<b>" + numeroLibros[x] + "</b></p>" +
                        "</div>" +
                        "<button class='removeFromCart'>X</button>" +
                        "</div>")
                    abrirCarrito()
                }
            })
        })

    }
}


function removeFromCart(boton) {
    let id_libro = boton.target.parentNode.querySelector('input').value;
    let loged = getCookie('loged')
    if (loged) {
        $.ajax({
            url: 'index.php',
            type: 'get',
            dataType: 'JSON',
            data: {c: "usuario", a: "removeFromCart", id: id_libro},
            success: function (response) {
                if (response['respuesta'] == 'ok'){
                    $("."+id_libro).remove();
                }else{
                    $("." + response.libroData.libro_id).find('b').html("<b>" + response.libroData.cantidad + "</b>");
                }
            }
        })
    }else{
        let a = getCookie('carrito');
        let b = a.split(",");
        console.log(b)
        console.log(id_libro)
        let indice =  b.indexOf(id_libro);
        b.splice(indice, 1)
        console.log(b)
        setCookie('carrito', b.join(','), 1);
        // console.log(getCookie('carrito'))
        $('.productos').html("");
        pintarCarritoCookies();

    }
}


function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function eraseCookie(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}