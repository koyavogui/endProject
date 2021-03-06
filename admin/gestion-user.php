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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Zokubird - <?php echo $_SESSION['nomPage']; ?> </title>
</head>
<body class="container-fluid px-0">
    <section class="">
        <?php require '../../includes/header_admin.php';?>
    <div class="container">
        <div class="row" id="listUser">
            <?php
                  require "../../database/database.php";
                  $id       = $_SESSION['idUser'];
                  $users    =  $db->prepare("SELECT * FROM users WHERE parentUser=$id");

                  $users -> execute();

                  $nbr      = $users->rowCount();
                  $users    = $users->fetchAll(PDO::FETCH_OBJ);
                  $db = null;
            ?>
                <section class="d-flex justify-content-center">
                <h2>GESTION DES UTILISATEURS (<?php echo $nbr; ?>)</h2>
                </section>
                <section class="d-flex  ">
                    <div class="mx-3 btn btn-zokubird text-light rounded-0" id="btnAdd">Ajouter un utilisateur</div>
                    <p> <strong><em> Les utilisateurs en rouge sont les utilisateurs bloqués qui ne pourront plus se connecter à la plateforme</em></strong></p>
                </section>
                <section class="mt-3">
                    <table class="table table-striped border-dark table-sm">
                        <thead class="bg-zokubird">
                            <tr class="">
                                <th scope="col">Nom</th>
                                <th scope="col">Rôle</th>
                                <th scope="col">Description</th>
                                <th scope="col">Date d’enregistrement</th>
                                <th scope="col"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) {?>
                                <tr>
                                    <td>
                                    <div class="row">
                                        <div class="col-md-8"><?php echo $user->fullNamesUser; ?></div>
                                        <div class="col-md-4"> 
                                            <?php $retVal = ( $user->statusUser) ? '<i class="fa fa-circle text-danger" aria-hidden="true"> </i>'  : '<i class="fa fa-circle text-success" aria-hidden="true"> </i>'; echo $retVal; ?>
                                        </div>
                                    </div>
                                    </td>
                                    <td><?php echo $user->roleUser;?></td>
                                    <td><?php $retVal = ( $user->roleUser == "Editeur") ? 'Saisie des données (questions et réponses)'  : 'Supervise les activités de l’administration et des utilisateur'; echo $retVal; ?></td>
                                    <td> <?php echo date("d/m/Y à H:i:s", strtotime($user->create_at)); ?></td>
                                    <td class="">
                                        <span class="btn text-zokubird " data-toggle="modal" data-target="#editModal" data-id="<?php echo $user->idUser; ?>">
                                            <i class="fa fa-cogs" aria-hidden="true"></i>
                                        </span>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <div class="row d-flex justify-content-center align-items-center">
                        <nav aria-label="Page navigation example  ">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                <a class="page-link text-zokubird" href="#" tabindex="1" aria-disabled="true">Previous</a>
                                </li>
                                <li class="page-item"><a class="bg-zokubird page-link text-white" href="#">1</a></li>
                                <li class="page-item"><a class="page-link text-zokubird" href="#">2</a></li>
                                <li class="page-item"><a class="page-link text-zokubird" href="#">3</a></li>
                                <li class="page-item">
                                <a class="page-link text-zokubird" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </section>
        </div>

    </div>
    <div class="">
        <div class="modal" tabindex="-1" id="addModal">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" class="m-2" id="addUserFom">
                        <div class="mb-3 row">
                            <label class="form-label" for="fullNames">Nom et prenoms :</label>
                            <input type="text" name="fullNames" id="fullNames" class="form-control border border-primary">
                        </div>
                        <div class="mb-3 row">
                            <label class="form-label" for="email">Email : </label>
                            <input type="email" name="email" id="email" class="form-control border border-primary">
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
                                <input type="tel" name="phone" id="phone" class="form-control border border-primary">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="role">Rôles : </label>
                                <select name="role" id="role" class="form-select border border-primary">
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

        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form class="m-2" id="editUserFom">
                        <input type="hidden" name="editIdUser" id="editIdUser" value="">
                        <div class="mb-3 row">
                            <div class="col-md mb-2">
                                <label class="text-zokubird font-weight-bold" for="fullNames" id="">Nom et prenoms : </label> <span id="editfullNames"></span>
                                <input type="hidden" name="fullname" value="" id="fullNameEdit">
                            </div>
                            <div class="col-md mb-2">
                            <label class="text-zokubird font-weight-bold" for="email">Email : </label> <span id="editemail"> </span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md col-sm ">
                                <label class="text-zokubird font-weight-bold" for="phone">Téléphone : </label> <span id="editphone"></span>
                                 
                            </div>
                            <div class="col-md-6">
                                <label class="text-zokubird" for="role">Rôles : </label>
                                <select name="role" id="editrole" class="form-select border border-primary">
                                    <option value="">-- Choisir un role --</option>
                                    <option value="Editeur">Editeur</option>
                                    <option value="Superviseur">Superviseur</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <h5 class="text-zokubird">Bloquer l’utilisateur :</h5>
                            </div>
                            <div class="col d-flex justify-content-evenly">
                                <div class="form-check">
                                    <input class="form-check-input text-success" type="radio" name="status" id="editroleUser1" value="1">
                                    <label class="form-check-label" for="editroleUser1">
                                        Oui
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="editroleUser2" value="0">
                                    <label class="form-check-label" for="editroleUser2">
                                        Non
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">fermer</button>
                    <button type="button" class="btn btn-success" id="btnEditUserForm">Modifier</button>
                </div>
                </div>
            </div>
        </div>      
    </div>
    <div aria-live="polite" aria-atomic="true" style="position: fixe; min-height: 200px; width: 40%;">
        <div class="toast ml-auto mt-2 mr-2 toast fade hide "  id="successToast" style="position: absolute; top: 0; right: 0;">
            <div class="toast-header">
                <div class="text-success"><i class="fas fa-square"></i></div>
                <strong class="mr-auto">Alert</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Votre opération a réussie.
            </div>
        </div>
        <div class="toast ml-auto mt-2 mr-2 toast fade hide "  id="errorToast" style="position: absolute; top: 0; right: 0;">
            <div class="toast-header">
                <div class="text-danger"><i class="fas fa-square"></i></div>
                <strong class="mr-auto">Alert</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Votre opération a echoué.
            </div>
        </div>
    </div>
        
      
       <!-- footer-->
       <footer class="bg-zokubird text-light" style="height :40px;"> Copyright</footer>
    
    <script src="../../script/jquery.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
    <script src="../../script/admin.js"></script>
    <!-- <script src="../../script/main.js"></script> -->
</body>
</html>