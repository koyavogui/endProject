<?php
    session_start();
    $cle = $_POST["page"];
    require "./../database/database.php";
    $id       = $_SESSION['idUser'];
    $users    =  $db->prepare("SELECT * FROM users WHERE parentUser=$id");
    $users -> execute();
    $nbr      = $users->rowCount();
    $users    = $users->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    $nombredepage = intdiv($nbr,5);
    $reste = $nbr%5;
    if ($reste !=0 ) {
        ++$nombredepage;
    }
    echo '<table class="table border-dark table-sm">
            <thead class="bg-zokubird-ligth">
                <tr class="">
                    <th scope="col">Nom</th>
                    <th scope="col"></th>
                    <th scope="col">Rôle</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date d’enregistrement</th>
                    <th scope="col"> </th>
                </tr>
            </thead>
            <tbody>';
             
                foreach ($users as $key =>$user) {
                    if ($key >= 5*($cle-1) &&  $key < 5*($cle)) {
            
            echo'<tr class="';
                        
                echo'"><td>';
                echo $user->fullNamesUser; 
                echo'</td><td>';  
                echo $retVal = ( $user->statusUser) ? '<i class="bi bi-circle-fill text-danger" aria-hidden="true"> </i>'  : '<i class="bi bi-circle-fill text-success" aria-hidden="true"> </i>';  
                echo '</td>
                <td>';
                echo $user->roleUser;
                echo '</td>
                <td>';
                echo $retVal = ( $user->roleUser == "Editeur") ? 'Saisie des données (questions et réponses)'  : 'Supervise les activités de l’administration et des utilisateur';  
                echo '</td>
                <td class="">';
                echo date("d/m/Y à H:i:s", strtotime($user->create_at));
                echo '</td><td>';
                echo '<span class="btn text-zokubird " data-bs-toggle="modal" data-bs-target="#editModal" data-bs-id="'; 
                echo $user->idUser; 
                echo '"><i class="bi bi-gear-wide-connected"></i></span></td></tr>';
                }
            }
            echo '</tbody>
        </table>';
            
            echo '<nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">';
            if($cle == 1) {
                echo'<li class="page-item disabled"><span class="page-link border-0"><i class="bi bi-caret-left-fill"></i></span></li>'; 
            }else{
                echo'<li class="page-item" id="'. $cle - 1 .'" onclick="pagination(this.id , \'pagination_administrateur\')"><span class="page-link border-0"><i class="bi bi-caret-left-fill"></i></span></li>'; 
            }

            echo'<li class="page-item" id="pageActuel" data-page='.$cle.'><span class="page-link border-0 text-secondary">'.$cle.' sur '.$nombredepage.'</span></li>';
            
            if($cle == $nombredepage) {
                echo'<li class="page-item disabled"><span class="page-link border-0"><i class="bi bi-caret-right-fill"></i></span></li>';
            }else{
                echo'<li class="page-item" id="'. $cle+ 1 .'" onclick="pagination(this.id , \'pagination_administrateur\')"><span class="page-link border-0"><i class="bi bi-caret-right-fill"></i></span></li>';
            }
            echo '</ul>
          </nav>';
        
?>