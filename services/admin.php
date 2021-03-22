<?php
    // var_dump($_POST);
    require "../database/database.php";
    session_start();
    /**
     * creation d'editeur et de superviseur
     */
    if(!empty($_POST['fullNames'])){
        //préparer les paramètres sql et bind de l'utilisateur
        $user = $db->prepare("INSERT INTO users(fullNamesUser, emailUser, phoneUser, passwordUser, roleUser, parentUser) VALUES (:fullName, :email, :phone,  :password, :role, :parentUser)");

        $user->bindParam(':fullName', $fullName);
        $user->bindParam('email', $email);
        $user->bindParam(':phone', $phone);
        $user->bindParam(':password', $password);
        $user->bindParam(':role', $role);
        $user->bindParam(':parentUser', $parent);

        $fullName = strip_tags($_POST['fullNames']);
        $email    = strip_tags($_POST['email']);
        $phone    = strip_tags($_POST['phone']);
        $password = password_hash('admin', PASSWORD_DEFAULT);
        $role     = strip_tags($_POST['role']);
        $parent   = $_SESSION['idUser'];
        
        // Creation de l'utilisateur
        $insertUser = $user->execute();
        if ($insertUser) {
            $activite = $db->prepare("INSERT INTO activities(authorActivity, actionActivity, descActivity, page) VALUE(:authorActivity, :actionActivity, :descActivity, :page)");
            $activite->bindParam(':authorActivity', $author);
            $activite->bindParam(':actionActivity', $action); 
            $activite->bindParam(':page',  $_SESSION['numPage'] );
            $activite->bindParam(':descActivity', $desc);
            // permet de recuperer qui fait l'action et son role
            $author = $_SESSION['role'] .": ".$_SESSION['fullNames'];
            $action ="Ajout utilisateur";
            $desc =  $fullName.": ".$role;
            //rechercher id du dernier utilisateur creer
            $insertActivite = $activite->execute();
            if ($insertActivite) {
                $answer = 'success';
            }else{
                $answer = 'echec';
            }
        }else {
            $answer = 'echec';
        }

        $output=array('result'=>$answer );
        echo json_encode($output);
    }
    /**
     * recuperation d'identifiant pour modification
     */
    if (!empty($_POST['identifiant'])) {
        $id = $_POST['identifiant'];
        $users =  $db->prepare("SELECT * FROM users WHERE idUser='$id'");
        $users ->execute();
        $user = $users->fetch(PDO::FETCH_OBJ);
        $output=array('id'=>$user->idUser, 'fullNames'=>$user->fullNamesUser, 'email'=>$user->emailUser, 'phone'=>$user->phoneUser, 'role'=>$user->roleUser,  'status' =>$user->statusUser);
        echo json_encode($output);
    }

    /**
     * update d'autorisation d'utilisateur
     */
    if (!empty($_POST['editIdUser'])) {
        $user =  $db->prepare("UPDATE users SET statusUser=:status, roleUser=:roles WHERE idUser=:id");

        $user->bindParam(':status', $status);
        $user->bindParam(':roles',$role);
        $user->bindParam(':id', $id);

        $status = $_POST['status'];
        $role   = $_POST['role'];
        $id     = $_POST['editIdUser'];
        $fullName     = $_POST['fullname'];

        if ($user->execute()) {
            $activite = $db->prepare("INSERT INTO activities(authorActivity, actionActivity, descActivity, page) VALUE(:authorActivity, :actionActivity, :descActivity, :page)");
            $activite->bindParam(':authorActivity', $author);
            $activite->bindParam(':actionActivity',  $action); 
            $activite->bindParam(':page',  $_SESSION['numPage'] );
            $activite->bindParam(':descActivity', $desc);
            // permet de recuperer qui fait l'action et son role
            $author = $_SESSION['role'] .": ".$_SESSION['fullNames']; 
            // Description de l'action mener
            $action ="Modification autorisation";
            $desc = $fullName .": ".$role;
            if ($status == 1 ) {
                $desc = "Bloquer ".$desc;
            }else {
                $desc = "Debloquer ".$desc;
            }
            $insertActivite = $activite->execute();
            if ($insertActivite) {
                $answer = 'E-success';
            }else{
                $answer = 'E-echec';
            }
        }else{
            $answer = 'E-echec';
        }
        $output=array('result'=>$answer );
        echo json_encode($output);
    }
    /**
     * modification, information de la page
     */
    if (!empty($_POST['emailpage'])) {
            $id = $_SESSION['numPage'];
            $page = $db->prepare("UPDATE pages SET emailPage=:email, adressPage=:adress, descPage=:descriptions, youtubePage=:youtube, facebookPage=:facebook, twitterPage=:twitter, sitePage=:sites, imgPage=:imagePage WHERE numPage=:id");
            $page->bindParam(':email',$_POST['emailpage']);
            $page->bindParam(':adress',$_POST['adress']);
            $page->bindParam(':descriptions',$_POST['description']);
            $page->bindParam(':youtube',$_POST['youtube']);
            $page->bindParam(':facebook',$_POST['facebook']);
            $page->bindParam(':twitter',$_POST['twitter']);
            $page->bindParam(':sites',$_POST['site']);
            $page->bindParam(':id', $id);


            if ($_FILES['imagePage']['error'] == 0) {
                $checkphoto = $db->prepare("SELECT imgPage FROM pages WHERE numPage= '$id'  LIMIT 1");
                $checkphoto->execute();
                $photo= $checkphoto->fetch(PDO::FETCH_OBJ);   
                $imagePath = "";
                // var_dump($photo->imgPage !== "");
                if ( $photo->imgPage !== "") {
                    $imagePath = "./../".$_SESSION['nomDossierPage']."/uploaded/".$photo->imgPage;
                    $newPhotoName=$photo->imgPage;
                }else{   
                    //recuperez l'extension de l'image
                    $extension = strtolower(pathinfo(basename($_FILES["imagePage"]["name"]),PATHINFO_EXTENSION));
                    //generation du nouveau nom de l'image
                    $newPhotoName= uniqid('pageBird_').time().'_'.rand(100,999).".".$extension;
                    //generation du chemin pour deplacer l'image
                    $imagePath = "./../".$_SESSION['nomDossierPage']."/uploaded/".$newPhotoName;
                }
                if(!move_uploaded_file($_FILES["imagePage"]["tmp_name"], $imagePath) ){
                    $newPhotoName="";
                }
            }else{
                $newPhotoName ="";
            }

            $page->bindParam(':imagePage',$newPhotoName);
            if($page->execute()){
                $answer = "P-success";
            }else{
                $answer = "P-echec";
            }
            $output=array('result'=>$answer );
            echo json_encode($output);
        }    
    /**
     * deconnection de la base de données
     */
    $db = null; 

?>