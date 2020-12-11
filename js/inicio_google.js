function onSuccess(googleUser) {

    $correo= googleUser.getBasicProfile().getEmail();
    $.ajax({
        data:  {'correo':$correo},
        url:   'controlador/landing/validar_usuario_google.php',
        dataType: 'html',
        type:  'post',
        beforeSend: function () {
            
        },
        success:  function (response) {
                if(response==1){
                  window.location.href='vista/dashboard/dashboard.php';
                }else{
                  alert("Ese usuario no existe");
                }
          
            
            

        }
    });

   


    console.log($correo);

  }
  function onFailure(error) {
    console.log(error);
  }
  function renderButton() {
    gapi.signin2.render('my-signin2', {
      'scope': 'profile email',
      'width': 240,
      'height': 50,
      'longtitle': true,
      'theme': 'dark',
      'onsuccess': onSuccess,
      'onfailure': onFailure
    });
  }