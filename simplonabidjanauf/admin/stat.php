<?php
    session_start();
    if (!isset($_SESSION['idUser'] )){
        header("location:../../");
        exit();
    }
    require "../../database/database.php";
    $page  = $_SESSION['numPage'];
    $act = $db->prepare("SELECT actionActivity, COUNT(actionActivity) AS nbrSearch FROM activities WHERE authorActivity ='Utilisateur' AND  page =$page GROUP BY actionActivity ORDER BY nbrSearch desc LIMIT 10");
    $act -> execute();
    $nbr = $act->rowCount();
    $act = $act->fetchAll(PDO::FETCH_OBJ);
    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require '../../includes/head.php' ?>
    <title>Zokubird Connexion</title>
</head>
<body class="">
    <?php include "./../../includes/header_superviseur.php" ?>
    <div class="container-lg mt-3">
        <div class="row">
            <section class="col-md-7 mb-2">
                <section class="text-center text-zokubird">
                    <h2 class="first">  Graphs</h2>
                </section>
                <section class="" style="position: relative;  margin: auto;  height:60vh; width:99%">
                    <canvas id="stat" aria-label="Les 5 questions les plus posées sur votre plateforme" role="statistiques"></canvas>
                </section>
            </section>
            <section class="col-md-5">
                <section class="text-center text-zokubird">
                    <h2 class="first">Table</h2>
                </section>
                <section class="mt-3">
                    <table class="table table-striped border-dark table-sm">
                        <thead class="bg-zokubird">
                            <tr class="text-ligth">
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
    <!-- footer-->
       <footer class="bg-zokubird text-light  text-center  fixed-bottom" style="height :40px;"> Copyright@ Koya Michel</footer>
  
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="../../script/jquery.js" ></script>
    <script src="../../script/superviseur.js"></script>
    <script type="text/javascript">
              <?php
                $page  = $_SESSION['numPage'];
                $act = $db->prepare("SELECT actionActivity, COUNT(actionActivity) AS nbrSearch FROM activities WHERE authorActivity ='Utilisateur' AND  page =$page GROUP BY actionActivity ORDER BY nbrSearch desc LIMIT 10");
                $act -> execute();
                $nbr = $act->rowCount();
                $act = $act->fetchAll(PDO::FETCH_OBJ);
                $db = null;
            ?>
       

      /**
       * chartjs code
       */
        <?php
            foreach ($act as $a) {
                 $questions[] = $a->actionActivity;
                 $nombreSearch[] = $a->nbrSearch;
            }
         ?>
        var ctx = document.getElementById('stat').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'horizontalBar',

            // The data for our dataset
            data: {
                labels: [
                    <?php
                        for ($i=0; $i <$nbr  ; $i++) { 
                            if ($i !== ($nbr - 1)){
                                echo '"'.$questions[$i].'",';
                            }else{
                                echo '"'.$questions[$i].'"';
                            } 
                        }    
                    ?>
                ],
                datasets: [{
                    barPercentage: 0.5,
                    barThickness: 6,
                    maxBarThickness: 8,
                    minBarLength: 2,
                    data: [10, 20, 30, 40, 50, 60, 70]
                }],
                datasets: [{
                    label: 'nombre de questions',
                    backgroundColor: 'rgb(255, 205, 86, 0.2)',
                    borderColor: 'rgb(255, 205, 86)',
                    barPercentage: 0.2,
                    data: [
                        <?php
                             for ($i=0; $i <$nbr  ; $i++) { 
                                if ($i !== ($nbr - 1)){
                                    echo '"'.$nombreSearch[$i].'",';
                                }else{
                                    echo '"'.$nombreSearch[$i].'"';
                                } 
                            }     
                        ?>
                    ]
                }]
            },

            // Configuration options go here
            options: {
                elements : {
                    rectangle: {
                        borderWidth: 1,
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'Graphe des top 5 questions',
                    position: 'bottom'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

    </script>  
</body>
</html>