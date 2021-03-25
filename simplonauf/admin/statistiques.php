<?php
    session_start();
    require "../../database/database.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require '../../includes/head.php' ?>
    <title>Zokubird Connexion</title>
</head>

<body>
    <main >
        <!-- entête et menu -->
        <?php include "./../../includes/header_superviseur.php" ?>
        <section class="text-center pt-2">
            <h2>LES ACTIVITES (10)</h2>
        </section>
        <div class="container">
            <section class="row">
                <article class="col-6">
                    <section class="text-center text-zokubird">
                        <h2>  Graphs</h2>
                    </section>
                </article>
                <article class="col-6">
                </article>
            </section>
        </div>
    </main>
            <section class="mt-3">
                <?php
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
            </section>
    <!-- footer-->
       <footer class="bg-zokubird text-light  text-center  fixed-bottom" style="height :40px;"> Copyright@ Koya Michel</footer>
  
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="../../script/jquery.js" ></script>
    <script src="../../script/superviseur.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
    <script type="text/javascript">
              <?php
                $page  = $_SESSION['numPage'];
                $act = $db->prepare("SELECT actionActivity, COUNT(actionActivity) AS nbrSearch FROM activities WHERE authorActivity ='Utilisateur' AND  page =$page GROUP BY actionActivity ORDER BY nbrSearch desc LIMIT 5");
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
                                echo '\''.$questions[$i].'\',';
                            }else{
                                echo '\''.$questions[$i].'\'';
                            } 
                        }    
                    ?>
                ],
                datasets: [{
                    backgroundColor: 'rgb(255, 205, 86, 0.5)',
                    borderColor: 'rgb(255, 205, 86)',
                    data: [
                        <?php
                             for ($i=0; $i <$nbr  ; $i++) { 
                                if ($i !== ($nbr - 1)){
                                    echo '\''.$nombreSearch[$i].'\',';
                                }else{
                                    echo '\''.$nombreSearch[$i].'\'';
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
                        borderWidth: 2,
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'Graphe des top 5 questions'
                },
                scales: {
                    xAxes: [{
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