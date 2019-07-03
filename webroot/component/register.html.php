<?php if(!empty($error)): ?>
<div class="alert alert-danger" role="alert">
<p>Non è possibile creare l'account, verifica il motivo:</p>
<ul>
<?php foreach($error as $errors): ?>
<?= '<li>' . $errors . '</li>' ?>
<?php endforeach ?> 
</ul>
</div>
<?php endif ?>

<div class="container">
<form action="" method="POST">
  <div class="form-group">
    <label for="Username">Username</label>
    <input type="text" class="form-control" id="username" name="author[username]"aria-describedby="emailHelp" value="<?=$author['username'] ?? '' ?>" placeholder="Scegli un nome utente.">
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" value="<?=$author['password'] ?? '' ?>" name="author[password]">
  </div>    

  <div class="form-group">
    <label for="nome">Nome completo</label>
    <input type="text" class="form-control" id="name" name="author[name]" value="<?=$author['name'] ?? '' ?>" placeholder="Inserisci il tuo nome completo.">
  </div>


  <div class="form-group">
    <label for="email">e-Mail</label>
    <input type="email" class="form-control" id="email" name="author[email]" value="<?=$author['email'] ?? '' ?>" placeholder="Inserisci una email valida">
  </div>

  <input type="submit" class="btn btn-primary" value="Registrati">
</form>
</div>