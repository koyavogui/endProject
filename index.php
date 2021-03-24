<?php
    /**
     * Recuperaption de la variable de connexion à la base de données.
     */
    session_start();
    if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalement, on détruit la session.
session_destroy()
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <title>Zokubird</title>
</head>
<body class="container-fluid px-0">
        <!-- Entente-->

        <header class="bg-zokubird mb-2" style="height :40px;"></header>

        <!-- Corps-->
        <div class=" container row mx-auto mb-5" id="app">
            <section class="col-12 col-lg-6  mb-2 px-2 py-5  " id="btnconnexion">
                <article class="p-2 ">
                    <img src="./images/zbird.png" alt="logo de zokubird" srcset="" class="img-fluid mx-auto d-block" style="max-height :30vh;">
                </article>
                <article>
                    <p class="text-zokubird text-center" class="display-4">Avec nous obtenez une page web qui écoute et parle à vos visiteurs.</p>
                </article>
                <article class="container-fluid">
                    <div class="btn btn-zokubird text-light container-fluid" id="locationHref">Connexion</div>
                </article>
            </section>
            <section class="col-12 col-lg-6 ">
                <section  class="row bg-zokubird text-light text-center py-2 " > <span class="text-center" id="formTitle">Creer un compte</span>  </section>
                <div class="row border border-zokubird mb-3  px-3 py-2 mt-2" id="cadre">
                    <!-- formulaire d -->                    
                    <form method="POST" class="container" id="formRegister">
                        <div class="form-group mt-2 row">
                            <div class="col-md-7 mb-2">
                                <label class="form-label text-zokubird" for="fullNames">Nom et prenoms :</label>
                                <input type="text" name="fullNames" id="fullNames" class="form-control form-control-sm rounded-0  border border-primary ">
                                <div class="invalid-feedback">
                                    Veillez saisir un nom s'il vous plait
                                </div>
                            </div>
                            <div class="col-md-5 mb-2">
                                <label class="form-label text-zokubird" for="email">Email : </label>
                                <input type="email" name="email" id="email" class="form-control form-control-sm rounded-0 border border-primary" required>
                                <div class="valid-feedback">
                                    Cet email est libre
                                </div>
                                <div class="invalid-feedback">
                                    Cet email est déjà utilisé !
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-7 mb-2">
                                <label class="form-label text-zokubird" for="phone">Téléphone :</label>
                                <input type="tel" name="phone" id="phone" class="form-control form-control-sm rounded-0 border border-primary" >
                                <div class="invalid-feedback">
                                    Veillez saisir un numéro valide
                                </div>
                            </div>
                            <div class="col-md-5 mb-2 ">
                                <label class="form-label text-zokubird" for="countrie">Pays : </label>
                                <select name="countrie" id="countrie" class="form-select form-select-sm rounded-0  border border-primary" onchange="recupVilleCombo(this.value)"> 
                                    <option value="">-- Choisir un pays --</option>
                                    <?php
                                        /**
                                         * connexion à la base données
                                         * Requette pour recuperer la liste des pays
                                         * puis affichage
                                         */
                                        require "./database/database.php";
                                        $contries = $db->query('SELECT idPays, nomPays FROM pays ORDER BY nomPays');
                                        while ($contrie = $contries->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="'.$contrie['idPays'].'">'.$contrie['nomPays'].'</option>';
                                        }
                                        $db = null;
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    Veillez choisir un pays s'il vous plait
                                </div>
                            </div>
                        </div>
                        <div class="form-group  row ">
                            <div class="col-md-7 mb-2 ">
                                <label class="form-label text-zokubird" for="city">Ville : </label>
                                <select name="city" id="city" class="form-select form-select-sm rounded-0 border border-primary">
                                    <option value="">-- Choisir une ville --</option>
                                </select>
                                <div class="invalid-feedback">
                                    Veillez choisir une ville s'il vous plait
                                </div>
                            </div>
                            <div class="col-md-5 mb-2 ">
                                <label class="form-label text-zokubird" for="adress">Adresse :</label>
                                <input type="text" name="adress" id="adress" class="form-control form-control-sm rounded-0 border border-primary">
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label text-zokubird" for="pageName">Nom de votre page</label>
                            <input type="text" name="pageName" id="pageName" class="form-control form-control-sm rounded-0 border border-primary">
                                <div class="valid-feedback">
                                    Ce nom est libre
                                </div>
                                <div class="invalid-feedback">
                                    Ce nom est déjà utilisé !
                                </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md mb-2 ">
                               <label class="form-label text-zokubird" for="password">Mot de passe</label>
                               <input type="password" name="password" id="password" class="form-control form-control-sm rounded-0 border border-primary"> 
                            </div>
                            <div class="col-md mb-2 ">
                               <label class="form-label text-zokubird" for="password_verify">Reprendre le mot de passe</label>
                               <input type="password" name="password_verify" id="password_verify" class="form-control form-control-sm rounded-0 border border-primary"> 
                            </div>
                            <input type="hidden" name="nomdossier" id="nomdossier">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input-sm" id="condition">
                            <label class="form-label text-zokubird" class="form-check-label text-zokubird" for="condition">Acceptez nos termes et conditions d’utilisation</label>
                        </div>
                        <div class="form-group row mb-3 mx-auto">
                            <button type="submit" class="mx-auto col-md-6 btn btn-zokubird text-light shadow-sm" id="btnvalidate">Valider</button>
                        </div>
                    </form>
                    <!-- formulaire de connexion au paneau administrateur -->                    
                    <form class="container" id="formSingin">
                        <div class="mb-3">
                            <label class="form-label text-zokubird" for="emailLogin" class="text-zokubird">Email : </label>
                            <input type="emailLogin" name="emailLogin" id="emailLogin" class="form-control form-control-sm rounded-0 border border-primary" required>
                            <div class="invalid-feedback">
                                <i class="bi bi-info-circle-fill"></i> impossible de trouver votre compte zokubird
                            </div>
                        </div>
                        <div class="mb-3" class="text-zokubird">
                            <label class="form-label text-zokubird" for="password">Mot de passe</label>
                            <input type="password" name="password" id="connectpassword" class="form-control form-control-sm rounded-0 border border-primary" required> 
                            <div class="invalid-feedback">
                                <i class="bi bi-info-circle-fill"></i> le mot de passe saisie est incorrect
                            </div>
                        </div>
                        <div class="mb-3 mx-auto" class="text-zokubird">
                            <button class="mx-auto container-fluid btn btn-zokubird text-light" id="MySigin">Connexion</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
        <!-- footer-->
        <?php include './includes/footer.php'?>
    <script src="script/jquery.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
    <script src="script/main.js"></script>
</body>
</html>