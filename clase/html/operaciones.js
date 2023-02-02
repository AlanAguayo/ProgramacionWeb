function operaciones(cual, para1, para2, para3) {
    switch (cual) {
        case 'sumar':
            //alert("vamos a sumar");
            $.ajax({
                type:"POST",
                url: "operaciones.php",
                data:{"accion":cual, "datoA":para1, "datoB":para2},
                //data:$("#forumulario").serialize()+"&accion="+cual,
                beforeSend: function(){
                    resultado.innerHTML="Procesando...";
                //$("#resultados").html("Procesando...");
                },
                success:function(resulPHP){
                    resultado.innerHTML=resulPHP;
                },
                error: function(resul){

                }
            });
            break;
        case 'mostNumeros':
            alert("mostraremos #s");

            break;
        default: alert(cual + " No esta programado");
    }
}