<?php
    /**
     * Recuperaption de la variable de connexion à la base de données.
     */
    session_start();
    if (!isset($_SESSION['idUser'] )){
        header("location:../user/login.php");
        exit();
    }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require '../../includes/head.php' ?>
    <title>Zokubird - <?php echo $_SESSION['nomPage']; ?> </title>
</head>
<body class="container-fluid px-0">
    <section class="">
        <?php require '../../includes/header_admin.php';?>
    <div class=" container-md" id="listUser">
        <div class="row" id="update">
                <?php
                    require "../../database/database.php";
                    $id       = $_SESSION['idUser'];
                    $users    =  $db->prepare("SELECT * FROM users WHERE parentUser=$id");
                    $users -> execute();
                    $nbr      = $users->rowCount();
                    $users    = $users->fetchAll(PDO::FETCH_OBJ);
                    $db = null;
                    $nombredepage = intdiv($nbr,5);
                    $reste = $nbr%5;
                    if ($reste !=0 ) {
                        ++$nombredepage;
                    }
                ?>
                <section class="d-flex justify-content-center my-4">
                    <h2 class="first">GESTION DES UTILISATEURS (<?php echo $nbr; ?>)</h2>
                </section>
                <section class="d-flex mb-4">
                    <div class="mx-3 btn btn-zokubird text-light rounded-0" id="btnAdd" data-bs-toggle="modal" data-bs-target="#addModal">Ajouter un utilisateur</div>
                    <p class="fw-lighter"> Les utilisateurs en rouge sont les utilisateurs bloqués qui ne pourront plus se connecter à la plateforme </p>
                </section>
                <section class="mt-3 table-responsive" id="table">
                    <table class="table border-dark table-sm">
                        <thead class="bg-zokubird-ligth">
                            <tr class="">
                                <th scope="col">Nom</th>
                                <th scope="col"></th>
                                <th scope="col">Rôle</th>
                                <th scope="col">Description</th>
                                <th scope="col">Date d’enregistrement</th>
                                <th scope="col"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $key=>$user) {
                                if ($key < 5) {?>
                                <tr class="">
                                    <td>
                                        <?php echo $user->fullNamesUser; ?>
                                    </td>
                                    <td>
                                        <?php $retVal = ( $user->statusUser) ? '<i class="bi bi-circle-fill text-danger" aria-hidden="true"> </i>'  : '<i class="bi bi-circle-fill text-success" aria-hidden="true"> </i>'; echo $retVal; ?>
                                    </td>
                                    <td><?php echo $user->roleUser;?></td>
                                    <td><?php $retVal = ( $user->roleUser == "Editeur") ? 'Saisie des données (questions et réponses)'  : 'Supervise les activités de l’administration et des utilisateur'; echo $retVal; ?></td>
                                    <td> <?php echo date("d/m/Y à H:i:s", strtotime($user->create_at)); ?></td>
                                    <td class="">
                                        <span class="btn text-zokubird " data-bs-toggle="modal" data-bs-target="#editModal" data-bs-id="<?php echo $user->idUser; ?>">
                                            <i class="bi bi-gear-wide-connected"></i>
                                        </span>
                                    </td>
                                </tr>
                            <?php }}?>
                        </tbody>
                    </table>
                    <?php    
                        echo '<nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">';
                        $page = 1 ;
                        if($page == 1) {
                            echo'<li class="page-item disabled"><span class="page-link border-0"><i class="bi bi-caret-left-fill"></i></span></li>'; 
                        }else{
                            echo'<li class="page-item" id="'. ($page - 1 ).'" onclick="pagination(this.id, \'pagination_administrateur\')"><span class="page-link border-0"><i class="bi bi-caret-left-fill"></i></span></li>'; 
                        }

                        echo'<li class="page-item" id="pageActuel" data-page='. $page .'><span class="page-link border-0 text-secondary">'.$page.' sur '.$nombredepage.'</span></li>';
                        
                        if($page == 7) {
                            echo'<li class="page-item disabled"><span class="page-link border-0"><i class="bi bi-caret-right-fill"></i></span></li>';
                        }else{
                            echo'<li class="page-item" id="'. $page + 1 .'" onclick="pagination(this.id, \'pagination_administrateur\')"><span class="page-link border-0"><i class="bi bi-caret-right-fill"></i></span></li>';
                        }
                        echo '</ul>
                    </nav>';
                    ?>
                </section>
        </div>

    </div>
     
        <div class="modal" tabindex="-1" id="addModal">
            <div class="modal-dialog">
                <div class="modal-content  rounded-0 border-zokubird">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Ajouter un utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" class="m-2" id="addUserFom">
                        <div class="mb-3">
                            <label class="form-label" for="fullNames">Nom et prenoms :</label>
                            <input type="text" name="fullNames" id="fullNames" class="form-control rounded-0 border border-primary">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email : </label>
                            <input type="email" name="email" id="email" class="form-control rounded-0 border border-primary">
                            <div class="valid-feedback">
                                Cet email est libre, tout semble ok.
                            </div>
                            <div class="invalid-feedback">
                                Cet email est déjà utilisé !
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label class="form-label" for="phone">Téléphone :</label>
                                <input type="tel" name="phone" id="phone" class="form-control rounded-0 border border-primary">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="role">Rôles : </label>
                                <select name="role" id="role" class="form-select rounded-0 border border-primary">
                                    <option value="">-- Choisir un role --</option>
                                    <option value="Editeur">Editeur</option>
                                    <option value="Superviseur">Superviseur</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success" id="btnAddUserForm">Ajouter</button>
                </div>
                </div>
            </div>
        </div>

        <div class="modal" id="editModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content border-zokubird rounded-0 ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form class="m-2" id="editUserFom">
                        <input type="hidden" name="editIdUser" id="editIdUser" value="">
                        <div class="mb-3 row">
                            <div class="col-md mb-3">
                                <label class="text-zokubird fw-bolder" for="fullNames" id="">Nom et prenoms : </label> <span id="editfullNames" class="fw-light"></span>
                                <input type="hidden" name="fullname" value="" id="fullNameEdit">
                            </div>
                            <div class="col-md mb-3">
                            <label class="text-zokubird fw-bolder" for="email">Email : </label> <span id="editemail" class="fw-light"> </span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md col-sm mb-3">
                                <label class="text-zokubird fw-bolder" for="phone">Téléphone : </label> <span id="editphone" class="fw-light"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-zokubird fw-bolder" for="role">Rôles : </label>
                                <select name="role" id="editrole" class="form-select border rounded-0 border-primary">
                                    <option value="">-- Choisir un role --</option>
                                    <option value="Editeur">Editeur</option>
                                    <option value="Superviseur">Superviseur</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <h5 class="text-zokubird fw-bolder">Bloquer l’utilisateur :</h5>
                            </div>
                            <div class="col d-flex justify-content-evenly">
                                <div class="form-check">
                                    <input class="form-check-input text-success" type="radio" name="status" id="editroleUser1" value="1">
                                    <label class="form-check-label fw-light" for="editroleUser1">
                                        Oui
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="editroleUser2" value="0">
                                    <label class="form-check-label fw-light" for="editroleUser2">
                                        Non
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> 
                <div class="modal-footer ">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"> fermer</button>
                    <button type="button" class="btn btn-success" id="btnEditUserForm">Modifier</button>
                </div>
                </div>
            </div>
        </div>
         
</div>      
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        <img src="..." class="rounded me-2" alt="...">
        <strong class="me-auto">Bootstrap</strong>
        <small>11 mins ago</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        Hello, world! This is a toast message.
        </div>
    </div>
    </div>
       <!-- footer-->
       <?php require '../../includes/footer.php' ?>    
    <script src="../../script/jquery.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
    <script src="../../script/admin.js"></script>
    <!-- <script src="../../script/main.js"></script> -->
</body>
</html>