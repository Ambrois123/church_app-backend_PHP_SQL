<?php ob_start(); 
if(!empty($_SESSION['alert'])):
?>

<div class="alert alert-<?= $_SESSION['alert']['type'] ?>" role="alert">

  <?= $_SESSION['alert']['message'] ?>

</div>
<?php 
unset($_SESSION['alert']);
endif; ?>


<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Date</th>
      <th scope="col">Titre</th>
      <th scope="col">Résumé</th>
      <th scope="col">Fichier audio</th>
      <th scope="col">Orateur</th>
      <th scope="col" colspan="2">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($sermons as $sermon) :?>
        <?php if(empty($_POST['sermon_id']) || $_POST['sermon_id'] !== $sermon['id']) :?>
    <tr>
        <td><?=$sermon['id']?></td>
        <td><img src="<?=URL."public/images/".$sermon['image']?>" alt="image du sermon" width="100px"></td>
        <td><?=$sermon['date']?></td>
        <td><?=$sermon['title']?></td>
        <td><?=$sermon['resume']?></td>
        <td><?=URL."public/sermons/".$sermon['audio']?></td>
        <td><?=$sermon['author']?></td>
        <td>
            <form method="POST" action="">
            <input type="hidden" name="sermon_id" value="<?=$sermon['id']?>">
                <button class="btn btn-warning" type="submit">Modifier</button>
            </form>
        </td>
        <td>
            <form method="POST" action="<?= URL ?>admin/sermons/validationSup" onsubmit="return confirm('Voulez-vous vraiment supprimer ce sermon ?')">
                <input type="hidden" name="sermon_id" value="<?=$sermon['id']?>">
                <button class="btn btn-danger" type="submit">Supprimer</button>
            </form>
        </td>
    </tr>
        <?php else : ?>
            <form method="POST" action="<?= URL ?>admin/sermons/validateModif">
                <tr>
                    <td><?=$sermon['id']?></td>
                    <td><input type="text" name="date" class="form-control" value="<?=$sermon['date']?>"/></td>
                    <td><input type="text" name="title" class="form-control" value="<?=$sermon['title']?>"/></td>
                    <td><textarea name="resume" class="form-control" rows="6"><?=$sermon['resume']?></textarea></td>
                    <td><input type="file"  name="audio_fil" accept="audio/*" value="<?=$sermon['audio_fil']?>"></td>
                    <td><input type="text" name="author" class="form-control" value="<?=$sermon['author']?>"/></td>
                    <td colspan="2">
                        <input type="hidden" name="sermon_id" value="<?=$sermon['id']?>">
                        <button class="btn btn-primary" type="submit">Valider</button>
                    </td>
                </tr>
            </form>
        <?php endif; ?>
    <?php endforeach; ?>
  </tbody>
</table>



<?php
$content = ob_get_clean();
$title = "Les sermons";
require "views/Template.php";
