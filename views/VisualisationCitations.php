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

        <?php if(empty($_POST['quote_id']) || $_POST['quote_id'] !== $quote['id']) :?>
    <tr>
        <td><?=$quote['id']?></td>
        <td><?=$quote['quotes']?></td>
        <td><?=$quote['author']?></td>
        <td>
            <!-- Pour update on rappelle la meme page -->
            <form method="POST" action="">
            <input type="hidden" name="quote_id" value="<?=$quote['id']?>">
                <button class="btn btn-warning" type="submit">Modifier</button>
            </form>
        </td>
        <td>
            <form method="POST" action="<?= URL ?>admin/citations/validationSup" onsubmit="return confirm('Voulez-vous vraiment supprimer cette citation ?')">
                <input type="hidden" name="quote_id" value="<?=$quote['id']?>">
                <button class="btn btn-danger" type="submit">Supprimer</button>
            </form>
        </td>
    </tr>
        
    <?php endif; ?>
    <?php endforeach; ?>
  </tbody>
</table>



<?php
$content = ob_get_clean();
$title = "Les citations";
require "views/Template.php";
