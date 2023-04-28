<?php ob_start(); 

?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Date</th>
      <th scope="col">Titre</th>
      <th scope="col">Fichier audio</th>
      <th scope="col">Orateur</th>
      <th scope="col" colspan="2">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($etudes as $etude) :?>
    <tr>
        <td><?=$etude['id']?></td>
        <td><?=$etude['date']?></td>
        <td><?=$etude['title']?></td>
        <td><?=URL."public/etudes/".$etude['audio']?></td>
        <td><?=$etude['author']?></td>
        <td>
           <a href="<?=URL?>admin/etudes/modification/<?=$etude['id']?>" class="btn btn-warning">Modifier</a>
        </td>
        <td>
            <form method="POST" action="<?= URL ?>admin/etudes/suppression" onsubmit="return confirm('Voulez-vous vraiment supprimer cette étude biblique ?')">
                <input type="hidden" name="etude_id" value="<?=$etude['id']?>">
                <button class="btn btn-danger" type="submit">Supprimer</button>
            </form>
        </td>
    </tr>
    
    <?php endforeach; ?>
  </tbody>
</table>



<?php
$content = ob_get_clean();
$title = "Les études bibliques";
require "views/assets/Template.php";
