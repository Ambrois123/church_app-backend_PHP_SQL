<?php ob_start();?>


<form method="POST" action="<?= URL ?>admin/sermons/validationCreation"  enctype="multipart/form-data">
    <div class="form-group">
        <label for="image">Image :</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>
    <div class="form-group">
        <label for="date">Date :</label>
        <input type="date" class="form-control" id="date" name="date">
    </div>
    <div class="form-group">
        <label for="title">Titre :</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="form-group">
        <label for="image">Résumé :</label>
        <textarea rows="6" class="form-control" id="resume" name="resume"></textarea>
    </div>
    <div class="form-group">
        <label for="audio">Fichier audio :</label>
        <input type="file" class="form-control" id="audio" name="audio">
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
$title = "Page de création d'un sermon";
require_once "views/assets/template.php";

?>
                        
                        