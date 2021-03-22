
        <section class="d-flex justify-content-center">
            <h2>Informations de votre page</h2>
        </section>
        <div class="mb-3" id="admin">
        <div class="row col-md-7 mx-auto mb-5" id="admminMineur"> 
            <article class="col border-zokubird my-3 pt-2">
                <form class="container" enctype="multipart/form-data" id="formPage" >
                    <div class="mb-3">
                        <label for="description" class="text-zokubird">Informations </label>
                        <?php
                            
                            require "../../database/database.php";
                            @session_start();
                            $page = $db->prepare("SELECT * FROM pages WHERE numPage=:id");
                            $page->bindParam(':id', $_SESSION['numPage']);
                            $page->execute();
                            $page = $page->fetch(PDO::FETCH_OBJ);
                            // var_dump($page);
                        ?>
                        <textarea class="form-control border border-primary rounded-0" id="description" name="description" rows="3"> <?php echo $page->descPage ; ?></textarea>
                    </div>
                    <div class="mb-3 container border border-primary rounded-0 py-2">
                        <div class="row m-0 p-0">
                            <input type="file" name="imagePage" id="imagePage" class=" col-md-5"   >
                        </div>
                    </div>
                    <div class="mb-3 row">
                    <input type="hidden" name="pageEdit">
                        <div class="col-md-6">
                            <label for="email" class="text-zokubird">Email : </label>
                            <input type="email" name="emailpage" id="email" class="form-control border border-primary rounded-0 " value="<?php echo $page->emailPage ; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="adress" class="text-zokubird">Adresse :</label>
                            <input type="text" name="adress" id="adress" class="form-control border border-primary rounded-0" value="<?php echo $page->adressPage ; ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="youtube" class="text-zokubird">Youtube :  </label>
                        <input type="url" name="youtube" id="youtube" class="form-control border border-primary rounded-0" value="<?php echo $page->youtubePage ; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="facebook" class="text-zokubird">Facebook :  </label>
                        <input type="url" name="facebook" id="facebook" class="form-control border border-primary rounded-0" value="<?php echo $page->facebookPage ; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="twitter" class="text-zokubird">Twitter :  </label>
                        <input type="url" name="twitter" id="twitter" class="form-control border border-primary rounded-0" value="<?php echo $page->twitterPage ; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="Site" class="text-zokubird">Site :  </label>
                        <input type="url" name="site" id="site" class="form-control border border-primary rounded-0" value="<?php echo $page->sitePage ; ?>">
                    </div>
                    <div class="mb-3 row" class="text-zokubird">
                        <button type="submit" class="mx-auto col-md-6 btn btn-zokubird text-light" id="btnEditpageForm" aria-expanded="true">CONFIGURER LA PAGE</button>
                    </div>
                </form>
            </article>
        </div>
        </div>