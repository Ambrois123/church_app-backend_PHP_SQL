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
      <th scope="col">Citation</th>
      <th scope="col">Orateur</th>
      <th scope="col" colspan="2">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($quotes as $quote) :?>

    <tr>
        <td><?=$quote['id']?></td>
        <td><?=$quote['quotes']?></td>
        <td><?=$quote['author']?></td>
        <td>
          <a href="<?=URL?>admin/citations/modification/<?=$quote['id']?>" class="btn btn-warning">Modifier</a>
        </td>
        <td>
            <form method="POST" action="<?= URL ?>admin/citations/suppression" onsubmit="return confirm('Voulez-vous vraiment supprimer cette citation ?')">
                <input type="hidden" name="quote_id" value="<?=$quote['id']?>">
                <button class="btn btn-danger" type="submit">Supprimer</button>
            </form>
        </td>
    </tr>
    
    <?php endforeach; ?>
  </tbody>
</table>



<?php
$content = ob_get_clean();
$title = "Les citations";
require "views/assets/Template.php";
