        <header class=" d-lg-block container d-none">
            <div class="d-flex mt-2">
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
                        <a href="../../" class="text-zokubird"><i class="bi bi-door-open-fill"></i></a>
                    </div>
                </article>
            </div>
        </header>
                <?php
                    $path_parts = pathinfo($_SERVER["REQUEST_URI"]);
                    $actif = $path_parts['filename'];
                ?>
    <section class="sticky-top container-fluid bg-zokubird">
        <nav class="navbar navbar-expand-lg navbar-dark bg-zokubird py-0">
                <div class="container-fluid">
                    <a class="navbar-brand navbar-toggler border-0" data-bs-toggle="collapse" href="#"><img src="../../images/zbird-dark.png" alt="logo de zokubird" srcset="" class="img-fluid" style="max-height :40px;"></a>
                    <button class="navbar-toggler text-actif  btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="text-white navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav me-auto mb-lg-0 w-100 text-center container-fluid row justify-content-center">
                        <li class="nav-item col-md-3">
                            <a class="nav-link <?php echo $ok =  ($actif =="admin") ? 'text-actif' : 'menu-text text-dark' ; ?>" href="./">Votre page</a>
                        </li>
                        <li class="nav-item col-md-3">
                            <a class="nav-link <?php echo $ok =  ($actif =="gestion-user") ? 'text-actif' : 'menu-text text-dark' ; ?>" href="./gestion-user.php">Gestion des utilisateurs</a>
                        </li>
                        <li class="nav-item col-md-3">
                            <a class="nav-link <?php echo $ok =  ($actif =="profil") ? 'text-actif' : 'menu-text text-dark' ; ?>" href="./profil.php" tabindex="-1" aria-disabled="true">Profil</a>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>
    </section>
  