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
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require '../../includes/head.php' ?>
    <title>Zokubird - <?php echo $_SESSION['nomPage']; ?> </title>
</head>
<body class="container-fluid p-0">
        <?php
        // var_dump($_SESSION['role']);
        $script = "";
            switch ($_SESSION['role']) {
                case 'Administrateur':
                    require '../../includes/header_admin.php';
                    require './admin.php';
                    $script = "admin.js";
                    break;
                case 'Editeur':
                    require '../../includes/header_editeur.php';
                    require './editeur.php';
                    $script = "editeur.js";
                    break;
                case 'Superviseur':
                    require '../../includes/header_superviseur.php';
                    require './superviseur.php';
                    $script = "superviseur.js";
                    break;
                default:
                    break;
            }
        ?>
        </div>
       <!-- footer-->
       <?php require '../../includes/footer.php' ?>
    <script src="../../script/jquery.js" ></script>
    <script src="../../script/<?php echo $script;?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>