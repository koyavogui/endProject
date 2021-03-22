 /**
  * 
  * Fonction permettant de reecrire le nom de la page pour creer un dossier.
  */
  let pass = $("#password").val();
  let passVerif = $("#password_verify").val();
  let nompage = $("#pageName").val();
  let email = $("#email").val();
 function slugify (str) {
    var map = {
        ' ' : '_',
        ' ' : "'",
        'a' : 'á|à|ã|â|À|Á|Ã|Â',
        'e' : 'é|è|ê|É|È|Ê',
        'i' : 'í|ì|î|Í|Ì|Î',
        'o' : 'ó|ò|ô|õ|Ó|Ò|Ô|Õ',
        'u' : 'ú|ù|û|ü|Ú|Ù|Û|Ü',
        'c' : 'ç|Ç',
        'n' : 'ñ|Ñ',
        '-' : ' '
    };
    
    for (var pattern in map) {
        str = str.replace(new RegExp(map[pattern], 'g'), pattern);
    };

    return str.split('-').join("").toLowerCase();
};

/**
 * fonction pour recuperer la ville en fonction de l'identifiant du pays.
 */
function recupVilleCombo (str){
    if(str !== ''){
        $.post( "services/registrer.php", { cities : str })
        .done(function( data ) {
             $('#city').html(data);
        });
    }
}

 

