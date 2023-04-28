<?php ob_start(); 

?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
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
    <tr>
        <td><?=$sermon['id']?></td>
        <td><?=$sermon['date']?></td>
        <td><?=$sermon['title']?></td>
        <td><?=$sermon['resume']?></td>
        <td><?=URL."public/sermons/".$sermon['audio']?></td>
        <td><?=$sermon['author']?></td>
        <td>
           <a href="<?=URL?>admin/sermons/modification/<?=$sermon['id']?>" class="btn btn-warning">Modifier</a>
        </td>
        <td>
            <form method="POST" action="<?= URL ?>admin/sermons/suppression" onsubmit="return confirm('Voulez-vous vraiment supprimer ce sermon ?')">
                <input type="hidden" name="sermon_id" value="<?=$sermon['id']?>">
                <button class="btn btn-danger" type="submit">Supprimer</button>
            </form>
        </td>
    </tr>
    
    <?php endforeach; ?>
  </tbody>
</table>



<?php
$content = ob_get_clean();
$title = "Les sermons";
require "views/assets/Template.php";
