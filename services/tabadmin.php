<?php
    $cle = $_POST["page"];
    require "../database/database.php";
            @session_start();
            $page  = $_SESSION['numPage'];
            $act = $db->prepare("SELECT * FROM activities WHERE  authorActivity !='Utilisateur' AND page=$page ORDER BY create_at DESC");
            $act -> execute();
            $nbr = $act->rowCount();
            $act = $act->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            $nombredepage = intdiv($nbr,15);
            $reste = $nbr%15;
            if ($reste !=0 ) {
                ++$nombredepage;
            }
            echo '<table class="table border-dark table-sm">
            <thead class="bg-zokubird">
                <tr class="">
                <th scope="col">Auteur</th>
                <th scope="col">Actions</th>
                <th scope="col">Description</th>
                <th></th>
                <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>';
             
                foreach ($act as $key =>$a) {
                    if ($key >= 15*($cle-1) &&  $key < 15*($cle)) {
            
                echo'<tr class="';
                  echo'"><td>';
                  
                  echo $a->authorActivity; 
                  
                  echo'</td>
                  <td>';  
                  echo $a->actionActivity;
                  echo '</td>
                  <td>';
                  echo $a->descActivity ;
                  echo '</td>
                  <td></td>
                  <td class="">';
                  echo date_format(date_create($a->create_at), "d/m/y"); 
                  echo '</td>';
                  echo'</tr>';
                }
            }
            echo '</tbody>
        </table>';
            
            echo '<nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">';
            if($cle == 1) {
                echo'<li class="page-item disabled"><span class="page-link border-0"><i class="bi bi-caret-left-fill"></i></span></li>'; 
            }else{
                echo'<li class="page-item" id="'. $cle - 1 .'" onclick="pagination(this.id , \'tabadmin\')"><span class="page-link border-0"><i class="bi bi-caret-left-fill"></i></span></li>'; 
            }

            echo'<li class="page-item" id="pageActuel" data-page='.$cle.'><span class="page-link border-0 text-secondary">'.$cle.' sur '.$nombredepage.'</span></li>';
            
            if($cle == $nombredepage) {
                echo'<li class="page-item disabled"><span class="page-link border-0"><i class="bi bi-caret-right-fill"></i></span></li>';
            }else{
                echo'<li class="page-item" id="'. $cle+ 1 .'" onclick="pagination(this.id , \'tabadmin\')"><span class="page-link border-0"><i class="bi bi-caret-right-fill"></i></span></li>';
            }
            echo '</ul>
          </nav>';
?>