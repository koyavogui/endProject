<?php
    session_start();
    require "../database/database.php";
    // var_dump($_POST);
    $answer = $_POST['questionIntellect'];
    $remplacement = array(" ", "'", "?", "!");
    $search = str_replace($remplacement,"%",$answer);
    $numpage = $_POST['pageintellect'];
    $zbird =  $db->prepare("SELECT * FROM intellects WHERE questionsIntellect LIKE '%$search%' AND pageIntellect='$numpage'");
    $zbird ->execute();
    $zbird = $zbird->fetch(PDO::FETCH_OBJ);
    $ip = "192.02.258.15";
    $activite = $db->prepare("INSERT INTO activities(authorActivity, actionActivity, descActivity, page) VALUE(:authorActivity, :actionActivity, :descActivity, :page)");
    $activite->bindParam(':authorActivity', $author);
    $activite->bindParam(':actionActivity', $action); 
    $activite->bindParam(':page',  $numpage);
    $activite->bindParam(':descActivity', $desc);
    
    $action ="Q: ".$answer;
    $author ="Utilisateur";
    $desc = "Une réponse a été trouvée";
    if ($zbird == false) {
        $data =[
            'question'  => $answer,
            'ip'        => $ip,
            'idPage'    => $numpage 
        ];
        $sql ="INSERT INTO echecs (questionEchec, ipEchec, idPage) VALUES (:question, :ip, :idPage)";
        $echec = $db->prepare($sql)->execute($data);
        if ($echec) {
            $desc = "Aucune réponse n’a été trouvée";
            $output=array('result'=>"Je n'ai pas la reponse à cette question. Poser moi une autre question",'ressource' =>'' );
            echo json_encode($output);
        }
    } else {
        // var_dump($zbird);
        if($zbird->ressourceIntelect == ""){
            $output=array('result'=>$zbird->answersIntellect,  'ressource' =>'');
            echo json_encode($output);
        }else{
            $output=array('result'=>$zbird->answersIntellect, 'ressource' =>$zbird->ressourceIntelect);
            echo json_encode($output);
        }
    }
    $insertActivite = $activite->execute();
    if($insertActivite){
        exit();
    }
?>