<?php
    /**
     * Recuperaption de la variable de connexion à la base de données.
     */
    session_start();
 
    $pieces = explode("/", $_SERVER['REQUEST_URI']);
    $nomPage = $pieces[2] ;
    require "../database/database.php";
    $page = $db->prepare("SELECT * FROM pages WHERE nomDossierPage=:nomPage");
    $page->bindParam(':nomPage', $nomPage);
    $page->execute();
    if ($page->rowCount() == 1) {
        $page = $page->fetch(PDO::FETCH_OBJ);
    }else {
         exit();
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" />
    <title>Zokubird Connexion</title>
</head>
<body class=container>
    <div class="container-fluid">
        <!-- Entente-->

        <header class="row bg-zokubird mb-4" style="height :60px;"></header>

        <!-- Corps-->
        
        <div class="row border">
            <section class="col-md mt-5">
                <section class="row d-flex flex-column mt-5 align-items-center align-self-cente">
                    <article class="row my-5">
                        <img src="./image/logo.png" alt="logo de zokubird" srcset="" class="img-fluid" style="height :130px;">
                    </article>
                    <article>
                        <p class="" class="display-4">Bonjour, posez-moi une question j’écoute !</p>
                    </article>
                    <article class="btn" style="font-size: 3em;" id="mic">
                        <i class="fas fa-microphone-alt text-zokubird" id="micListen"></i>
                    </article>
                </section>
            </section>
            <section class="col-md">
                <input type="hidden" name="idpage" value="<?php echo @$page->numPage; ?>" id="idpage">
                <div class=" my-3">
                     <img src="./image/page/<?php echo $page->imgPage; ?>" alt="image de description de l'hotel de sunshine" srcset="" class="img-fluid" style="">
                    <article>
                        <h2><?php echo $page->nomPage; ?></h2>
                        <strong><hr></strong>
                    </article>
                    <article>
                        <h5>Adresse</h5>
                        <p>PK14, Lagune Aby d’Assinie Mafia, Assinie Côte d'Ivoire</p>
                    </article>
                    <article>
                        <h5>Email :</h5>
                        <p><?php echo $page->emailPage; ?></p>
                    </article>
                    <article>
                        <h5>Téléphone :</h5>
                        <p><?php  ?></p>
                    </article>
                    <article>
                        <a href="<?php echo $page->facebookPage; ?>" style="font-size: 2em;" class="text-primary"><i class="fab fa-facebook-f"></i></a>
                        <a href="<?php echo $page->youtubePage; ?>" style="font-size: 2em;" class="text-danger ml-1"><i class="fab fa-youtube"></i></a>
                        <a href="<?php echo $page->twitterPage; ?>" style="font-size: 2em;" class="text-info ml-1"><i class="fab fa-twitter"></i></a>
                        <a href="<?php echo $page->twitterPage; ?>" style="font-size: 2em;" class="text-dark ml-1"><i class="fas fa-globe"></i></a>
                    </article>
                </div>
            </section>
        </div>
        <!-- footer-->
        <footer class="row bg-zokubird text-light mt-2" style="height :60px;"> Copyright</footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/js/all.min.js" integrity="sha512-LW9+kKj/cBGHqnI4ok24dUWNR/e8sUD8RLzak1mNw5Ja2JYCmTXJTF5VpgFSw+VoBfpMvPScCo2DnKTIUjrzYw==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" ></script>
    <script src="../script/zokubird.js"></script>
</body>
</html>