 
    <div class="modal " tabindex="-1" id="deleteModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header bg-danger text-ligth border-right border-danger ">
                <h5 class="modal-title text-light">Supression d'une intelligence</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Vous ête sur le point de supprimer une intelligence. Vous en êtes sure ?</p>
                <input type="hidden" name="delete" id="deleteInput">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger text-ligth" id="delete"><i class="fas fa-trash-alt"></i> Supprimer</button>
            </div>
            </div>
        </div>
    </div>
    <div class="modal" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-zokubird">
                    <h5 class="modal-title" id="exampleModalLabel">Modification </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" class="container" id="modalForm">
                        <div class="form-group">
                            <label for="editQuestion" class="text-zokubird">Les Questions: </label>
                            <textarea class="form-control border border-primary" id="editQuestion" name="editQuestion" rows="4"></textarea>
                        </div>
                            
                        <div class="form-group">
                            <label for="editAnswers" class="text-zokubird">Votre reponse : </label>
                            <textarea class="form-control border border-primary" id="editAnswers" name="editAnswers" rows="2"></textarea>
                        </div>
                        <div class="form-group container   p-0">
                            <div class="row container-fluid m-0 p-0">
                                <input type="file" name="editImageQuestion" id="editImageQuestion" class="form-control-file col-md-7" placeholder="michel">
                                <div class=" col-md-5 text-zokubird"><p>Ou votre code d’intégration YouTube ci-dessous</p></div>
                            </div>
                        </div>
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <input type="text" name="youtube" id="youtube" class="form-control form-control-lg border border-primary">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" id="editclose">Fermer</button>
                    <button type="button" class="btn btn-zokubird" id="edit"><i class="bi bi-save-fill"></i> Modifier </button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <section class="d-flex justify-content-center mt-3 mb-1">
            <?php
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
            ?>
            <h2 class="first">Intelligence Zokubird (<?php echo $nbr; ?>)</h2>
        </section>
        <section class="container">
            <a href="register.php" class="ml-3 btn btn-zokubird text-light rounded-0">Ajouter une intelligence</a>
        </section>
        <section class="mt-3 table-responsive-sm" id="table">
            <table class="table table-striped border-dark table-sm">
                <thead class="bg-zokubird">
                    <tr class="">
                    <th scope="col"></th>
                    <th scope="col">Questions</th>
                    <th scope="col">Réponses</th>
                    <th scope="col">Images/vidéos</th>
                    <th scope="col" colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                <?php foreach ($zbird as $key => $mind) {  if ($key < 5) {$key++ ;?>
                    <tr>
                        <th scope="row"><?php echo $key ?></th>
                        <td><?php echo $mind->questionsIntellect; ?></td>
                        <td><?php echo $mind->answersIntellect; ?></td>
                        <td><a href="">ressource</a></td>
                        <td class="text-center"><a class="text-success" data-bs-toggle="modal" data-bs-target="#editModal"  data-bs-id="<?php echo $mind->idIntellect; ?>"><i class="bi bi-pencil-square"></i></a></td>
                        <td class=""><a class="text-danger" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal"  data-bs-delete="<?php echo $mind->idIntellect; ?>"><i class="bi bi-trash"></i></a></td>
                    </tr> 
                <?php }}?>
                </tbody>
            </table>
            <div class="row d-flex justify-content-center align-items-center">
                <?php    
                        echo '<nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">';
                        $page = 1 ;
                        if($page == 1) {
                            echo'<li class="page-item disabled"><span class="page-link border-0"><i class="bi bi-caret-left-fill"></i></span></li>'; 
                        }else{
                            echo'<li class="page-item" id="'. ($page - 1 ).'" onclick="pagination(this.id, \'pagination_intellect\')"><span class="page-link border-0"><i class="bi bi-caret-left-fill"></i></span></li>'; 
                        }

                        echo'<li class="page-item" id="pageActuel" data-page='. $page .'><span class="page-link border-0 text-secondary">'.$page.' sur '.$nombredepage.'</span></li>';
                        
                        if($page == $nombredepage) {
                            echo'<li class="page-item disabled"><span class="page-link border-0"><i class="bi bi-caret-right-fill"></i></span></li>';
                        }else{
                            echo'<li class="page-item" id="'. $page + 1 .'" onclick="pagination(this.id, \'pagination_intellect\')"><span class="page-link border-0"><i class="bi bi-caret-right-fill"></i></span></li>';
                        }
                        echo '</ul>
                    </nav>';
                ?>
            </div>
        </section>
    </div>