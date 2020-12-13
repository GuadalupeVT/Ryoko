function onSuccess(googleUser) {
    $("#email").val(googleUser.getBasicProfile().getEmail());
    $("#firstName").val(googleUser.getBasicProfile().getGivenName());
    $("#lastname").val(googleUser.getBasicProfile().getFamilyName());

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

    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        console.log('Name: ' + profile.getName());
        console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
      }

      function registrar(){
          $captcha=document.getElementById('g-recaptcha-response').value;
          $correo=document.getElementById("email").value;
          $contraseña=document.getElementById("password").value;
          $nombre=document.getElementById("firstName").value;
          $primerAp=document.getElementById("lastname").value;
          $segundoAp=document.getElementById("lastName2").value;
          $telefono=document.getElementById("phoneNumber").value;
          $fecha_nac=document.getElementById("birthday").value;
          $cliente=document.getElementById("cliente").value;
          $hotel=document.getElementById("hotel").value;
          $transporte=document.getElementById("transporte").value;

          

       
         }


        
   