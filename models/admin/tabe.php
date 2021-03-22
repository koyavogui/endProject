<?php
    /**
     * Recuperaption de la variable de connexion à la base de données.
     */
    session_start();
    if (!isset($_SESSION['role'])){
        header("location:../../");
        exit();
    }
    require "../../database/database.php";
    $page = $_SESSION['numPage'];
    $zbird =  $db->prepare("SELECT * FROM intellects WHERE pageIntellect='$page'");
    $zbird ->execute();
    $zbird = $zbird->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    $i = 0;
?>

<?php foreach ($zbird as $mind) { $i++ ; ?>
    <tr>
        <th scope="row"><?php echo $i ?></th>
        <td><?php echo $mind->questionsIntellect; ?></td>
        <td><?php echo $mind->answersIntellect; ?></td>
        <td><a href="">ressource</a></td>
        <td class="text-center"><a class="text-success" data-toggle="modal" data-target="#editModal"  data-id="<?php echo $mind->idIntellect; ?>"><i class="fas fa-pencil-alt"></i></a></td>
        <td class=""><a class="text-danger" id="delete" data-toggle="modal" data-target="#deleteModal"  data-delete="<?php echo $mind->idIntellect; ?>"><i class="fas fa-trash-alt"></i></a></td>
    </tr> 
<?php }?>