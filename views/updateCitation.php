<?php ob_start();

?>

<form method="POST" action="<?= URL ?>admin/citations/validationModification"  enctype="multipart/form-data">

    <div class="form-group">
        <label for="quote">Citation :</label>
        <textarea rows="10" class="form-control" id="quote" name="quote" ><?=$quotes['quotes']?></textarea>
    </div>
    <div class="form-group">
        <label for="author">Orateur :</label>
        <input type="text" class="form-control" id="author" name="author" value="<?=$quotes['author']?>">
    </div>
    <input type="hidden" name="id" value="<?=$quotes['id']?>">
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Valider</button>
    </div>
    
</form>


<?php 
$content = ob_get_clean();
$title = "Modification d'une citation :".$quotes['id'];
require_once "views/assets/template.php";