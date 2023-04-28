<?php ob_start();

?>

<form method="POST" action="<?= URL ?>admin/sermons/validateModif"  enctype="multipart/form-data">
    <input type="hidden" name="id">
    <div class="form-group">
        <label for="image">Image :</label>
        <input type="file" class="form-control" id="image" name="image" value="<?=$sermons['image']?>">
    </div>
    <div class="form-group">
        <label for="date">Date :</label>
        <input type="date" class="form-control" id="date" name="date" value="<?=$sermons['date']?>">
    </div>
    <div class="form-group">
        <label for="title">Titre :</label>
        <input type="text" class="form-control" id="title" name="title" value="<?=$sermons['title']?>">
    </div>
    <div class="form-group">
        <label for="image">Résumé :</label>
        <textarea rows="6" class="form-control" id="resume" name="resume" ><?=$sermons['resume']?></textarea>
    </div>
    <div class="form-group">
        <label for="audio">Fichier audio :</label>
        <input type="file" class="form-control" id="audio" name="audio" value="<?=$sermons['audio']?>">
    </div>
    <div class="form-group">
        <label for="author">Orateur :</label>
        <input type="text" class="form-control" id="author" name="author" value="<?=$sermons['author']?>">
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Valider</button>
    </div>
    
</form>

<?php 
$content = ob_get_clean();
$title = "Modification du sermon : ".$sermons['title'];
require_once "views/assets/template.php";