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
                <?php
                    $path_parts = pathinfo($_SERVER["REQUEST_URI"]);
                    $actif = $path_parts['filename'];
                ?>
        <section class="sticky-top container-fluid bg-zokubird">
                <nav class=" container-fluid-md d-flex flex-row  justify-content-center py-2">
                    <div class="col-3 text-center"> 
                        <a href="./" class="<?php echo $ok =  ($actif =="admin") ? 'text-actif' : 'menu-text text-dark' ; ?>  ">Votre page</a> 
                    </div>
                    <div class="col-3 text-center">
                        <a href="./gestion-user.php" class="<?php echo $ok =  ($actif =="gestion-user") ? 'text-actif' : 'menu-text text-dark' ; ?>  ">Gestion des utilisateurs</a>
                    </div>
                    <div class="col-3 text-center">
                        <a href="./profil.php" class=" <?php echo $ok =  ($actif =="profil") ? 'text-actif' : 'menu-text text-dark' ; ?> ">Profil</a>
                    </div>
                </nav>
        </section>
  