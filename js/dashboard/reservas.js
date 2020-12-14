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
              fecha_inicio: '',
              fecha_fin: '',
              nombreCliente: '',
              primerAp:'',
              segundoAp:'',
              tipoHabitacion:'',
              nombreHotel:'',
              tipoTransporte:'',
              linea:'',
              total:''
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
              alertify.confirm("Se eliminará Reserva con id:"+ id,
                  function() {
                    alertify.success('Ok');
                    $.ajax({
                      data:  {'id':id},
                      url:   '../../controlador/dashboard/reserva/bajas_reservas.php',
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

            modificar:function(id,inicio,fin,nombreCliente,primerAp,segundoAp,tipoHabitacion,nombreHotel,tipoTransporte,linea,total){
              document.getElementById("titulo").innerHTML = "Modificar Reserva";
              $("#id").val(id);
              $("#inicio").val(inicio);
              $("#fin").val(fin);
              $("#nombre").val(nombreCliente);
              $("#primerAp").val(primerAp);
              $("#segundoAp").val(segundoAp);
              $("#tipo").val(tipoHabitacion);
              $("#nombre_h").val(nombreHotel);
              $("#tipo_t").val(tipoTransporte);
              $("#linea").val(linea);
              $("#total").val(total);
              document.getElementById("btn_agregar_modificar").innerHTML = "Modificar";
              //document.getElementById('btn_agregar_modificar').onclick = generarCambio();
              document.getElementById('btn_agregar_modificar').setAttribute('onclick','generarCambio()');

            },

          obtenerRegistros(){
              fetch("../../controlador/dashboard/reserva/consultas_reservas.php")
              .then(response=>response.json())
              .then(json=>{this.items=json.reservas})
          },

          obtenerRegistrosFiltro(fl){
              //console.log("Lo que ya tiene" +this.items);
              //this.items=[];
              $arreglo=[];
              const data = new FormData();
              data.append('filtro', fl);
              fetch('../../controlador/dashboard/reserva/consultas_reservas_filtro.php', {
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


function agregar() {
  
}

function generarCambio() {
   $id=document.getElementById('id').value.trim();
   $inicio=document.getElementById('inicio').value().trim();
   $fin=document.getElementById('fin').value().trim();

   alertify.confirm("¿Desea enviar las modificaciones a la Reserva con id:"+$id+"?",
      function() {
        alertify.success('Ok');
        $.ajax({
            data:  {'id':$id,'inicio':$inicio,'fin':$fin},
             url:   '../../controlador/dashboard/reserva/cambios_reserva.php',
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
 

