<?php
    session_start();
    // var_dump($_SESSION);
    require "../database/database.php";
    
    /**
     * verification de mot de passe pour activé la mise à jour
     */
    $id=$_SESSION['idUser'];
    if (!empty($_POST['motdepasse'])) {
        $checkmpd = $db->prepare("SELECT passwordUser FROM users WHERE idUser=:user LIMIT 1");
        $checkmpd->bindParam(':user', $id);
        $checkmpd->execute();
        $answer="";
        
        $mpd = strip_tags($_POST['motdepasse']);
        $checkmpd->execute();
        $nbr = $checkmpd->rowCount();
        $result="";
        if( $nbr == 1 ){
            $userActif= $checkmpd->fetch(PDO::FETCH_OBJ);
            if(password_verify($mpd, $userActif->passwordUser)){   
                $result = 'success';
            }
        }else{
            $result = 'echec';
        }
        $output=array('result'=>$result  );
        echo json_encode($output);
    } 
    
    
    if (isset($_FILES['photoProfile'])) {
        /**
         * photo de profile
         */
        $checkphoto = $db->prepare("SELECT imageUser FROM users WHERE idUser= '$id'  LIMIT 1");
        $checkphoto->execute();
        $photo= $checkphoto->fetch(PDO::FETCH_OBJ);   
        $newPhotoProfile = $photo->imageUser;
        // var_dump($_FILES['photoProfile']['size']);
        // var_dump($_FILES['photoProfile'] );
        if ($_FILES['photoProfile']['size'] !== 0 ) {
            
            if ( $photo->imageUser !== NULL) {
                $page=$_SESSION["nomDossierPage"];
                $imagePath = "./../$page/uploaded/$photo->imageUser";
                $newPhotoProfile = $photo->imageUser;
                $_SESSION['image'] = $photo->imageUser;
            }else {
                //recuperez l'extension de l'image
                $extension = strtolower(pathinfo(basename($_FILES["photoProfile"]["name"]),PATHINFO_EXTENSION));
                //generation du nouveau nom de l'image
                $newPhotoProfile= uniqid('photodeprofile_').time().'_'.rand(100,999).".".$extension;
                //generation du chemin pour deplacer l'image
                $imagePath = "./../images/".$newPhotoProfile;
                // var_dump($imagePath);
                $_SESSION['image'] = $newPhotoProfile;
            }
            // var_dump($imagePath);
 
            if(!move_uploaded_file($_FILES["photoProfile"]["tmp_name"], $imagePath) ){
                echo $_FILES["photoProfile"]["error"];
                //deplacement de l'image
                $newPhotoProfile = $photo->imageUser;
                // var_dump( $_FILES["photoProfile"]["error"]);
            }
        }
        /**
         * stockage de données
         */
        // var_dump($_POST);
        $data = [
            'nom'               => $_POST['nom'],
            'email'             => $_POST['email'],
            'phone'             => $_POST['phone'],
            'photo'             => $newPhotoProfile,
            'id'                => $id
            ];
        /**
         * preparation de la requette de mise à jour
         */
        // //  var_dump($newPhotoProfile);
        $sql="UPDATE users SET fullNamesUser=:nom, emailUser=:email, phoneUser=:phone, imageUser=:photo WHERE idUser=:id";
        $updateprofil = $db->prepare($sql)->execute($data);
        $update = 'echec';
        if ($updateprofil) {
            $_SESSION['fullNames'] = $_POST['nom'];
            $update = 'success';
        }
        $output=array('update'=>$update  );
        echo json_encode($output);
    }
?>