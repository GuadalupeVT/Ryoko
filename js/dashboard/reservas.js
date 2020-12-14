window.onload=function() {
    $filtro="";

  $( "#buscar" ).keypress(function() {
      $filtro=document.getElementById('buscar').value;
     // console.log($filtro);
      example1.obtenerRegistrosFiltro($filtro);
    });

  var example1 = new Vue({
      el: '#example-1',
      data: {
          newEntry: {
              id_Reserva: '',
              costo: '',
              tipo: '',
              id_Hotel: '',
              disponibilidad:''
            },
        items: [ ]
      },
      created: function(){
          console.log("Iniciando...");
          this.obtenerRegistros();
          //this.obtenerRegistrosFiltro($filtro);
      },

      methods: {
          eliminar: function(id) {
              alertify.confirm("Se eliminará Habitación con id:"+ id,
                  function() {
                    alertify.success('Ok');
                    $.ajax({
                      data:  {'id':id},
                      url:   '../../controlador/dashboard/habitacion/bajas_habitacion.php',
                      dataType: 'html',
                      type:  'post',
                      beforeSend: function () {
                      },
                      success:  function (response) {
                          alertify.confirm(response,
                          function() {
                            alertify.success('Ok');
                            location.reload();
                          },
                          function() {
                            alertify.error('Seguir aqui');
                          }
                        );
                      }
                  });
                  },
                  function() {
                    alertify.error('Cancelar');
                  }
                );

              
            },

            modificar:function(id,costo,tipo,id_hotel,disponibilidad){
              document.getElementById("titulo").innerHTML = "Modificar Habitacion";
              $("#id").val(id);
              $("#costo").val(costo);
              $("#tipo").val(tipo);
              $("#id_hotel").val(id_hotel);
              $("#disponibilidad").val(disponibilidad);
              document.getElementById("btn_agregar_modificar").innerHTML = "Modificar";
              //document.getElementById('btn_agregar_modificar').onclick = generarCambio();
              document.getElementById('btn_agregar_modificar').setAttribute('onclick','generarCambio()');

            },

          obtenerRegistros(){
              fetch("../../controlador/dashboard/habitacion/consultas_habitaciones.php")
              .then(response=>response.json())
              .then(json=>{this.items=json.habitaciones})
          },

          obtenerRegistrosFiltro(fl){
              //console.log("Lo que ya tiene" +this.items);
              //this.items=[];
              $arreglo=[];
              const data = new FormData();
              data.append('filtro', fl);
              fetch('../../controlador/dashboard/habitacion/consultas_habitaciones_filtro.php', {
              method: 'POST',
              body: data
              })
              .then(response=>response.json())
              .then(json=>{this.items=json.habitaciones});

              console.log(this.items);
          }
 
      }
    });
}

function limpiar(){
  document.getElementById("titulo").innerHTML = "Agregar Habitacion";
  $("#id").val("");
  $("#costo").val("");
  $("#tipo").val("Individual");
  $("#id_hotel").val("");
  $("#disponibilidad").val("Disponible");
  document.getElementById("btn_agregar_modificar").innerHTML = "Agregar";
  document.getElementById('btn_agregar_modificar').setAttribute('onclick','agregar()');
  $.ajax({
      data:  {},
         url:   '../../controlador/dashboard/habitacion/generar_id_habitacion.php',
         dataType: 'html',
         type:  'post',
         beforeSend: function () {
         },
         success:  function (response) {
            // alert(response);
          $("#id").val(response);
         }
     });
}

function agregar() {
   $id=document.getElementById('id').value.trim();
   $costo=document.getElementById('costo').value.trim();
   $tipo=$("#tipo option:selected").text();
   $id_hotel=$("#id_hotel option:selected").text();
   $disponibilidad=$("#disponibilidad option:selected").text();

   if (isNaN($costo)==true) {
       
       alert ('Costo no valido!');
      }else{
          

  $.ajax({
      data:  {'id':$id,'costo':$costo,'tipo':$tipo,'id_hotel':$id_hotel,'disponibilidad':$disponibilidad},
      url:   '../../controlador/dashboard/habitacion/altas_habitacion.php',
      dataType: 'html',
      type:  'post',
      beforeSend: function () {
          
      },
      success:  function (response) {
               alertify.confirm(response,
               function() {
                 alertify.success('Salir');
                 location.reload();
               },
               function() {
                 alertify.error('Seguir aqui');
               }
             );
              
      }
      
  });

}
}

function generarCambio() {
    $id=document.getElementById('id').value.trim();
   $costo=document.getElementById('costo').value.trim();
   $tipo=$("#tipo option:selected").text();
   $id_hotel=document.getElementById('id_hotel').value.trim();
   $disponibilidad=$("#disponibilidad option:selected").text();

   if (isNaN($costo)==true) {
       
       alert ('Costo no valido!');
      }else{
          

   alertify.confirm("¿Desea enviar las modificaciones al Habitacion con id:"+$id+"?",
      function() {
        alertify.success('Ok');
        $.ajax({
            data:  {'id':$id,'costo':$costo,'tipo':$tipo,'id_hotel':$id_hotel,'disponibilidad':$disponibilidad},
             url:   '../../controlador/dashboard/habitacion/cambios_habitacion.php',
             dataType: 'html',
             type:  'post',
             beforeSend: function () {
             },
             success:  function (response) {
                  alertify.confirm(response,
                  function() {
                    alertify.success('Ok');
                    location.reload();
                  },
                  function() {
                    alertify.error('Seguir aqui');
                  }
                );
             }
         });
      },
      function() {
        alertify.error('Seguir aqui');
      }
    );   
  }
}
 

