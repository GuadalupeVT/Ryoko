function agregar() {
    document.getElementById("titulo").innerHTML = "Agregar Transporte";
     $id=document.getElementById('id').value;
     $tipo=document.getElementById('tipo').value;
     $linea=document.getElementById('linea').value;
     $telefono=document.getElementById('phoneNumber').value;
     $costo=document.getElementById('costo').value;
     $disponibilidad=document.getElementById('disponibilidad').value;

    $.ajax({
        data:  {'id':$id,'tipo':$tipo,'linea':$linea,'telefono':$telefono,'costo':$costo,'disponibilidad':$disponibilidad},
        url:   '../../controlador/dashboard/transporte/altas_transporte.php',
        dataType: 'html',
        type:  'post',
        beforeSend: function () {
            
        },
        success:  function (response) {
                 alert(response);
                 location.reload();
            
            

        }
    });
}

function limpiar(){
    document.getElementById("titulo").innerHTML = "Agregar Transporte";
    $("#id").val("");
    $("#tipo").val("Avión");
    $("#linea").val("");
    $("#phoneNumber").val("");
    $("#costo").val("costo");
    $("#disponibilidad").val("Disponible");
    document.getElementById("btn_agregar_modificar").innerHTML = "Agregar";
    document.getElementById('btn_agregar_modificar').setAttribute('onclick','agregar()');
}

function eliminar(id_t) {
    var opcion = confirm("Se eliminará Transporte con id:"+ id.value);
    if (opcion == true) {
        $.ajax({
            data:  {'id':id_t},
            url:   '../../controlador/dashboard/transporte/bajas_transporte.php',
            dataType: 'html',
            type:  'post',
            beforeSend: function () {
             alert();
            },
            success:  function (response) {
                     alert(response);
                     location.reload();
            }
        });
	} else {
	}
}


function modificar(id_t,tipo,linea,telefono,costo,disponibilidad) {
    //Poner los valores a la cajas del modal
    document.getElementById("titulo").innerHTML = "Modificar Transporte";
    $("#id").val(id_t);
    $("#tipo").val(tipo);
    $("#linea").val(linea);
    $("#phoneNumber").val(telefono);
    $("#costo").val(costo);
    $("#disponibilidad").val(disponibilidad);
    document.getElementById("btn_agregar_modificar").innerHTML = "Modificar";
    //document.getElementById('btn_agregar_modificar').onclick = generarCambio();
    document.getElementById('btn_agregar_modificar').setAttribute('onclick','generarCambio()');
    
 }

 function generarCambio() {
     $id=document.getElementById('id').value;
     $tipo=document.getElementById('tipo').value;
     $linea=document.getElementById('linea').value;
     $telefono=document.getElementById('phoneNumber').value;
     $costo=document.getElementById('costo').value;
     $disponibilidad=document.getElementById('disponibilidad').value;

     var opcion = confirm("¿Desea enviar las modificaciones al Transporte con id:"+$id+"?");
    if (opcion == true) {
        $.ajax({
            data:  {'id':$id,'tipo':$tipo,'linea':$linea,'telefono':$telefono,'costo':$costo,'disponibilidad':$disponibilidad},
            url:   '../../controlador/dashboard/transporte/cambios_transporte.php',
            dataType: 'html',
            type:  'post',
            beforeSend: function () {
            },
            success:  function (response) {
                     alert(response);
                     location.reload();
            }
        });
    }
 }