<?php
    session_start();
    $cle = $_POST["page"];
    require "./../database/database.php";

    $page = $_SESSION['numPage'];
    $zbirdEchecs =  $db->prepare("SELECT * FROM echecs WHERE idPage ='$page' ORDER BY statusEchec ASC");
    $zbirdEchecs ->execute();
    $nbr = $zbirdEchecs->rowCount();
    $zbird = $zbirdEchecs->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    $i = 0;
    $nombredepage = intdiv($nbr,15);
    $reste = $nbr%15;
    if ($reste !=0 ) {
        ++$nombredepage;
    }
    echo '<table class="table table-striped border-dark table-sm">
    <thead class="bg-zokubird">
        <tr class="">
        <th scope="col"></th>
        <th scope="col">Questions</th>
        <th scope="col">IP</th>
        <th scope="col">Action</th>
        <th scope="col">Date</th>
        </tr>
    </thead>
    <tbody>';
        foreach ($zbird  as $key => $e) {
            if ($key >= 15*($cle-1) &&  $key < 15*($cle)) { 
                    $key++ ; 
            echo'
        <tr>
            <th scope="row">';
            echo $key;
            echo'</th>
            <td>';
            echo $e->questionEchec; 
            echo'</td>
            <td>';
            echo $e->ipEchec; 
            echo'</td>
            <td>';
            echo $result = ( $e->statusEchec == 0) ?  '<span><a href="./redirect.php?intellect='.$e->idEchec.'" target="_blank" >Ajouté</a></span>' :  'Déjà ajouter' ; 
            echo'</td>
            <td class="">';
            echo $e->create_at; 
            echo'</td>
        </tr>';
         }}
        echo'
    </tbody>
</table>';
echo '<div class="row d-flex justify-content-center align-items-center"><nav aria-label="Page navigation example">
<ul class="pagination justify-content-end">';
if($cle == 1) {
    echo'<li class="page-item disabled"><span class="page-link border-0"><i class="bi bi-caret-left-fill"></i></span></li>'; 
}else{
    echo'<li class="page-item" id="'. $cle - 1 .'" onclick="pagination(this.id , \'pagination_echec\')"><span class="page-link border-0"><i class="bi bi-caret-left-fill"></i></span></li>'; 
}

echo'<li class="page-item" id="pageActuel" data-page='.$cle.'><span class="page-link border-0 text-secondary">'.$cle.' sur '.$nombredepage.'</span></li>';

if($cle == $nombredepage) {
    echo'<li class="page-item disabled"><span class="page-link border-0"><i class="bi bi-caret-right-fill"></i></span></li>';
}else{
    echo'<li class="page-item" id="'. $cle+ 1 .'" onclick="pagination(this.id , \'pagination_echec\')"><span class="page-link border-0"><i class="bi bi-caret-right-fill"></i></span></li>';
}
echo '</ul>
</nav></div>';
?>