<?php
        session_start();
        $cle = $_POST["page"];
        require "./../database/database.php";
        $page = $_SESSION['numPage'];
        $zbird =  $db->prepare("SELECT * FROM intellects WHERE pageIntellect='$page' ORDER BY create_at ASC");
        $zbird ->execute();
        $nbr = $zbird->rowCount();
        $zbird = $zbird->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        $i = 0;
        unset($_SESSION['idEChec']);
        $nombredepage = intdiv($nbr,5);
        $reste = $nbr%5;
        if ($reste !=0 ) {
            ++$nombredepage;
        }
        echo'<table class="table table-striped border-dark table-sm">
        <thead class="bg-zokubird">
            <tr class="">
            <th scope="col"></th>
            <th scope="col">Questions</th>
            <th scope="col">Réponses</th>
            <th scope="col">Images/vidéos</th>
            <th scope="col" colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody id="tbody">';
        foreach ($zbird as $key => $mind) {  if ($key >= 5*($cle-1) &&  $key < 5*($cle)) {
            $key++ ;
            echo'
            <tr>
                <th scope="row">';
                echo $key ; 
                echo'</th>
                <td>';
                echo $mind->questionsIntellect; 
                echo'</td>
                <td>';
                echo $mind->answersIntellect; 
                echo'</td>
                <td><a href="">ressource</a></td>
                <td class="text-center"><a class="text-success" data-bs-toggle="modal" data-bs-target="#editModal"  data-bs-id="';
                echo $mind->idIntellect; 
                echo'"><i class="bi bi-pencil-square"></i></a></td>
                <td class=""><a class="text-danger" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal"  data-bs-delete-="';
                echo $mind->idIntellect; 
                echo'"><i class="bi bi-trash"></i></a></td>
            </tr>'; 
            }
        }
        echo'
        </tbody>
    </table>
    <div class="row d-flex justify-content-center align-items-center">';   
                echo '<nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">';
                $cle = 1 ;
                if($cle == 1) {
                    echo'<li class="page-item disabled"><span class="page-link border-0"><i class="bi bi-caret-left-fill"></i></span></li>'; 
                }else{
                    echo'<li class="page-item" id="'. ($cle - 1 ).'" onclick="pagination(this.id, \'pagination_intellect\')"><span class="page-link border-0"><i class="bi bi-caret-left-fill"></i></span></li>'; 
                }

                echo'<li class="page-item" id="pageActuel" data-page='. $cle .'><span class="page-link border-0 text-secondary">'.$cle.' sur '.$nombredepage.'</span></li>';
                
                if($cle == $nombredepage) {
                    echo'<li class="page-item disabled"><span class="page-link border-0"><i class="bi bi-caret-right-fill"></i></span></li>';
                }else{
                    echo'<li class="page-item" id="'. $cle + 1 .'" onclick="pagination(this.id, \'pagination_intellect\')"><span class="page-link border-0"><i class="bi bi-caret-right-fill"></i></span></li>';
                }
                echo '</ul>
            </nav>';
        
            echo'
    </div>';

?>