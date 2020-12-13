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
              id_Habitacion: '',
              costo: '',
              tipo: '',
              telefono: '',
              costo:'',
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
              alertify.confirm("Se eliminará Transporte con id:"+ id,
                  function() {
                    alertify.success('Ok');
                    $.ajax({
                      data:  {'id':id},
                      url:   '../../controlador/dashboard/transporte/bajas_transporte.php',
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

            modificar:function(id,tipo,linea,telefono,costo,disponibilidad){
              document.getElementById("titulo").innerHTML = "Modificar Transporte";
              $("#id").val(id);
              $("#tipo").val(tipo);
              $("#linea").val(linea);
              $("#phoneNumber").val(telefono);
              $("#costo").val(costo);
              $("#disponibilidad").val(disponibilidad);
              document.getElementById("btn_agregar_modificar").innerHTML = "Modificar";
              //document.getElementById('btn_agregar_modificar').onclick = generarCambio();
              document.getElementById('btn_agregar_modificar').setAttribute('onclick','generarCambio()');

            },

          obtenerRegistros(){
              fetch("../../controlador/dashboard/transporte/consultas_transportes.php")
              .then(response=>response.json())
              .then(json=>{this.items=json.transportes})
          },

          obtenerRegistrosFiltro(fl){
              //console.log("Lo que ya tiene" +this.items);
              //this.items=[];
              $arreglo=[];
              const data = new FormData();
              data.append('filtro', fl);
              fetch('../../controlador/dashboard/transporte/consultas_transportes_filtro.php', {
              method: 'POST',
              body: data
              })
              .then(response=>response.json())
              .then(json=>{this.items=json.transportes});

              console.log(this.items);
          }
 
      }
    });
}

function limpiar(){
  document.getElementById("titulo").innerHTML = "Agregar Transporte";
    $("#id").val("");
    $("#tipo").val("Avión");
    $("#linea").val("");
    $("#phoneNumber").val("");
    $("#costo").val("");
    $("#disponibilidad").val("Disponible");
  document.getElementById("btn_agregar_modificar").innerHTML = "Agregar";
  document.getElementById('btn_agregar_modificar').setAttribute('onclick','agregar()');
  $.ajax({
      data:  {},
         url:   '../../controlador/dashboard/transporte/generar_id_transporte.php',
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
   $tipo=$("#tipo option:selected").text();
   $linea=document.getElementById('linea').value.trim();
   $telefono=document.getElementById('phoneNumber').value.trim();
   $costo=document.getElementById('costo').value.trim();
   $disponibilidad=$("#disponibilidad option:selected").text();

   if (isNaN($telefono)==true || $telefono.length!=10) {
       
       alert ('Telefono no valido!');
      }else{
          if (isNaN($costo)==true) {
              alert ('Costo no valido!');
             }else{

  $.ajax({
      data:  {'id':$id,'tipo':$tipo,'linea':$linea,'telefono':$telefono,'costo':$costo,'disponibilidad':$disponibilidad},
      url:   '../../controlador/dashboard/transporte/altas_transporte.php',
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
}

function generarCambio() {
    $id=document.getElementById('id').value.trim();
    $tipo=$("#tipo option:selected").text();
    $linea=document.getElementById('linea').value.trim();
    $telefono=document.getElementById('phoneNumber').value.trim();
    $costo=document.getElementById('costo').value.trim();
    $disponibilidad=$("#disponibilidad option:selected").text();
 
    if (isNaN($telefono)==true || $telefono.length!=10) {
        
        alert ('Telefono no valido!');
       }else{
           if (isNaN($costo)==true) {
               alert ('Numero no valido!');
              }else{

   alertify.confirm("¿Desea enviar las modificaciones al Transporte con id:"+$id+"?",
      function() {
        alertify.success('Ok');
        $.ajax({
            data:  {'id':$id,'tipo':$tipo,'linea':$linea,'telefono':$telefono,'costo':$costo,'disponibilidad':$disponibilidad},
             url:   '../../controlador/dashboard/transporte/cambios_transporte.php',
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
 
}
