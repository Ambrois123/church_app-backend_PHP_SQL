
<?php if(!empty($_SESSION['alert'])) :?>
            <div class="alert <?= $_SESSION['alert']['type'] ?>" role="alert">
                <?= $_SESSION['alert']['message'] ?>
            </div>
            
        <?php 
            unset($_SESSION['alert']);
        endif ?>
        <?= $content ?>



        <?php else : ?>
            <form method="POST" action="<?= URL ?>admin/citations/validationModif">
                <tr>
                    <td><?=$quote['id']?></td>
                    <td><textarea name="resume" class="form-control" rows="10"><?=$quote['quotes']?></textarea></td>
                    <td><input type="text" name="author" class="form-control" value="<?=$quote['author']?>"/></td>
                    <td colspan="2">
                        <input type="hidden" name="sermon_id" value="<?=$quote['id']?>">
                        <button class="btn btn-primary" type="submit">Valider</button>
                    </td>
                </tr>
            </form>