$(document).ready(function(){
    $("#formSingin").hide();
     
    // charger la section de connexion
    $("#locationHref").click(function () { 
        const text = $("#locationHref").text();
        // console.log(text);
        // console.log(text == "Connexion");
        if (text == "Connexion") {
            $("#formRegister").hide();
            $("#formSingin").show();
            $("#locationHref").text("Creer un compte"); 
            $("#formTitle").text("Connexion");
        } else {
            $("#formSingin").hide();
            $("#formRegister").show();
            $("#locationHref").text("Connexion"); 
            $("#formTitle").text('Creer un compte');
        }

    })
    /**
     * verification de mail 
     */
    $("#email").focusout(function () {
        email = $("#email").val();
        if(email !== ''){
            $.post( "services/registrer.php", { checkEmail : email }, function( data ) {
                if (data.resultCheckEmail == 1) {
                    $("#pageName").attr('disabled', 'disabled');
                    $("#btnvalidate").attr('disabled', 'disabled');
                    if (!$("#email").is(".is-invalid")) {
                        $( "#email" ).toggleClass("is-invalid");
                        $( "#email" ).toggleClass("border-danger", "border-primary");
                    }
                    if ($("#email").is(".is-valid")) {
                        $("#email").removeClass("is-valid border-primary");
                        $("#email").addClass("is-invalid border-danger");
                    }
                } else {
                    $("#pageName").removeAttr('disabled');
                    /**
                     * Avant de desactiver le bouton d'envoie on va vérifier si la case mot de passe n'est pas vide
                     */
                    if ((pass  == passVerif) && (passVerif.length >= 8) && nompage.length >=5 && !($("#btnvalidate").is(":disabled")) && $("#condition").is(":checked")) {
                        $("#btnvalidate").removeAttr('disabled');    
                    }                    
                    if ($("#email").is(".is-invalid")) {
                        $("#email").removeClass("border-danger is-invalid");
                        $("#email").addClass("border-primary is-valid");
                    }
                }
                }, "json");
        }
      })
    
      /**
       * verification si les deux mot de passe son identiques
       */
      $("#password_verify").keyup(function (e) { 
        pass = $("#password").val();
        passVerif = $("#password_verify").val();
        if (pass.length == passVerif.length) {
            if (pass == passVerif) {
                if (nompage.length >=5 && email.length >=10  ) {
                    $("#btnvalidate").removeAttr('disabled');    
                }
            }else{
                $('#btnvalidate').attr('disabled', 'disabled');
            }
        }else{
            $("#pageName").attr('disabled', 'disabled');
            $("#btnvalidate").attr('disabled', 'disabled');
        }
      });
      /**
       *  verification du nom de la page dans la base de données
       */
      $("#pageName").focusout(function () {
        pageName = $("#pageName").val();
        if(pageName.trim() !== ('' && ' ') ){
            $.post( "services/registrer.php", { checkPageName : pageName }, function( data ) {
                if (data.resultcheckPageName == 1) {
                    $("#btnvalidate").attr('disabled', 'disabled');
                    if (!$("#pageName").is(".is-invalid")) {
                        $("#pageName").addClass("is-invalid border-danger");
                        $("#pageName").removeClass("border-primary");
                        console.log('3');
                    }
                    if ($("#pageName").is(".is-valid")) {
                        $("#pageName").removeClass("is-valid");
                        console.log('2');
                    }
                } else {
                    if ((pass  == passVerif) && (passVerif.length >= 8) && email.length  >=5  && !($("#btnvalidate").is(":disabled")) && $("#condition").is(":checked")) {
                        $("#btnvalidate").removeAttr('disabled');    
                    }  
                    if ($("#pageName").is(".is-invalid")) {
                        $("#pageName").removeClass("border-danger is-invalid");
                        $("#pageName").addClass("border-primary is-valid");
                        console.log('1');
                    }
                }
                }, "json");
        }else{
            if ($("#pageName").is(".is-valid")) {
                $( "#pageName" ).toggleClass("is-valid");
            }
            if ($("#pageName").is(".is-invalid")) {
                $( "#pageName" ).toggleClass("is-invalid");
            }
        }
      })

      /**
       * comportement du bouton d'inscription
       */

      $("#condition").click(function (e) { 
          if ($("#condition").is(":checked") ) {
              if( (pass == '' || passVerif =='') && (passVerif.length< 8) && email.length  <5){
                $("#btnvalidate").attr('disabled', 'disabled');   
              }else{
                  $("#btnvalidate").removeAttr('disabled');    
              }
          } else if ( !$("#btnvalidate").is( ":disabled ") && (pass == '' || passVerif =='') && (passVerif.length< 8) && email.length  <5   ){
            $("#btnvalidate").attr('disabled', 'disabled');   
          }
      });

    /**
     *  code pour faire la connexion 
     */

    $("#MySigin").click(function (e) { 
        e.preventDefault();
        $.post( "services/registrer.php", $("#formSingin").serialize(), function (data) {
            console.log(data);
            if ( data.login == "S-success" && data.status == "0") {
                document.location = data.folder+'/admin/' ;
            }else{
                if (data.login == "S-echec") {
                    if (!$("#connectpassword").is(".is-invalid")) {
                        $("#connectpassword").addClass("is-invalid border-danger");
                        $("#connectpassword").removeClass("border-primary");
                    }
                    if ( $("#emailLogin").is(".is-invalid")) {
                        $("#emailLogin").removeClass("is-invalid border-danger");
                        $("#emailLogin").addClass("border-primary");
                    }
                }else{
                    if (!$("#emailLogin").is(".is-invalid")) {
                        $("#emailLogin").addClass("is-invalid border-danger");
                        $("#emailLogin").removeClass("border-primary");
                    }
                    if ( $("#connectpassword").is(".is-invalid")) {
                        $("#connectpassword").addClass("border-primary");
                        $("#connectpassword").removeClass("border-danger is-invalid");
                    }
                   
                }
            //     $("#formTitle").text("L'un de vos accès est incorrect");
            //     if ($("#formTitle").is(".bg-zokubird")) {
            //     $( "#formTitle" ).toggleClass("bg-danger", "bg-zokubird");
            //   }
            //   if ($("#cadre").is(".border-zokubird")) {
            //     $( "#cadre" ).toggleClass("border-danger", "border-zokubird");
            //   }
            } 
        },"json")
    });
    /**
     *  code pour faire un enregistrement.
     */
    $("#formRegister").submit(function (e) { 
        e.preventDefault();
        const chaine = $("#pageName").val();
        console.log(chaine);
        $("#nomdossier").val(slugify(chaine));
        console.log($("#nomdossier").val());
        if (chaine.length > 5) {
            $.post( "services/registrer.php", $("#formRegister").serialize(), function  (data) {
                if(data.enregistrement == 'E-success' && data.page!=='') {
                    $("#formRegister").hide();
                    $("#formSingin").show();
                    $("#locationHref").text("Enregistrement"); 
                    $("#formTitle").text("Connexion");
                }
            }, "json");
        }else{
            $("#pageName").addClass("is-invalid border-danger");
            $("#pageName").removeClass("border-primary");
        }
    });

})
