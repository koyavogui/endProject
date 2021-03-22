<?php
    require "../database/database.php";
    session_start();

    /**
     * recuperation d'une intélligence pour modification
     */

    if (isset($_POST['idEdit'])) {
        $id= $_POST['idEdit'];
        $zbird =  $db->prepare("SELECT * FROM intellects WHERE idIntellect='$id'");
        $zbird ->execute();
        $zbird = $zbird->fetch(PDO::FETCH_OBJ);
        $output=array('id'=>$zbird->idIntellect,'question'=>$zbird->questionsIntellect,'reponse'=>$zbird->answersIntellect,'image'=>$zbird->imageIntellect,'ressource'=>$zbird->ressourceIntelect);
        echo json_encode($output);   
        exit();

    }

    /**
     * Suppression d'une intélligence
     */

    if (isset($_POST['idDelete']) && $_POST['idDelete'] !== "") {
        try {
            $id=$_POST['idDelete'];
            $idechec = $db->prepare( "SELECT statusEchec FROM intellects WHERE  idIntellect=$id");
            $idechec->execute();
            $idechec = $idechec->fetch(PDO::FETCH_OBJ);
            if ($idechec->statusEchec !== '0' ) {
                $echec = $db->prepare("UPDATE echecs SET statusEchec=0 WHERE idEchec=$idechec->statusEchec");
                if($echec->execute()){
                    $del = $db->prepare("DELETE FROM intellects WHERE idIntellect=$id");
                    if ($del->execute() ) {
                        $output = array('reponse'=>"success");
                        echo json_encode($output); 
                    }else{
                        $output = array('reponse'=>"echec");
                        echo json_encode($output); 
                    }
                }else {
                    $output = array('reponse'=>"echec");
                    echo json_encode($output); 
                }
            }
          } catch(PDOException $e) {
            $output = array('reponse'=>$e);
            echo json_encode($output);
          }
        exit();
    }

    /**
     * Enregistrement d'une intelligence
     */

    if (isset($_POST['question'])) {
        $intellect = $db->prepare("INSERT INTO intellects(questionsIntellect, answersIntellect, imageIntellect, ressourceIntelect, userIntellect, pageIntellect, statusEchec, create_at) VALUES (:question,:answers,:ressources, :images,:user,:pages, :echec, :dates)");
        $intellect->bindParam(':question',$question);
        $intellect->bindParam(':answers',$answers);
        $intellect->bindParam(':ressources',$ressources);
        $intellect->bindParam(':images',$image);
        $intellect->bindParam(':user',$user);
        $intellect->bindParam(':pages',$page);
        $intellect->bindParam(':dates',$dates);
        $intellect->bindParam(':echec',$echec);
        $echec = (!empty($_POST['idEchec'])) ? $_POST['idEchec']  : 0 ;
        $question   = $_POST['question'];
        $answers    = $_POST['answers'];
        $user       = $_SESSION['idUser'];
        $page       = $_SESSION['numPage']; 
        $dates      = date("Y-m-d H:m:s");
        $ressources = htmlentities($_POST['youtube']);
        $image = '';
        $answer="";
        if (($_FILES['imageQuestion']["error"]) == 0) {
            //recuperez l'extension de l'image
            $extension = strtolower(pathinfo(basename($_FILES["imageQuestion"]["name"]),PATHINFO_EXTENSION));
            //generation du nouveau nom de l'image
            $newPhotoName= uniqid('mind_').time().'_'.rand(100,999).".".$extension;
            //generation du chemin pour deplacer l'image
            $imagePath ="../".$_SESSION['nomDossierPage']."/uploaded/".$newPhotoName;
            $image = $newPhotoName;
            if (!move_uploaded_file($_FILES["imageQuestion"]["tmp_name"], $imagePath)) {
                exit();
            }
        }
        // Enregistrement de l'intelligence
        $insertIntellect = $intellect->execute();
        if ($insertIntellect){
            $activite = $db->prepare("INSERT INTO activities(authorActivity, actionActivity, descActivity, page) VALUE(:authorActivity, :actionActivity, :descActivity, :page)");
            $activite->bindParam(':authorActivity', $author);
            $activite->bindParam(':actionActivity', $action); 
            $activite->bindParam(':page',  $_SESSION['numPage'] );
            $activite->bindParam(':descActivity', $desc);

            $action ="Ajout d'intélligence";

            if (!empty($_POST['idEchec'])) {
                $id = $_POST['idEchec'];
                $echec = $db->prepare("UPDATE echecs SET statusEchec=1 WHERE idEchec=$id");
                $echec->execute();
                $action ="Enregistrement d'une intélligence non trouvé";
            }

            // permet de recuperer qui fait l'action et son role
            $author = $_SESSION['role'] .": ".$_SESSION['fullNames'];
            $desc =  "Q: ".$question.", R: ".$answers;
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
            $output=array('result'=>"success");
            echo json_encode($output);
        exit();
    }

    /**
     * Modification d'une intélligence
     */

    if (isset($_POST['id'])) {
        
        $intellect = $db->prepare("UPDATE intellects SET questionsIntellect=:question, answersIntellect=:answers, imageIntellect=:images, ressourceIntelect=:ressources WHERE idIntellect=:id");
        
        $intellect->bindParam(':question',$question);
        $intellect->bindParam(':answers',$answers);
        $intellect->bindParam(':ressources',$ressources);
        $intellect->bindParam(':images',$image);
        $intellect->bindParam(':id',$id);
    
        
        $question   = $_POST['editQuestion'];
        $answers    = $_POST['editAnswers'];
        $id         = $_POST['id'];
        $ressources = htmlentities($_POST['youtube']);
        $image = '';
        if (($_FILES['editImageQuestion']["error"]) == 0) {
            //recuperez l'extension de l'image
            $extension = strtolower(pathinfo(basename($_FILES["editImageQuestion"]["name"]),PATHINFO_EXTENSION));
            //generation du nouveau nom de l'image
            $newPhotoName= uniqid('mind_').time().'_'.rand(100,999).".".$extension;
            //generation du chemin pour deplacer l'image
            $imagePath ="../image/ressources/".$newPhotoName;
            $image = $newPhotoName;
            if (!move_uploaded_file($_FILES["editImageQuestion"]["tmp_name"], $imagePath)) {
                $output=array('editResult'=>"echec");
                echo json_encode($output); 
                exit();
            }
        }
        if ($intellect->execute()) {
            $activite = $db->prepare("INSERT INTO activities(authorActivity, actionActivity, descActivity, page) VALUE(:authorActivity, :actionActivity, :descActivity, :page)");
            $activite->bindParam(':authorActivity', $author);
            $activite->bindParam(':actionActivity', $action); 
            $activite->bindParam(':page',  $_SESSION['numPage'] );
            $activite->bindParam(':descActivity', $desc);

            $action ="Modification d'intélligence";
            // permet de recuperer qui fait l'action et son role
            $author = $_SESSION['role'] .": ".$_SESSION['fullNames'];
            $desc =  "Q: ".$question.", R: ".$answers;
            //rechercher id du dernier utilisateur creer
            $insertActivite = $activite->execute();
            if ($insertActivite) {
                $output=array('editResult'=>"success");
                echo json_encode($output); 
            }
        }
        exit();
    }
    $db = null;
    ?>