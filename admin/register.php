<?php
    /**
     * Recuperaption de la variable de connexion à la base de données.
     */
    session_start();
    if (!isset($_SESSION['idUser'] )){
        header("location:../../");
        exit();
    }
    require "../../database/database.php";

    /**
     * editeur
     */
    $page = $_SESSION['numPage'];
    $zbird =  $db->prepare("SELECT * FROM intellects WHERE pageIntellect='$page'");
    $zbird ->execute();
    $zbird = $zbird->fetchAll(PDO::FETCH_OBJ);
    $i = 0;
    
    /**
     * redirection de la page
     */
    $echec="";
    if (!empty($_SESSION['idEChec'])) {
        $id = $_SESSION['idEChec'];
        $echec =  $db->prepare("SELECT * FROM echecs WHERE idEchec='$id'");
        $echec->execute();
        $count = $echec->rowCount();
        if($count !== 1){
            // header("location:../../");
            // exit();
        }
        $echec = $echec->fetchAll(PDO::FETCH_OBJ);
        // unset($_SESSION['idEChec']);
        $echec = $echec[0];
    }
    $db = null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Zokubird - <?php echo $_SESSION['nomPage']; ?> </title>
</head>
<body class="container-fluid">
    <?php require '../../includes/header_editeur.php' ?>   
    <div class="modal " tabindex="-1" id="deleteModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header bg-danger text-ligth ">
                <h5 class="modal-title">Supression d'une intelligence</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Vous ête sur le point de supprimer une intelligence. Vous en êtes sure ?</p>
                <input type="hidden" name="delete" id="deleteInput">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger text-ligth" id="delete"><i class="fas fa-trash-alt"></i>Supprimer</button>
            </div>
            </div>
        </div>
    </div>
    <div class="modal fade " id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header bg-zokubird">
                <h5 class="modal-title" id="exampleModalLabel">Modification </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" class="container" id="modalForm">
                    <div class="mb-3">
                        <label for="editQuestion" class="text-zokubird label-control">Les Questions: </label>
                        <textarea class="form-control border border-primary" id="editQuestion" name="editQuestion" rows="4"></textarea>
                    </div>
                        
                    <div class="mb-3">
                        <label for="editAnswers" class="text-zokubird label-control">Votre reponse : </label>
                        <textarea class="form-control border border-primary" id="editAnswers" name="editAnswers" rows="2"></textarea>
                    </div>
                    <div class="mb-3 container   p-0">
                        <div class="row container-fluid m-0 p-0">
                            <input type="file" name="editImageQuestion" id="editImageQuestion" class="form-control-file col-md-7" placeholder="michel">
                            <div class=" col-md-5 text-zokubird label-control"><p>Ou votre code d’intégration YouTube ci-dessous</p></div>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <input type="text" name="youtube" id="youtube" class="form-control form-control-lg border border-primary">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-zokubird" id="edit">Modifier</button>
            </div>
            </div>
        </div>
    </div>
     <section class="d-flex justify-content-center">
        <h2>Enregistrer une intelligence</h2>
     </section>
     <div class="row col-md-7 mx-auto">
        <article class="col border border-zokubird my-3">
            <form enctype="multipart/form-data" class="container" id="intellectForm">
                <?php 
                if (!empty($echec)) {
                    
                    echo '<input type="hidden" name="idEchec" value="'.$echec->idEchec.'">';
                }
                ?>
                <div class="mb-3">
                    <label for="question" class="text-zokubird label-control">Les Questions: </label>
                    <textarea class="form-control border border-primary" id="question" name="question" rows="4"  ><?php echo $retVal = (!empty($echec)) ? @$echec->questionEchec: "" ; ?></textarea>
                </div>
                    
                <div class="mb-3">
                    <label for="answers" class="text-zokubird label-control">Votre reponse : </label>
                    <textarea class="form-control border border-primary" id="answers" name="answers" rows="2"></textarea>
                </div>
                <div class="mb-3 container   p-0">
                    <div class="row container-fluid m-0 p-0">
                        <input type="file" name="imageQuestion" id="imageQuestion" class="form-control-file  border border-zokubird col-md-7">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="label-control text-zokubird">Ou votre code d’intégration YouTube ci-dessous</label>
                    <input type="text" name="youtube" id="youtube" class="form-control form-control-lg border border-primary">
                </div>
                <div class="mb-3 row" class="text-zokubird label-control">
                    <button type="submit" class="mx-auto col-md-6 btn btn-zokubird text-light">Valider</button>
                </div>
            </form>
        </article>
    </div>

       <!-- footer-->
    <footer class="bg-zokubird text-light mt-2" style="height :40px;"> Copyright</footer>
    
    <script src="../../script/jquery.js" ></script>
    <script src="../../script/editeur.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
</body>
</html>