
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
                id: '',
                nombre: '',
                categoria: '',
                telefono: '',
                calle:'',
                numero:'',
                ciudad:''
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
                alertify.confirm("Se eliminará Hotel con id:"+ id,
                    function() {
                      alertify.success('Ok');
                      $.ajax({
                        data:  {'id':id},
                        url:   '../../controlador/dashboard/hotel/bajas_hotel.php',
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

              modificar:function(id,nombre,categoria,telefono,calle,numero,ciudad){
                document.getElementById("titulo").innerHTML = "Modificar Hotel";
                $("#id").val(id);
                $("#nombre").val(nombre);
                $("#categoria").val(categoria);
                $("#phoneNumber").val(telefono);
                $("#calle").val(calle);
                $("#numero").val(numero);
                $("#ciudad").val(ciudad);
                document.getElementById("btn_agregar_modificar").innerHTML = "Modificar";
                //document.getElementById('btn_agregar_modificar').onclick = generarCambio();
                document.getElementById('btn_agregar_modificar').setAttribute('onclick','generarCambio()');

              },

            obtenerRegistros(){
                fetch("../../controlador/dashboard/hotel/consultas_hoteles.php")
                .then(response=>response.json())
                .then(json=>{this.items=json.hoteles})
            },

            obtenerRegistrosFiltro(fl){
                //console.log("Lo que ya tiene" +this.items);
                //this.items=[];
                $arreglo=[];
                const data = new FormData();
                data.append('filtro', fl);
                fetch('../../controlador/dashboard/hotel/consultas_hoteles_filtro.php', {
                method: 'POST',
                body: data
                })
                .then(response=>response.json())
                .then(json=>{this.items=json.hoteles});

                console.log(this.items);
            }
   
        }
      });
}

function limpiar(){
    document.getElementById("titulo").innerHTML = "Agregar Hotel";
    $("#nombre").val("");
    $("#categoria").val("1");
    $("#phoneNumber").val("");
    $("#calle").val("");
    $("#numero").val("");
    $("#ciudad").val("");
    document.getElementById("btn_agregar_modificar").innerHTML = "Agregar";
    document.getElementById('btn_agregar_modificar').setAttribute('onclick','agregar()');
    $.ajax({
        data:  {},
           url:   '../../controlador/dashboard/hotel/generar_id.php',
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
     $nombre=document.getElementById('nombre').value.trim();
     $categoria=$("#categoria option:selected").text();
     $telefono=document.getElementById('phoneNumber').value.trim();
     $calle=document.getElementById('calle').value.trim();
     $numero=document.getElementById('numero').value.trim();
     $ciudad=document.getElementById('ciudad').value.trim();
     console.log($categoria);


     if (isNaN($telefono)==true || $telefono.length!=10) {
         
         alert ('Telefono no valido!');
        }else{
            if (isNaN($numero)==true) {
                alert ('Numero no valido!');
               }else{

    $.ajax({
        data:  {'id':$id,'nombre':$nombre,'categoria':$categoria,'telefono':$telefono,'calle':$calle,'numero':$numero,'ciudad':$ciudad},
        url:   '../../controlador/dashboard/hotel/altas_hotel.php',
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
     $nombre=document.getElementById('nombre').value.trim();
     $categoria=$("#categoria option:selected").text();
     $telefono=document.getElementById('phoneNumber').value.trim();
     $calle=document.getElementById('calle').value.trim();
     $numero=document.getElementById('numero').value.trim();
     $ciudad=document.getElementById('ciudad').value.trim();

     if (isNaN($telefono)==true || $telefono.length!=10) {
         
        alert ('Telefono no valido!');
       }else{
           if (isNaN($numero)==true) {
               alert ('Numero no valido!');
              }else{

     alertify.confirm("¿Desea enviar las modificaciones al Transporte con id:"+$id+"?",
        function() {
          alertify.success('Ok');
          $.ajax({
            data:  {'id':$id,'nombre':$nombre,'categoria':$categoria,'telefono':$telefono,'calle':$calle,'numero':$numero,'ciudad':$ciudad},
               url:   '../../controlador/dashboard/hotel/cambios_hotel.php',
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
