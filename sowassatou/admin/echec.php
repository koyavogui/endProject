<?php
 
session_start();
//  function getIp()  {
//     if ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) )
//         $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
//     else
//         $ip = $_SERVER['REMOTE_ADDR'];
                
//     return $ip;
// }

// echo getIp();
    require "./../../database/database.php";

    $page = $_SESSION['numPage'];
    $zbirdEchecs =  $db->prepare("SELECT * FROM echecs WHERE idPage ='$page' ORDER BY create_at ASC");
    $zbirdEchecs ->execute();
    $nbr = $zbirdEchecs->rowCount();
    $zbird = $zbirdEchecs->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    $i = 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/style.css">
    <?php require '../../includes/head.php' ?>
    <title>Zokubird Connexion</title>
</head>
<body class="">
    <?php require '../../includes/header_editeur.php' ?>
     <section class="d-flex justify-content-center">
        <h2>Echecs de réponse Zokubird (<?php echo $nbr; ?>)</h2>
     </section>
     <section class="mt-3 container mb-5">
        <table class="table table-striped border-dark table-sm">
            <thead class="bg-zokubird">
                <tr class="">
                <th scope="col"></th>
                <th scope="col">Questions</th>
                <th scope="col">IP</th>
                <th scope="col">Action</th>
                <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($zbird  as $e) {$i++?>
                <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td><?php echo $e->questionEchec; ?></td>
                    <td><?php echo $e->ipEchec; ?></td>
                    <td><?php echo $result = ( $e->statusEchec == 0) ?  '<span><a href="./redirect.php?intellect='.$e->idEchec.'" target="_blank" >Ajouté</a></span>' :  'Déjà ajouter' ; ?></td>
                    <td class=""><?php echo $e->create_at; ?></td>
                </tr>
                <?php }?>

            </tbody>
        </table>
        <div class="row d-flex justify-content-center align-items-center">
            <nav aria-label="Page navigation example  ">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                    <a class="page-link text-zokubird" href="#" tabindex="-1" aria-disabled="true">Previous</a>
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
       <!-- footer-->
       <?php require '../../includes/footer.php' ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>