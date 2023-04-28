<?php ob_start();?>


<form method="POST" action="<?= URL ?>admin/citations/validationCreation"  enctype="multipart/form-data">
    <div class="form-group">
        <label for="quote">Citation :</label>
        <textarea rows="6" class="form-control" id="quote" name="quote"></textarea>
    </div>
    <div class="form-group">
        <label for="author">Orateur :</label>
        <input type="text" class="form-control" id="author" name="author">
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Valider</button>
    </div>
    
</form>


<?php 
$content = ob_get_clean();
$title = "Page de création d'une citation :";
require_once "views/assets/template.php";

?>
                        
                        