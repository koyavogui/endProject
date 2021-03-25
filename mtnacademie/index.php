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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./../styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <title>Zokubird Connexion</title>
</head>
<body class="container-fluid p-0">
        <!-- Entente-->
    <header class="bg-zokubird container-fluid mb-4 sticky-top text-end" style="height :40px;"> <a href="../" class="link-light fs-5 mr-2">Connexion / Inscription</a></header>
    <div class="container">

        <!-- Corps-->
        
        <div class="row">
            <section class="col-12 col-lg-7 my-5 ">
                <section class="row d-flex flex-column mt-5 align-items-center align-self-center ">
                    <article class="p-2">
                        <img src="./../images/zbird.png" alt="logo de zokubird" srcset="" class="img-fluid mx-auto d-block" style="max-height :30vh;">
                    </article>
                    <article class="text-center">
                        <p class="fs-3">Bonjour, posez-moi une question j’écoute !</p>
                    </article>
                    <article class="btn" style="font-size: 3em;" id="mic">
                        <i class="bi bi-mic text-zokubird" id="micListen"></i> 
                    </article>
                </section>
            </section>
            <section class="col-12 col-lg-5 mb-5">
                <input type="hidden" name="idpage" value="<?php echo @$page->numPage; ?>" id="idpage">
                <div class=" my-3">
                    <div class=""  style="" id="ressourcesImage">
                        <img src="./uploaded/<?php echo $page->imgPage; ?>" alt="image de description de l'hotel de sunshine" srcset="" class="img-fluid" style="">
                    </div>
                    <div class="ratio ratio-16x9" id="ressourceIframe">
                        <!-- <iframe src="https://www.youtube.com/embed/ogAhBq2CrvY" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                    </div>
                    <article>
                        <h2><?php echo $page->nomPage; ?></h2>
                        <strong><hr></strong>
                    </article>
                    <article>
                        <h5>Adresse</h5>
                        <p><?php echo @$page->adressPage; ?></p>
                    </article>
                    <article>
                        <h5>Email :</h5>
                        <p><?php echo $page->emailPage; ?></p>
                    </article>
                    <article>
                        <h5>Téléphone :</h5>
                        <p><?php  ?></p>
                    </article>
                    <article class="d-flex">
                        <div class="p-2">
                            <a href="<?php echo $page->sitePage; ?>" style="font-size: 2em;" target="blank" class="link-dark ml-1"><i class="bi bi-globe2"></i></a>
                        </div>
                        <div class="p-2">
                            <a href="<?php echo $page->twitterPage; ?>" style="font-size: 2em; color: #0dcaf0 !important;" target="blank" class="link-info ml-1"><i class="bi bi-twitter"></i></a>
                        </div>
                        <div class="p-2">
                            <a href="<?php echo $page->youtubePage; ?>" style="font-size: 2em;" target="blank" class="link-danger ml-1"><i class="bi bi-youtube"></i></a>
                        </div>
                        <div class="p-2">
                            <a href="<?php echo $page->facebookPage; ?>" style="font-size: 2em;" target="blank" class="link-primary "><i class="bi bi-facebook"></i></a>
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </div>
        <!-- footer-->
        <footer class="bg-zokubird text-light mt-2 text-center fixed-bottom py-2"> Copyright zokubird</footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>     
    <script src="../script/zokubird.js"></script>
</body>
</html>