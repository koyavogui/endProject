<?php
 
session_start();
//  function getIp()  {
//     if ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) )
//         $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
//     else
//         $ip = $_SERVER['REMOTE_ADDR'];
                
    require "./../../database/database.php";

    $page = $_SESSION['numPage'];
    $zbirdEchecs =  $db->prepare("SELECT * FROM echecs WHERE idPage ='$page' ORDER BY statusEchec ASC");
    $zbirdEchecs ->execute();
    $nbr = $zbirdEchecs->rowCount();
    $zbird = $zbirdEchecs->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    $i = 0;
    $nombredepage = intdiv($nbr,15);
    $reste = $nbr%15;
    if ($reste !=0 ) {
        ++$nombredepage;
    }
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
     <section class="d-flex justify-content-center my-3">
        <h2 class="first">Echecs de réponse Zokubird (<?php echo $nbr; ?>)</h2>
     </section>
     <section class="mt-3 container mb-3" id="table">
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
                <?php foreach ($zbird  as $key => $e) {  if ($key < 15) {$key++ ; ?>
                <tr>
                    <th scope="row"><?php echo $key ?></th>
                    <td><?php echo $e->questionEchec; ?></td>
                    <td><?php echo $e->ipEchec; ?></td>
                    <td><?php echo $result = ( $e->statusEchec == 0) ?  '<span><a href="./redirect.php?intellect='.$e->idEchec.'" target="_blank" >Ajouté</a></span>' :  'Déjà ajouter' ; ?></td>
                    <td class=""><?php echo $e->create_at; ?></td>
                </tr>
                <?php }}?>

            </tbody>
        </table>
       
        <div class="row d-flex justify-content-center align-items-center">
            <?php    
                    echo '<nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">';
                    $page = 1 ;
                    if($page == 1) {
                        echo'<li class="page-item disabled"><span class="page-link border-0"><i class="bi bi-caret-left-fill"></i></span></li>'; 
                    }else{
                        echo'<li class="page-item" id="'. ($page - 1 ).'" onclick="pagination(this.id, \'pagination_echec\')"><span class="page-link border-0"><i class="bi bi-caret-left-fill"></i></span></li>'; 
                    }

                    echo'<li class="page-item" id="pageActuel" data-page='. $page .'><span class="page-link border-0 text-secondary">'.$page.' sur '.$nombredepage.'</span></li>';
                    
                    if($page == $nombredepage) {
                        echo'<li class="page-item disabled"><span class="page-link border-0"><i class="bi bi-caret-right-fill"></i></span></li>';
                    }else{
                        echo'<li class="page-item" id="'. $page + 1 .'" onclick="pagination(this.id, \'pagination_echec\')"><span class="page-link border-0"><i class="bi bi-caret-right-fill"></i></span></li>';
                    }
                    echo '</ul>
                </nav>';
            ?>
        </div>
     </section>
       <!-- footer-->
       <?php require './../../includes/footer.php' ?>
       <script src="../../script/jquery.js" ></script>
       <script src="./../../script/editeur.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>