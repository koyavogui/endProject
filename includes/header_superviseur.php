        <header class="d-flex mt-2 container">
            <article class="flex-grow-1">
                <img src="../../images/zbird.png" alt="logo de zokubird" srcset="" class="img-fluid" style="max-height :65px;">
            </article>
            <article class="flex-shrink-1 my-auto">
            <div class="rounded-circle" >
                    <img src="<?php echo ($_SESSION['image'] !== "") ? '../uploaded/'.$_SESSION['image'] :  '../../images/businessman.png';  ?>" class="img-fluid rounded-circle" alt="" srcset="" style="max-height :40px; max-width: 40px;" >
            </div>
            </article>
            <article class="px-3  align-items-center mt-2">
                <p>Bienvenu <br><?php echo $_SESSION['fullNames']; ?></p>
            </article>
            <article  class="fs-3">
                <a href="../../" class="text-zokubird"><i class="bi bi-box-arrow-right"></i></a>
            </article>
        </header>
            <?php
                $path_parts = pathinfo($_SERVER["REQUEST_URI"]);
                $actif = $path_parts['filename'];
                // var_dump($actif);
            ?>
        <section class="sticky-top container-fluid bg-zokubird">
            <nav class="text-center container-fluid-md d-flex flex-row justify-content-center py-2">
                <div class="col-3 "> <a href="./" class=" <?php echo $ok =  ($actif =="admin") ? 'text-actif' : 'menu-text text-dark' ; ?>">ACTIVITE</a> </div>
                <div class=" col-3   "><a href="stat.php" class="<?php echo $ok =  ($actif =="stat") ? 'text-actif' : 'menu-text text-dark' ; ?>" >STATISTIQUES</a></div>
                <div class="col-3  "><a href="./profil.php" class="<?php echo $ok =  ($actif =="profil") ? 'text-actif' : 'menu-text text-dark' ; ?>">MON PROFIL</a></div>
            </nav>
        </section>