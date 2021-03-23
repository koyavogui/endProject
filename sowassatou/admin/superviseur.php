
<section class="container-lg">
    <section class="py-2 d-flex justify-content-center">
        <?php
            require "../../database/database.php";
            @session_start();
            $page  = $_SESSION['numPage'];
            $act = $db->prepare("SELECT * FROM activities WHERE page =$page ORDER BY create_at DESC");
            $act -> execute();
            $nbr = $act->rowCount();
            $act = $act->fetchAll(PDO::FETCH_OBJ);
            $adminNbr = $db->query("SELECT COUNT(*) as nbrUser FROM activities WHERE authorActivity != 'Utilisateur' AND page =$page");
            $nbrAdmin = $adminNbr->fetch(PDO::FETCH_OBJ);
            $db = null;
            $nombredepage = intdiv($nbr,15);
            $reste = $nbr%15;
            if ($reste !=0 ) {
                ++$nombredepage;
            }

        ?>
        <div class="my-2 px-3 ">
            <h2 class="first">LES ACTIVITES</h2>
        </div>
    </section>
    <section class="mx-5 px-5 row d-flex justify-content-between">
        <div class="col-md-4 my-2">
            <div class="position-relative">
                <a href="./" class="btn btn-zokubird container-fluid  rounded-0 ">Toutes les Activités 
                </a>
                <div class="position-absolute top-0 start-100 translate-middle badge bg-zokubird" ><?php echo $t = ($nbr>=100)? '+99' : $nbr; ?> <span class="visually-hidden">unread messages</span></div>
            </div>
        </div>
        <div class="col-md-4 my-2">
            <div class="position-relative">
                <a href="#" class="btn btn-zokubird  container-fluid rounded-0" id="admin">Administration</a>
                <div class="position-absolute top-0 start-100 translate-middle badge bg-zokubird" > <?php echo $t = ($nbrAdmin->nbrUser>=100)? '+99' : $nbrAdmin->nbrUser; ?><span class="visually-hidden">unread messages</span></div>
            </div>
        </div>
        <div class="col-md-4 my-2">
            <div class="position-relative">
                <a href="#" class="container-fluid btn btn-zokubird  rounded-0" id="user">Utilisateur</a>
                <div class="position-absolute top-0 start-100 translate-middle badge bg-zokubird" ><?php echo $t = ($nbr-$nbrAdmin->nbrUser >=100)? '+99' : $nbr-$nbrAdmin->nbrUser ; ?> <span class="visually-hidden">unread messages</span></div>
            </div>
        </div>
    </section>
    <section class="mt-3 mb-5" id="table">
        <table class="table  border-dark table-sm">
            <thead class="bg-zokubird">
                <tr class="">
                <th scope="col">Auteur</th>
                <th scope="col">Actions</th>
                <th scope="col">Description</th>
                <th></th>
                <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($act as $key =>$a) {
                    if ($key < 15) {
            ?>
            <tr class="<?php if ($a->authorActivity === 'Utilisateur') {
                            echo 'userRow';
                        }else{
                            echo 'adminRow'; 
                        } ?>">
                <td>
                    <?php
                            echo $a->authorActivity; 
                    ?>
                </td>
                <td><?php echo $a->actionActivity ?></td>
                <td><?php echo $a->descActivity ?></td>
                <td></td>
                <td class=""><?php echo date_format(date_create($a->create_at), "d/m/y") ?></td>
            </tr>
            <?php
                }
            }
            ?>
            </tbody>
        </table>
        <?php    
            echo '<nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">';
            $page = 1 ;
            if($page == 1) {
                echo'<li class="page-item disabled"><span class="page-link border-0"><i class="bi bi-caret-left-fill"></i></span></li>'; 
            }else{
                echo'<li class="page-item" id="'. ($page - 1 ).'" onclick="pagination(this.id, \'superviseur\')"><span class="page-link border-0"><i class="bi bi-caret-left-fill"></i></span></li>'; 
            }

            echo'<li class="page-item" id="pageActuel" data-page='. $page .'><span class="page-link border-0 text-secondary">'.$page.' sur '.$nombredepage.'</span></li>';
            
            if($page == 7) {
                echo'<li class="page-item disabled"><span class="page-link border-0"><i class="bi bi-caret-right-fill"></i></span></li>';
            }else{
                echo'<li class="page-item" id="'. $page + 1 .'" onclick="pagination(this.id, \'superviseur\')"><span class="page-link border-0"><i class="bi bi-caret-right-fill"></i></span></li>';
            }
            echo '</ul>
          </nav>';
        ?>
     </section>
</section>
