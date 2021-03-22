<?php
    session_start();
    $url = $_SERVER['REQUEST_URI'];
    $question = parse_url( urldecode( $url));
    $question =  $question['query'];
    require "../../database/database.php";
    $page  = $_SESSION['numPage'];

    $act = $db->prepare("SELECT actionActivity, create_at FROM activities WHERE actionActivity =:action AND page =:page ORDER BY create_at DESC");

    $act->bindParam(':action', $action);
    $act->bindParam(':page', $page);

    $action = $question;
    $act->execute();

    $nbr = $act->rowCount();
    $act = $act->fetchAll(PDO::FETCH_OBJ);
    if ($nbr == 0 ) {
        exit();
        $db = null;
    }
    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require '../../includes/head.php' ?>
    <title>Zokubird - <?php echo $_SESSION['nomPage']; ?> </title>
</head>
<body class="container-fluid">
<header class="d-flex mt-2 container">
            <article class="flex-grow-1">
                <img src="../../images/zbird.png" alt="logo de zokubird" srcset="" class="img-fluid" style="height :100px;">
            </article>
            <article class="flex-shrink-1 my-auto">
            <div class="rounded-circle" >
                    <img src="<?php echo ($_SESSION['image'] !== "") ? '../uploaded/'.$_SESSION['image'] :  '../../images/businessman.png';  ?>" class="img-fluid rounded-circle" alt="" srcset="" style="width: 65px; height: 65px;" >
            </div>
            </article>
            <article class="ml-1 my-auto">
                <p>Bienvenu <?php echo $_SESSION['fullNames']; ?></p>
                <a href="../../" class="text-zokubird"><u>Deconnexion</u></a>
            </article>
        </header>
        <section class="mt-1 row">
            <nav class="container-fluid bg-zokubird d-flex flex-row bd-highlight justify-content-center py-2">
            <div class="p-2 bd-highlight "> <a href="./" class=" text-light">ACTIVITE</a> </div>
                <div class="p-2 bd-highlight border-left border-right border-light" id="stat" ><a href="stat.php" class=" text-light" >STATISTIQUES</a></div>
                <div class="p-2 bd-highlight"><a href="./profil.php" class=" text-light">MON PROFIL</a></div>
            </nav>
        </section>
     <section class="d-flex justify-content-center">
        <h2>LES STATISTIQUES DES QUESTIONS</h2>
     </section>
     <section class="d-flex text-zokubird">
        <h2>  Détails sur la question : <?php  echo  substr($question,3) ;?> (<?php echo $nbr;?>)</h2>
     </section>
     <section class="mt-3 container">
        <table class="table table-striped border-dark table-sm">
            <thead class="bg-zokubird">
                <tr class="">
                    <th scope="col">Questions (4)</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($act as $a) {
            ?>
                <tr>
                    <td><?php echo $a->actionActivity ?></td>
                    <td><?php echo $a->create_at ?></td>
                </tr>
            <?php
                }
            ?>

             
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
     </section
       <!-- footer-->
       <footer class="row bg-zokubird text-light mt-2" style="height :60px;"> Copyright</footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh5AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>