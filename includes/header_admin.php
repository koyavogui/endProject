<div class="container-fluid p-0">
        <header class="d-flex mt-2 container">
            <article class="flex-grow-1">
                <img src="../../images/zbird.png" alt="logo de zokubird" srcset="" class="img-fluid" style="max-height :65px;">
            </article>
            <article class=" d-flex  align-items-center justify-content-around flex-shrink-1 my-auto ">
                <div class="rounded-circle" >
                        <img src="<?php echo ($_SESSION['image'] !== "") ? '../uploaded/'.$_SESSION['image'] :  '../../images/businessman.png';  ?>" class="img-fluid rounded-circle" alt="" srcset="" style="max-height :40px; max-width: 40px;" >
                </div>
                <div class="px-3  align-items-center mt-2">
                    <p class="">Bienvenu <br> <?php echo $_SESSION['fullNames']; ?></p>
                </div>
                <div class="fs-3">
                    <a href="../../" class="text-zokubird"><i class="bi bi-box-arrow-right"></i></a>
                </div>
            </article>
        </header>
        <section class="sticky-top">
                <?php
                    $path_parts = pathinfo($_SERVER["REQUEST_URI"]);
                    $actif = $path_parts['filename'];
                ?>
                <nav class="container-fluid bg-zokubird d-flex flex-row bd-highlight justify-content-center">
                    <div class="px-2 py-3 bd-highlight <?php echo $ok =  ($actif =="admin") ? 'zbird-actif' : 'zbird-menu' ; ?>  "> <a href="./" class="<?php echo $ok =  ($actif =="admin") ? 'text-zokubird' : 'text-light' ; ?>">VOTRE PAGE</a> </div>
                    <div class="px-2 py-3 bd-highlight border-left border-light  <?php echo $ok =  ($actif =="gestion-user") ? 'zbird-actif' : 'zbird-menu' ; ?>"><a href="./gestion-user.php" class="<?php echo $ok =  ($actif =="gestion-user") ? 'text-zokubird' : 'text-light' ; ?>">GESTION UTILISATEURS</a></div>
                    <div class="px-2 py-3 bd-highlight border-left border-light <?php echo $ok =  ($actif =="profil") ? 'zbird-actif' : 'zbird-menu' ; ?>"><a href="./profil.php" class=" <?php echo $ok =  ($actif =="profil") ? 'text-zokubird' : 'text-light' ; ?>">Profil</a></div>
                </nav>
        </section>
</div>
  