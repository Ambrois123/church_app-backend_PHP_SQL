<?php ob_start();

?>

<form method="POST" action="<?= URL ?>admin/etudes/validationModif"  enctype="multipart/form-data">
    <input type="hidden" name="id">
    <div class="form-group">
        <label for="date">Date :</label>
        <input type="date" class="form-control" id="date" name="date" value="<?=$etudes['date']?>">
    </div>
    <div class="form-group">
        <label for="title">Titre :</label>
        <input type="text" class="form-control" id="title" name="title" value="<?=$etudes['title']?>">
    </div>
    <div class="form-group">
        <label for="audio">Fichier audio :</label>
        <input type="file" class="form-control" id="audio" name="audio" value="<?=$etudes['audio']?>">
    </div>
    <div class="form-group">
        <label for="author">Orateur :</label>
        <input type="text" class="form-control" id="author" name="author" value="<?=$etudes['author']?>">
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Valider</button>
    </div>
    
</form>

<?php 
$content = ob_get_clean();
$title = "Modification d'une étude biblique : ".$etudes['title'];
require_once "views/assets/template.php";