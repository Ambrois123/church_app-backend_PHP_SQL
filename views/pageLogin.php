<?php ob_start(); ?>

<form method="POST" action="<?= URL ?>admin/connexion">
  <div class="mb-3">
    <label for="login" class="form-label">Login</label>
    <input type="text" class="form-control" id="login" name="login" aria-describedby="loginHelp">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  
  <button type="submit" class="btn btn-primary">Valider</button>
</form>

<?php 
$content = ob_get_clean();
$title = "Page de Login";
require_once "views/assets/template.php";