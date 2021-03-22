<?php
/**
 *  recuperation de la bd
 */

    require "../database/database.php";
    session_start();
    /**
     *  Verification des variables
     *  Creation de la page sans l'identifiant de l'user
     *  Création de l'utilisation avec l'identifiant de la page creer
     *  Mise à jour de la page en ajoutant l'identifiant de l'utilisateur qui a crée la page.
     */
    // var_dump($_POST);

         // Creation de l'utilisateur 
         if (!empty(@$_POST['password_verify']) AND !empty(@$_POST['email']) AND !empty(@$_POST['fullNames']) AND !empty(@$_POST['pageName']) ) {
            //préparer les paramètres sql et bind de l'utilisateur
           $user = $db->prepare("INSERT INTO users(fullNamesUser, emailUser, phoneUser, passwordUser, roleUser) VALUES (:fullName, :email, :phone, :password, :role)");
           
           $user->bindParam(':fullName', $fullName);
           $user->bindParam('email', $email);
           $user->bindParam(':phone', $phone);
           $user->bindParam(':password', $password);
           $user->bindParam(':role', $role);
           
           $fullName = strip_tags($_POST['fullNames']);
           $email    = strip_tags($_POST['email']);
           $phone    = strip_tags($_POST['phone']);
           $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
           $role     = 'Administrateur';
           
           
           // Creation de la page
           $insertUser = $user->execute();
           if (@$insertUser) {
               // recuperation de l'id de l'utilisateur
               
               $User =  $db->prepare("SELECT idUser FROM users WHERE emailUser='$email'");
               $User ->execute();
               $idUser = $User->fetch(PDO::FETCH_OBJ);
               //préparer les paramètres sql et bind de la page
               $page = $db->prepare("INSERT INTO pages(nomPage, userPage, countriePage, cityPage, adressPage, nomDossierPage) VALUES (:nomPage, :idUser, :countrie, :city, :adress, :nomdossier)");
               
               $page -> bindParam(':nomPage',$nomDossier);
               $page -> bindParam(':idUser',$idUser->idUser);
               $page -> bindParam(':countrie', $countrie);
               $page -> bindParam(':city', $city);
               $page -> bindParam(':adress', $adress);
               $page -> bindParam(':nomdossier', $nomDossier);
               
               $nomDossier     = strip_tags($_POST['pageName']);
               $countrie    = strip_tags($_POST['countrie']);
               $city        = strip_tags($_POST['city']);
               $adress      = strip_tags($_POST['adress']);
               $nomDossier  = $_POST['nomdossier'];
               //création de la page
               $insertPage  = $page->execute();
               
               if (@$insertPage) {
                   
                   /**
                    * Creation du dossier lier à la page 
                    *  mettre le nom en miniscule ligne
                    *  suprimer les espaces du nom
                    *  creer le dossier avec le nom de la page pui les sous dossier
                    *  Copier les fichiers pour les visiteurs et l'administrateur.  
                    *  */ 
                   $dir = '../';   
                   $admin = $dir.$nomDossier.'/admin/';
                   $uploaded = $dir.$nomDossier.'/uploaded/';
                   if (mkdir($admin, 0777, true) && mkdir($uploaded, 0777, true))  {
                       
                       /**
                        * copie du contenue du dossier model
                        */
                       $file = $dir.'models/index.php';
                       $newfile = $dir.$nomDossier.'/index.php';
                       if (!copy($file, $newfile)) {
                           echo "La copie $file du fichier a échoué...\n";
                       }
                       
                    //    $file = $dir.'models/login.php';
                    //    $newfile = $dir.$nomDossier.'/login.php';
                    //    if (!copy($file, $newfile)){
                    //        echo "La copie $file du fichier a échoué...\n";
                    //    }
                       
                       $zip = new ZipArchive;
                       $res = $zip->open('../models/admin.zip');
                       if ($res === TRUE) {
                           $zip->extractTo($dir.$nomDossier);
                           $zip->close();
                       } else {
                           echo 'échec, code:' . $res;
                       }
                    //    $zip = new ZipArchive;
                    //    $res = $zip->open('../models/superviseur.zip');
                    //    if ($res === TRUE) {
                    //        $zip->extractTo($dir.$nomDossier);
                    //        $zip->close();
                    //    } else {
                    //        echo 'échec, code:' . $res;
                    //    }
                    //    $zip = new ZipArchive;
                    //    $res = $zip->open('../models/editeur.zip');
                    //    if ($res === TRUE) {
                    //        $zip->extractTo($dir.$nomDossier);
                    //        $zip->close();
                    //    } else {
                    //        echo 'échec, code:' . $res;
                    //    }
                    //    $zip = new ZipArchive;
                    //    $res = $zip->open('../models/traitements.zip');
                    //    if ($res === TRUE) {
                    //        $zip->extractTo($dir.$nomDossier);
                    //        $zip->close();
                    //    } else {
                    //        echo 'échec, code:' . $res;
                    //    }
                    //    $zip = new ZipArchive;
                    //    $res = $zip->open('../models/js.zip');
                    //    if ($res === TRUE) {
                    //        $zip->extractTo($dir.$nomDossier);
                    //        $zip->close();
                    //    } else {
                    //        echo 'échec, code:' . $res;
                    //    }
                   }else{
                       die('Echec lors de la création des répertoires...');
                   }
                   
                   
                   /**
                    * Enregistrement de l'action qui vient d'etre realiser
                    */
                   $activity = $db->prepare("INSERT INTO activities(authorActivity, actionActivity, descActivity) VALUES (:author, :actions, :descriptions)");
                   
                   $activity->bindParam(':author',$idUser->idUser);
                   $activity->bindValue(':actions',"Enregistrement");
                   $activity->bindValue(':descriptions',"Création compte adminitration et enregistrement de page");
                   
                   //enregistrement de l'activité
                   $insertActivity = $activity ->execute();
                   
                   /**
                    * Preparation de la session pour acceder au menu admin de la page
                    */
                   $check = $db->prepare("SELECT * FROM users, pages WHERE idUser=:iduser AND userPage=:iduser LIMIT 1");
                   $check->bindParam(':iduser', $idUser->idUser);
                   $check ->execute();
                   $userActif= $check->fetch(PDO::FETCH_OBJ);
                   $_SESSION['idUser']    = $userActif->idUser;
                   $_SESSION['password']  = $userActif->passwordUser;
                   $_SESSION['fullNames'] = $userActif->fullNamesUser;
                   $_SESSION['role']      = $userActif->roleUser; 
                   $_SESSION['numPage']   = $userActif->numPage;
                   $_SESSION['nomPage']   = $userActif->nomPage;
                   $_SESSION['path_deux'] = '../../modules/';
                   $_SESSION['path_un']   = '../modules/';
                   
                   /**
                    * reponse javascript pour redirection
                    */
                   $answer ="E-success";
                   $output=array('enregistrement'=>$answer,'page' => $nomDossier);
                   echo json_encode($output);
               }    
           }
       }

    /**
     * verification si l'email et le nom de la page existe dans la base de donné
     * puis verification
     */
    if(!empty($_POST['emailLogin'])){
        
        $check = $db->prepare("SELECT * FROM users, pages WHERE emailUser=:email AND (userPage=idUser OR userPage=parentUser) LIMIT 1");
        $check->bindParam(':email', $_POST['emailLogin']);
        $check->execute();
        $answer ="";
        $output=array('login'=>$answer,'role' =>'');
        if($check->rowCount() > 0){
            $userActif= $check->fetch(PDO::FETCH_OBJ);
            // var_dump(password_verify($_POST['password'], $userActif->passwordUser));
            if (password_verify($_POST['password'], $userActif->passwordUser)) {
                $answer="success";
                $_SESSION['idUser']    = $userActif->idUser;
                $_SESSION['fullNames'] = $userActif->fullNamesUser;
                $_SESSION['role']      = $userActif->roleUser; 
                $_SESSION['numPage']  = $userActif->numPage;
                $_SESSION['nomPage']  = $userActif->nomPage;
                $_SESSION['image']  = $userActif->imageUser;
                $_SESSION['nomDossierPage']  = $userActif->nomDossierPage;
                $answer="S-success";
                $output=array('login'=>$answer,'role' =>$_SESSION['role'], 'folder' => $userActif->nomDossierPage, 'status' => $userActif->statusUser);
            }else{
                $answer ="S-echec";
                $output=array('login'=>$answer,'role' =>'');
            }
        }
        echo json_encode($output);
         
    }

    /**
     * Requette pour recuperer toute les villes selon l'identifiant du pays passer en paramètre
     * affichage dans des options. pour être lisible par le navigateur.
     */
    if (isset($_POST['cities'])) {
        @$idVille= strip_tags($_POST['cities']);                    
        @$recupVille= $db->prepare("SELECT * FROM  ville WHERE idPays=? ORDER BY nomVille");
        @$villeTotal=$recupVille->execute([$idVille]);
        $nombreligne = $recupVille->rowCount(); //verifier si l'on trouve une valeur après la requette  
        if ($nombreligne>0) {
            echo '<option value=""> -- Choisir une ville --<option>';
            foreach($recupVille as $ville)
            {
                echo '<option value="'.$ville['idVille'] .'">'.$ville['nomVille'] .'</option>';
            }
        }else {
            echo '<option value=""> -- Aucune ville enregistrée pour ce pays --</option>';
        }
    }

    /**
     * verification si le mail exist ou pas
     */
    if (isset($_POST['checkEmail'])) {
        $check = $db->prepare("SELECT * FROM users WHERE emailUser = :email");
        $check -> bindParam(':email', $email);
        $email = strip_tags($_POST['checkEmail']);
        $check ->execute();
        $answer = $check ->rowCount();
        $output=array('resultCheckEmail'=>$answer);
        echo json_encode($output);
    }

    /**
     * verification si le nom de la page exist ou pas
     */
    if (isset($_POST['checkPageName'])) {
        $check = $db->prepare("SELECT * FROM pages WHERE nomPage = :nompage");
        $check -> bindParam(':nompage', $nomDossier);
        $nomDossier = strip_tags($_POST['checkPageName']);
        $check ->execute();
        $answer = $check ->rowCount();
        $output=array('resultcheckPageName'=>$answer);
        echo json_encode($output);
    }
?>