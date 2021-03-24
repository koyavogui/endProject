<?php 
    session_start();
    require "../../database/database.php";
    $check = $db->prepare("SELECT * FROM users WHERE  idUser =:id LIMIT 1");
    $check->bindParam(':id', $_SESSION['idUser']);
    $check->execute();
    if($check->rowCount() > 0){
        $userActif= $check->fetch(PDO::FETCH_OBJ);
    }else{exit();}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require '../../includes/head.php' ?>
    <title>Zokubird Connexion</title>
</head>
<body class="">
<?php
            switch ($_SESSION['role']) {
                case 'Administrateur':
                    require '../../includes/header_admin.php';
                    break;
                case 'Editeur':
                    require '../../includes/header_editeur.php';
                    break;
                case 'Superviseur':
                    require '../../includes/header_superviseur.php';
                    break;
                default:
                    break;
            }
        ?>
     <section class="my-4 d-flex justify-content-center">
        <h2 class="first">Editer votre profile</h2>
     </section>
    <div class="container px-5 mt-5">
            <div class="border-4 border-bottom  border-primary  container-fluid-md border-0 bg-white rounded-0 px-5 pb-2 mb-5">
                <form  class="" id="profilForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4 col-lg-3 position-relative">
                            <div class="text-center">
                                <img src="<?php echo ($_SESSION['image'] !== "") ? '../uploaded/'.$userActif->imageUser :  '../../images/businessman.png';  ?>" class="img-fluid"  alt="..." id="imgView">
                                    <label for="formFile" class="fs-4 text-center position-absolute bottom-0 end-0  rounded-circle bg-zokubird-ligth text-white d-flex justify-content-center align-items-center" style="height: 4rem; width: 4rem;"><i class="bi bi-images"></i></label>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-9 p-2">
                            <div class="mb-2">
                                <label for="nom" class="mb-2">Nom  </label>
                                <input type="text" name="nom" id="nom" class="form-control border rounded-0 border-primary" value="<?php echo $userActif->fullNamesUser; ?>" disabled> 
                            </div>
                            <div class="form-group py-2">
                                <label for="prenoms" class="mb-2">Email </label>
                                <input type="text" name="email" id="email" class="form-control border rounded-0 border-primary" value="<?php echo $userActif->emailUser; ?>"  disabled> 
                                <div class="invalid-feedback">
                                    Cet email est déjà utilisé !
                                </div>
                            </div>
                            <div class="form-group py-2">
                                <label for="phone" class="">Télephone </label>
                                <input type="text" name="phone" id="phone" class="form-control border rounded-0 border-primary" value="<?php echo $userActif->phoneUser; ?>"  disabled> 
                            </div>
                            <input class="form-control form-control-sm invisible" type="file" id="formFile" name="photoProfile"  disabled>
                        </div>
                    </div>
                    <div class="container my-1">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="container-fluid-md btn  btn-primary" id="updateProfil"> <i class="bi bi-pencil-fill" id="i-icone"></i> Modifier</button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
            <!-- Modal -->
    <div class="modal fade" id="motdepasse" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewVersement">Saisir votre mot de passe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                 <input type="password" name="password" id="password" class="form-control border border-primary" autofocus required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="passwordValidate">Valider</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="reset">Retour</button>
            </div>
            </div>
        </div>
    </div>
       <!-- footer-->
    
       <?php require '../../includes/footer.php' ?>
       <script src="../../script/jquery.js"></script>
       <script>
             
               /**
                *  Modification profile
                */
                $("#profilForm").submit(function (event) {
                   event.preventDefault();
                   if(!($( "input" ).is( ":disabled"))){
                       $('#motdepasse').modal('show');
                       $('#password').trigger('focus')
                    }
                    $( "input" ).prop( "disabled", false );
                });
                
                /**
                 * ACtivation de la modification
                 */
                $("#updateProfil").click(function (e) {
                    if ($("#updateProfil").attr('type') == 'button' ) {  
                        $("#updateProfil").html('<i class="bi bi-hdd-fill"></i> Enregistrer');
                        $("#updateProfil").toggleClass("btn-primary btn-success" );
                        $("#updateProfil").attr('type', 'submit'); 
                }
    });
    
    /**
     * Mettre à jour les informations de l'utilisateur
     */
    function update() {
        
        const form = $("#profilForm").submit();
        var formdata = new FormData(form[0]);
        console.log(formdata );
        $.ajax({
            type: "POST",
            url: "./../../services/profil_update.php",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (m) {
                if(m.update == 'success'){
                    // $("#header").load("nav.php #header");
                    // $("#profilForm").load("profil.php #profilForm");
                    $("#password").val('');
                    $("#updateProfil").text('Modifier');
                    $( "input" ).prop( "disabled", true );
                    $("#updateProfil").toggleClass( "btn-primary btn-success" );
                    $("#updateProfil").attr('type', 'button'); 
                    $('#motdepasse').modal('hide');
                    setTimeout(function(){ 
                        // $( "#addForm" )[0].reset();
                        // $( "#addModal" ).modal('hide');
                        location.reload();
                     }, 500);
                }
            },
            dataType: "JSON"
        });
    }
    /**
     * validation du mot de passe
     */
    var action = false;
    $("#passwordValidate").click(function (e) { 
        e.preventDefault();
        const motdepasse = $("#password").val();
        console.log(motdepasse);
        $.post( "./../../services/profil_update.php", { motdepasse: motdepasse}, function( r ) {
            if (r.result == 'success') {
                update(); 
            }else{
                $( "#motdepasse" ).effect( "shake");
            }
        }, "json");
    });
    
    
    /**
     * reinitialiser un champ
     */
    $("#reset").click(function () { 
        $("#password").val('');
    });

    function browser() {
        $('#inputGroupFile02').click();
    }
       </script>
    <?php
        // var_dump($_SESSION['role']);

            switch ($_SESSION['role']) {
                case 'Administrateur':
                    echo '<script src="./../../script/admin.js"></script>';
                    break;
                case 'Editeur':
                    echo '<script src="./../../script/editeur.js"></script>';
                    break;
                case 'Superviseur':
                    // echo '<script src="./../../script/editeur.js"></script>';
                    echo '<script src="./../../script/superviseur.js"></script>';
                    break;
                default:
                    break;
            }
        ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>