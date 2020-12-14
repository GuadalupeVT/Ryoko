function agregar() {
    $inicio=document.getElementById('inicio').value.trim();
    $fin=document.getElementById('fin').value.trim();
    $destino=document.getElementById('destino').value.trim();
    $tipo=$("#tipo option:selected").text();
 
    //Validacion campos
    if($inicio=="" || $fin=="" || $destino=="" || $tipo==""){
     alertify.confirm("No deje campos vacios",
       function() {
         alertify.success('Ok');
    //Obtener respuesta si hay hotel en ese ciudad
       },
       function() {
         alertify.error('Cancelar');
         location.reload();
       }
     );
    }else{ 
        $.ajax({
            data:  {'inicio':$inicio,'fin':$fin,'destino':$destino,'tipo':$tipo},
            url:   '../../controlador/dashboard/reserva/verificar_reserva.php',
            dataType: 'html',
            type:  'post',
            beforeSend: function () {
            },
            success:  function (response) {
                    if(response==1){
                        var bool=confirm("Se registro su viaje");
                        if(bool){
                            altaReserva($inicio,$fin,$destino.$tipo);
                        }else{
                          
                        }   
                    }else{
                        alert("No se encontro disponibilidad segun lo buscado");
                        
                    }
            }
        });
       
    }
   
 }

 function altaReserva(ini,fn,dest,tp){
  
    $.ajax({
        data:  {'inicio':ini,'fin':fn,'destino':dest,'tipo':tp},
        url:   '../../controlador/dashboard/reserva/altas_reserva.php',
        dataType: 'html',
        type:  'post',
        beforeSend: function () {
        },
        success:  function (response) {
                alert(response);
                console.log(response);
        }
    });
 }

 