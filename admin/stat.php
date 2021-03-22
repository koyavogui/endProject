<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require '../../includes/head.php' ?>
    <title>Zokubird Connexion</title>
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
    <div class="">
     <section class="d-flex justify-content-center">
        <h2>LES ACTIVITES (10)</h2>
     </section>

     <div class="row">
        <section class="col">
            <section class="d-flex text-zokubird">
            <h2>  Graphs</h2>
            </section>
            <section class="">
                <div id="top_x_div" style="width: 900px; height: 300px;"></div>
            </section>
        </section>
        <section class="col border-left">
            <section class="d-flex text-zokubird">
                <h2>Table</h2>
            </section>
            <section class="mt-3">
            <?php
                require "../../database/database.php";
                @session_start();
                $page  = $_SESSION['numPage'];
                $act = $db->prepare("SELECT actionActivity, COUNT(actionActivity) AS nbrSearch FROM activities WHERE authorActivity ='Utilisateur' AND  page =$page GROUP BY actionActivity ORDER BY nbrSearch desc");
                $act -> execute();
                $nbr = $act->rowCount();
                $act = $act->fetchAll(PDO::FETCH_OBJ);
                $db = null;
            ?>
                <table class="table table-striped border-dark table-sm">
                    <thead class="bg-zokubird">
                        <tr class="">
                            <th scope="col">Questions (<?php echo $nbr; ?>)</th>
                            <th scope="col">Nombres</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($act as $a) {
                    ?>
                    
                    <tr>
                        <td><?php echo $a->actionActivity; ?></td>
                        <td><a href="details.php?<?php echo $a->actionActivity; ?>" target="_blank"><?php echo $a->nbrSearch; ?></a></td>
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
            </section> 
        </section>
     </div>


</div>

<footer class="bg-zokubird text-light mt-2" style="height :40px;"> Copyright</footer>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>   

    <script src="../../script/jquery.js" ></script>
    <script src="../../script/superviseur.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
    <script type="text/javascript">
              google.charts.load('current', {'packages':['bar']});
              google.charts.setOnLoadCallback(drawStuff);
              <?php
                require "../../database/database.php";
                @session_start();
                $page  = $_SESSION['numPage'];
                $act = $db->prepare("SELECT actionActivity, COUNT(actionActivity) AS nbrSearch FROM activities WHERE authorActivity ='Utilisateur' AND  page =$page GROUP BY actionActivity ORDER BY nbrSearch desc LIMIT 5");
                $act -> execute();
                $nbr = $act->rowCount();
                $act = $act->fetchAll(PDO::FETCH_OBJ);
                $db = null;
            ?>
      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Top 5 Questions', 'nombre de fois poser'],
          <?php
            foreach ($act as $a) {
                 echo '["'.substr($a->actionActivity, 3).'", '.$a->nbrSearch.'],';
            }
          ?>
        ]);

        var options = {
          title: 'Graphe des top 5 questions',
          width: 900,
          colors: ["#ffc107"],
          legend: { position: 'none' },
          chart: { title: '',
                   subtitle: '' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Nombre de recherche'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar( document.getElementById('top_x_div') );
        chart.draw(data, options);
      };
    </script>  
</body>
</html>