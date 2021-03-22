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
<body class="container-fluid">
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
       <footer class="bg-zokubird text-light mt-2" style="height :40px; width:100%;"> Copyright</footer>

    <script src="../../script/jquery.js" ></script>
    <script src="../../script/<?php echo $script;?>"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
</body>
</html>