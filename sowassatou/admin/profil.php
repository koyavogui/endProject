<?php 
    session_start();
    // var_dump($_SESSION);
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
        // var_dump($_SESSION['role']);
        $script = "";
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
     <div class="mx-auto">
            <section class="container">
                <article class="my-2">
                <div class="mx-auto card border-0 rounded-0 mb-3 shadow pb-2" style="max-width: 70%;">
                    <div class="row no-gutters">
                        <div class="col-md-4 pt-2">
                        <div class="row">
                            <div class="col-12">
                                <img src="<?php echo ($_SESSION['image'] !== "") ? '../uploaded/'.$userActif->imageUser :  '../../images/businessman.png';  ?>" class="card-img container mt-2 img-fluid"  alt="...">
                            </div>
                            <div class="col-12 pt-2">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-2" id="pmKey">
                                        <span class="fs-3 btn" ><i class="bi bi-key"></i></span> 
                                    </div>
                                    <div class="col-2">
                                        <span class="fs-3"><i class="bi bi-image"></i></span> 
                                    </div>
                                    <div class="col-4"></div>
                                </div>
                            </div>
                        </div>
                        </div> 
                        <div class="col-md-8">
                            <div class="card-body pb-2">
                                <form action="" class="container" id="profilForm">
                                        <div class="mt-2">
                                            <label for="fullNames">Nom et prenoms :</label>
                                            <input type="text" name="fullNames" id="fullNames" class="form-control rounded-0 border border-primary" value="<?php echo $userActif->fullNamesUser; ?>">
                                        </div>
                                        <div class="mt-2">
                                            <label for="email">Email : </label>
                                            <input type="email" name="email" id="email" class="form-control rounded-0 border border-primary" value="<?php echo $userActif->emailUser; ?>">
                                            <div class="valid-feedback">
                                                Cet email est libre, tout semble ok.
                                            </div>
                                            <div class="invalid-feedback">
                                                Cet email est déjà utilisé !
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <label for="phone">Téléphone :</label>
                                            <input type="tel" name="phone" id="phone" class="form-control rounded-0 border border-primary" value="<?php echo $userActif->phoneUser; ?>">
                                        </div>
                                        <div class="mt-3 row">
                                            
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row container">
                        <div class="col-4"></div>
                        <div class="col-4"></div>
                        <div class="col-4">
                            <button type="submit" class="container-fluid btn btn-zokubird text-light">Modifier</button>
                        </div>
                    </div>
                </div>
                </article>
            </section>
        </div>

        <!-- Modal de modification de mot de passe -->
        <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
       <!-- footer-->
    <?php require '../../includes/footer.php' ?>
    <script src="../../script/jquery.js"  ></script>
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
                    echo '<script src="./../../script/editeur.js"></script>';
                        // require '<script src="./../../script/superviseur.js"></script>';
                    break;
                default:
                    break;
            }
        ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>