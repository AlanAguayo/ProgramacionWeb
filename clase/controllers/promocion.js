var ventana;
function alerta(titulo, contenido) {
    $.alert({
        title: titulo,
        content: contenido,
        columnClass: "medium",
        type: "red",
    });
}

function promocion(cual, para1, para2, para3) {
    switch (cual) {
        case 'insert':
            if (Nombre.value == '')
                alerta('Atencion', 'Es necesario ingresar nombre');
            else
                if (Porcentaje.value == "")
                    alerta('Atencion', 'Es necesario ingresar porcentaje');
                else {
                    $.ajax({
                        data: $("#promocion").serialize(),
                        type: "POST",
                        url: "../recursos/classPromocion.php?accion=insert",
                        beforeSend: function () { principal.innerHTML = "Espere un momento" },
                        success: function (Resu) { principal.innerHTML = Resu },
                    });
                    ventana.close();
                }
            break;
        case 'delete':
            $.confirm({
                title: 'Atencion',
                content: 'Seguro que quieres eliminar la promocion?',
                columnClass: "medium",
                type: "red",
                buttons: {
                    Confirmar: function () {
                        $.ajax({
                            data: { "Id": para1 },
                            type: "POST",
                            url: "../recursos/classPromocion.php?accion=delete",
                            beforeSend: function () { principal.innerHTML = "Espera un momento" },
                            success: function (Resu) { principal.innerHTML = Resu },
                        });
                    },
                    Cancelar: function () {
                    },
                }
            });
            break;
        case 'newForm':
            $.dialog({
                title: '<span class="text"-info>Agregar Promocion</span>',
                content: 'url:../recursos/classPromocion.php?accion=newForm',
                columnClass: "m",
                type: "green",
                success: function (Resu) { principal.innerHTML = Resu },
            });
            break;

        case 'editForm':
            $.ajax({
                data: { "Id": para1 },
                type: "POST",
                url: "../recursos/classPromocion.php?accion=editForm",
                success: function (resul) {
                    ventana = $.dialog({
                        title: '<span class="text"-info>Editar Promocion</span>',
                        content: resul,
                        columnClass: "m",
                        type: "green",
                    })
                }
            });

            break;
        case 'prueba':
            break;
        case 'update':
            if (Nombre.value == '')
                alerta('Atencion', 'Es necesario ingresar nombre');
            else
                if (Porcentaje.value == "")
                    alerta('Atencion', 'Es necesario ingresar porcentaje');
                else {
                    $.ajax({
                        data: $("#promocion").serialize(),
                        type: "POST",
                        url: "../recursos/classPromocion.php?accion=update",
                        beforeSend: function () { principal.innerHTML = "Espere un momento" },
                        success: function (Resu) { principal.innerHTML = Resu },
                    });
                    ventana.close();
                }

            break;
        default: $.alert({
            title: "Atencion",
            content: " La opcion <b>" + cual + "</b> No esta programada en promocion.js",
            columnClass: "medium",
            type: "red",
        });
    }
}