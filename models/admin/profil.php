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
<body class="container-fluid">
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
     <section class="d-flex justify-content-center">
        <h2>Editer votre profile</h2>
     </section>
     <div class="mx-auto">
            <section class="container">
                <article class="my-2">
                <div class="mx-auto card mb-3 border-4  border-zokubird border-top-0 border-left-0 border-right-0 bg-light rounded-0 pb-2" style="max-width: 70%;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                         <img src="<?php echo ($_SESSION['image'] !== "") ? '../uploaded/'.$userActif->imageUser :  '../../images/businessman.png';  ?>" class="card-img container mt-2 img-fluid"  alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body pb-2">
                                <form action="" class="container" id="profilForm">
                                        <div class="mt-2">
                                            <label for="fullNames">Nom et prenoms :</label>
                                            <input type="text" name="fullNames" id="fullNames" class="form-control border border-primary" value="<?php echo $userActif->fullNamesUser; ?>">
                                        </div>
                                        <div class="mt-2">
                                            <label for="email">Email : </label>
                                            <input type="email" name="email" id="email" class="form-control border border-primary" value="<?php echo $userActif->emailUser; ?>">
                                            <div class="valid-feedback">
                                                Cet email est libre, tout semble ok.
                                            </div>
                                            <div class="invalid-feedback">
                                                Cet email est déjà utilisé !
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <label for="phone">Téléphone :</label>
                                            <input type="tel" name="phone" id="phone" class="form-control border border-primary" value="<?php echo $userActif->phoneUser; ?>">
                                        </div>
                                        <div class="mt-3 row">
                                            <div class="col-md">
                                                <label for="password">Ancien Mot de passe</label>
                                                <input type="password" name="password" id="password" class="form-control border border-primary"> 
                                            </div>
                                            <div class="col-md">
                                                <label for="password_verify">Nouveau mot de passe</label>
                                                <input type="password" name="password_verify" id="password_verify" class="form-control border border-primary"> 
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row container my-1">
                        <div class="ml-2 col-md-7">
                            <input class="form-control" type="file" id="formFile">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="container-fluid btn btn-zokubird text-light">Modifier</button>
                        </div>
                    </div>
                </div>
                </article>
            </section>
        </div>
       <!-- footer-->
    <?php require '../../includes/footer.php' ?>
    <script src="../../script/jquery.js"  ></script>
    <script src="../../script/editeur.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>